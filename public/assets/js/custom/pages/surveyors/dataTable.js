"use strict";
const userToken = $('meta[name="token"]').attr("content");
const csrfToken = $('meta[name="token"]').attr("value");
let columns = $("input[name='data-columns']").val();
let datatableUrl = $("meta[name='datatable-url']").attr("content");
let firstSegment = $("meta[name='first-segment']").attr("content");
let firstSegmentApi = $("meta[name='first-segment-api']").attr("content");
let dataStatus = $("meta[name='status']").attr("content");

var KTDatatablesServerSide = (function () {
  // Shared variables
  var table;
  var dt;

  var data = $("form#searchform").serializeArray();
  var searchAdvance = {};
  $.map(data, function (item, value) {
    searchAdvance[item["name"]] = item["value"];
  });

  var initDatatable = function () {
    dt = $("#kt_datatable_example_1").DataTable({
      searchDelay: 500,
      processing: true,
      serverSide: true,
      // stateSave: true,
      select: {
        style: "multi",
        selector: 'td:first-child input[type="checkbox"]',
        className: "row-selected",
      },
      ajax: {
        url: datatableUrl,
        type: "POST",
        headers: {
          Authorization: `Bearer ${userToken}`,
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: function (data) {
          data.params = searchAdvance;
          data.search = data.search.value;

          if (dataStatus) data.status = dataStatus;
        },
        complete: function (result) {
          $("#kt_datatable_example_1")
            .find("th:first-child")
            .removeClass("sorting_asc");
          $('[data-toggle="tooltip"]').tooltip();
        },
      },
      columns: JSON.parse(columns),
      columnDefs: [
        {
          targets: 0,
          orderable: false,
          render: function (data) {
            return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="${data}" />
                            </div>`;
          },
        },
        {
          targets: -1,
          data: null,
          orderable: false,
          className: "text-end",
          render: function (data, type, row) {
            var dom = "";
            return dom;
          },
        },
      ],
    });

    table = dt.$;

    dt.on("draw", function () {
      initToggleToolbar();
      toggleToolbars();
      handleDeleteRows();
      handleRestoreRows();
      handleFilterDatatable();
      KTMenu.createInstances();
    });
  };

  var handleSearchDatatable = function () {
    const filterSearch = document.querySelector(
      '[data-kt-user-table-filter="search"]'
    );
    filterSearch.addEventListener("keyup", function (e) {
      dt.search(e.target.value).draw();
    });
  };

  var handleFilterDatatable = () => {
    $("form#searchform").on("change", function () {
      var obj = $("form#searchform").serializeArray();
      searchAdvance = obj;
      dt.draw();
    });
  };

  var handleDeleteRows = () => {
    const deleteButtons = document.querySelectorAll(
      '[data-kt-user-table-filter="delete_row"]'
    );

    deleteButtons.forEach((d) => {
      d.addEventListener("click", function (e) {
        e.preventDefault();
        const url = $(this).data("remote");
        const parent = e.target.closest("tr");
        const customerName = parent.querySelectorAll("td")[1].innerText;

        Swal.fire({
          text: "Are you sure want to delete " + customerName + "?",
          icon: "warning",
          showCancelButton: true,
          buttonsStyling: false,
          confirmButtonText: "Yes Delete!",
          cancelButtonText: "No Cancel",
          customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary",
          },
        }).then(function (result) {
          if (result.value) {
            $.ajax({
              url: url,
              type: "POST",
              headers: {
                Authorization: `Bearer ${userToken}`,
              },
              data: {
                _token: csrfToken,
              },
              success: function (resp) {
                Swal.fire({
                  text: customerName + " Deleted",
                  icon: "success",
                  buttonsStyling: false,
                  confirmButtonText: "Yes",
                  customClass: {
                    confirmButton: "btn fw-bold btn-primary",
                  },
                }).then(function () {
                  dt.draw();
                });
              },
            });
          } else if (result.dismiss === "cancel") {
            Swal.fire({
              text: customerName + " Not Deleted.",
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "Yes",
              customClass: {
                confirmButton: "btn fw-bold btn-primary",
              },
            });
          }
        });
      });
    });
  };

  var handleRestoreRows = () => {
    // Select all delete buttons
    const deleteButtons = document.querySelectorAll(
      '[data-kt-user-table-filter="restore_row"]'
    );

    deleteButtons.forEach((d) => {
      // Delete button on click
      d.addEventListener("click", function (e) {
        e.preventDefault();
        const url = $(this).data("remote");

        Swal.fire({
          text: "Are you sure want to restore this data?",
          icon: "warning",
          showCancelButton: true,
          buttonsStyling: false,
          confirmButtonText: "Yes, Restore",
          cancelButtonText: "No, Cancel",
          customClass: {
            confirmButton: "btn fw-bold btn-success",
            cancelButton: "btn fw-bold btn-active-light-primary",
          },
        }).then(function (result) {
          if (result.value) {
            $.ajax({
              url: url,
              type: "PUT",
              headers: {
                Authorization: `Bearer ${userToken}`,
              },
              data: {
                _token: csrfToken,
              },
              success: function (resp) {
                Swal.fire({
                  text: "Data restored succesfully.",
                  icon: "success",
                  buttonsStyling: false,
                  confirmButtonText: "Yes",
                  customClass: {
                    confirmButton: "btn fw-bold btn-primary",
                  },
                }).then(function () {
                  dt.draw();
                });
              },
              error: function (err) {
                Swal.fire({
                  text: "Data not restored.",
                  icon: "error",
                  buttonsStyling: false,
                  confirmButtonText: "Yes",
                  customClass: {
                    confirmButton: "btn fw-bold btn-primary",
                  },
                });
              },
            });
          } else if (result.dismiss === "cancel") {
            Swal.fire({
              text: "Data not restored.",
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "Yes",
              customClass: {
                confirmButton: "btn fw-bold btn-primary",
              },
            });
          }
        });
      });
    });
  };

  var initToggleToolbar = function () {
    const container = document.querySelector("#kt_datatable_example_1");
    const checkboxes = container.querySelectorAll('[type="checkbox"]');

    const deleteSelected = document.querySelector(
      '[data-kt-user-table-select="delete_selected"]'
    );

    checkboxes.forEach((c) => {
      c.addEventListener("click", function () {
        setTimeout(function () {
          toggleToolbars();
        }, 50);
      });
    });

    deleteSelected.addEventListener("click", function () {
      var selectedId = [];
      var checkbox = $('tbody [type="checkbox"]:checked');
      checkbox.each(function (key, items, data) {
        if ($(items).val() != "on") selectedId.push($(items).val());
      });

      var selectedList = selectedId.join(",");

      Swal.fire({
        text: "Are you sure want to delete selected rows ?",
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        showLoaderOnConfirm: true,
        confirmButtonText: "Yes, Delete",
        cancelButtonText: "No, Cancel",
        customClass: {
          confirmButton: "btn fw-bold btn-danger",
          cancelButton: "btn fw-bold btn-active-light-primary",
        },
      }).then(function (result) {
        if (result.value) {
          const url = `${firstSegmentApi}/${selectedList}/trash`;
          $.ajax({
            url: url,
            type: "POST",
            headers: {
              Authorization: `Bearer ${userToken}`,
            },
            data: {
              _token: csrfToken,
            },
            success: function (resp) {
              Swal.fire({
                text: "You have deleted all selected rows!",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Yes!",
                customClass: {
                  confirmButton: "btn fw-bold btn-primary",
                },
              }).then(function () {
                dt.draw();
              });

              const headerCheckbox =
                container.querySelectorAll('[type="checkbox"]')[0];
              headerCheckbox.checked = false;
            },
          });
        } else if (result.dismiss === "cancel") {
          Swal.fire({
            text: "Selected rows not deleted.",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Yes, Oke!",
            customClass: {
              confirmButton: "btn fw-bold btn-primary",
            },
          });
        }
      });
    });
  };

  var toggleToolbars = function () {
    const container = document.querySelector("#kt_datatable_example_1");
    const toolbarBase = document.querySelector(
      '[data-kt-user-table-toolbar="base"]'
    );
    const toolbarSelected = document.querySelector(
      '[data-kt-user-table-toolbar="selected"]'
    );
    const selectedCount = document.querySelector(
      '[data-kt-user-table-select="selected_count"]'
    );
    const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');
    let checkedState = false;
    let count = 0;

    allCheckboxes.forEach((c) => {
      if (c.checked) {
        checkedState = true;
        count++;
      }
    });

    if (checkedState) {
      selectedCount.innerHTML = count;
      toolbarBase.classList.add("d-none");
      toolbarSelected.classList.remove("d-none");
    } else {
      toolbarBase.classList.remove("d-none");
      toolbarSelected.classList.add("d-none");
    }
  };

  return {
    init: function () {
      initDatatable();
      handleSearchDatatable();
      initToggleToolbar();
      handleDeleteRows();
      handleRestoreRows();
      handleFilterDatatable();
    },
  };
})();

KTUtil.onDOMContentLoaded(function () {
  KTDatatablesServerSide.init();
});
