var select2 = (function () {
  return {
    init: function () {
      $("select.select2ajax").each(function () {
        const select = $(this);
        const table = select.data("model");
        const key = select.data("key");
        const display = select.data("display");
        const filter = select.data("filter") || [];
        const token = $('meta[name="token"]').attr("content");
        const parent = select.data("parent");
        const parentField = select.data("parent-field") || "id";

        const url = hostUrl + `/api/select2ajax/${table}/${key}/${display}`;

        select.select2({
          width: "100%",
          allowClear: true,
          delay: 250,
          placeholder: `Select ${table}`,
          ajax: {
            url: url,
            type: "POST",
            dataType: "json",
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
              "Authorization": "Bearer " + token,
            },
            data: function (params) {
              let query = {
                search: params.term || "",
                filter: filter
              };

              if (parent) {
                const parentValue = $(`[name="${parent}"]`).val();
                query.params = { [parentField]: parentValue };
              }

              return query;
            },
            processResults: function (data) {
              return {
                results: data.results
              };
            },
          },
        });
      });

      // Sysparam select2
      $("select.sysparam-reference").each(function () {
        const select = $(this);
        const display = select.data("display");
        const group = select.data("group");
        const token = $('meta[name="token"]').attr("content");
        const url = hostUrl + `/api/sysparam/${group}/${display}`;

        select.select2({
          width: "100%",
          allowClear: true,
          delay: 250,
          placeholder: `Select ${group}`,
          ajax: {
            url: url,
            type: "GET",
            dataType: "json",
            headers: {
              "Authorization": "Bearer " + token,
            },
            data: function (params) {
              return {
                search: params.term || "",
              };
            },
            processResults: function (data) {
              return {
                results: data.results,
              };
            },
          },
        });
      });
    },
  };
})();

jQuery(document).ready(function () {
  select2.init();
});
