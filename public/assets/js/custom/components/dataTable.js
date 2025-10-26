"use strict";
const userToken = $('meta[name="token"]').attr("content");
const csrfToken = $('meta[name="token"]').attr("value");
const columns = $('input[name="data-columns"]').val() || "[]";
let datatableUrl = $("meta[name='datatable-url']").attr("content");
let firstSegment = $("meta[name='first-segment']").attr("content");
let firstSegmentApi = $("meta[name='first-segment-api']").attr("content");
let isAllowToUpdate = $("meta[name='permission']").attr("update");
let isAllowToTrash = $("meta[name='permission']").attr("trash");
let isAllowToRestore = $("meta[name='permission']").attr("restore");
let isAllowToDelete = $("meta[name='permission']").attr("delete");
let dataStatus = $("meta[name='status']").attr("content");
  console.log('firstSegmentApi', firstSegmentApi);
var KTDatatablesServerSide = (function () {
  var dt;
  var table;

  // --- FIX: Ambil data meta dari HTML ---
  const datatableUrl = $('meta[name="datatable-url"]').attr("content");
  const firstSegmentApi = $('meta[name="first-segment-api"]').attr("content");
  const csrfToken = $('meta[name="csrf-token"]').attr("content");
  const columns = $('input[name="data-columns"]').val() || "[]";
  const userToken = localStorage.getItem("token") || ""; // pastikan token diambil benar

  // --- FIX: Pastikan columns JSON valid ---
  let parsedColumns = [];
  try {
    parsedColumns = JSON.parse(columns);
  } catch (e) {
    console.error("Invalid column JSON:", e);
  }

  var searchAdvance = {};

  var initDatatable = function () {
    dt = $("#kt_datatable_example_1").DataTable({
      searchDelay: 500,
      processing: true,
      serverSide: true,
      responsive: true,
      ajax: {
        url: datatableUrl,
        type: "POST",
        headers: {
          Authorization: `Bearer ${userToken}`,
          "X-CSRF-TOKEN": csrfToken,
        },
        data: function (d) {
          d.params = searchAdvance;
          d.search = d.search.value;
        },
        complete: function () {
          $('[data-toggle="tooltip"]').tooltip();
        },
      },
      columns: parsedColumns,
    });

    table = dt.$;

    // Reinit event setiap redraw
    dt.on("draw", function () {
      initToggleToolbar();
      toggleToolbars();
      handleDeleteRows();
      handleRestoreRows();
      KTMenu?.createInstances();
    });
  };

  var handleSearchDatatable = function () {
    var typingTimer;
    var debounceDelay = 500; // ms

    const filterSearch = document.querySelector(
      '[data-kt-user-table-filter="search"]'
    );

    filterSearch.addEventListener("keyup", function (e) {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(function () {
        dt.search(e.target.value).draw();
      }, debounceDelay);
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
        const customerName = parent.querySelectorAll("td")[2].innerText;

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

      const confirmMessage =
        dataStatus == "2"
          ? "Are you sure want to permanently delete selected rows? This action cannot be undone!"
          : "Are you sure want to delete selected rows?";
      const confirmButtonText =
        dataStatus == "2" ? "Yes, Delete Permanently" : "Yes, Delete";

      Swal.fire({
        text: confirmMessage,
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        showLoaderOnConfirm: true,
        confirmButtonText: confirmButtonText,
        cancelButtonText: "No, Cancel",
        customClass: {
          confirmButton: "btn fw-bold btn-danger",
          cancelButton: "btn fw-bold btn-active-light-primary",
        },
      }).then(function (result) {
        if (result.value) {
          // Check if we're in trashed view (status = 2) for permanent delete, otherwise trash
          const url =
            dataStatus == "2"
              ? `${firstSegmentApi}/${selectedList}`
              : `${firstSegmentApi}/${selectedList}/trash`;
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
              const successMessage =
                dataStatus == "2"
                  ? "You have permanently deleted all selected rows!"
                  : "You have deleted all selected rows!";
              Swal.fire({
                text: successMessage,
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
