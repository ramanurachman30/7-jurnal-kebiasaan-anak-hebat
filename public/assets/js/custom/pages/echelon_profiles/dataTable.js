"use strict";
const userToken = $('meta[name="token"]').attr("content");
const csrfToken = $('meta[name="token"]').attr("value");
let columns = $("input[name='data-columns']").val();
let datatableUrl = $("meta[name='datatable-url']").attr("content");
let firstSegment = $("meta[name='first-segment']").attr("content");
let firstSegmentApi = $("meta[name='first-segment-api']").attr("content");
let isAllowToUpdate = $("meta[name='permission']").attr("update");
let isAllowToTrash = $("meta[name='permission']").attr("trash");
let isAllowToRestore = $("meta[name='permission']").attr("restore");
let isAllowToDelete = $("meta[name='permission']").attr("delete");
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
          targets: 1,
          render: function (data, type, row) {
            return `
                            <a href="${firstSegment}/${row.id}/detail" class="text-bold">${data}</a>
                        `;
          },
        },
        {
          targets: -1,
          data: null,
          orderable: false,
          className: "text-end",
          render: function (data, type, row) {
            var dom = `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Action
                                <span class="m-0 svg-icon svg-icon-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px" data-kt-menu="true">
                        `;
            if (isAllowToUpdate) {
              dom += `<div class="px-3 menu-item">
                                        <a href="${firstSegment}/${data.id}/edit" class="px-3 menu-link" data-kt-user-table-filter="edit_row">
                                            Edit
                                        </a>
                                    </div>`;
            }

            if (isAllowToTrash) {
              dom += `<div class="px-3 menu-item">
                                    <a data-remote="${firstSegmentApi}/${data.id}/trash" class="px-3 menu-link" data-kt-user-table-filter="delete_row">
                                        Delete
                                    </a>
                                </div>`;
            }

            if (isAllowToRestore) {
              dom += `<div class="menu-item px-3">
                                    <a data-remote="${firstSegmentApi}/${data.id}/restore" class="menu-link px-3" data-kt-user-table-filter="restore_row">
                                        Restore
                                    </a>
                                </div>`;
            }

            if (isAllowToDelete) {
              dom += `<div class="menu-item px-3">
                                    <a data-remote="${firstSegmentApi}/${data.id}" class="menu-link px-3" data-kt-user-table-filter="delete_row">
                                        Delete
                                    </a>
                                </div>`;
            }
            dom += `</div>`;

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
        const customerName = parent.querySelectorAll("td")[3].innerText;

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

            const confirmMessage = dataStatus == "2" 
        ? "Are you sure want to permanently delete selected rows? This action cannot be undone!" 
        : "Are you sure want to delete selected rows?";
      const confirmButtonText = dataStatus == "2" 
        ? "Yes, Delete Permanently" 
        : "Yes, Delete";
      
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
            const url = dataStatus == "2" 
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
                const successMessage = dataStatus == "2" 
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
