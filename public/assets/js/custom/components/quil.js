var quillEditor = (function () {
  return {
    init: function () {
      var toolbarOptions = [
        ["bold", "italic", "underline", "strike"],
        ["blockquote"],
        [{ list: "ordered" }, { list: "bullet" }],
        [{ indent: "-1" }, { indent: "+1" }],
        [{ direction: "rtl" }],
        [{ color: [] }],
        [{ align: [] }],
        ["image", "link"],
        [{ header: [1, 2, 3, 4, 5, 6, false] }],
      ];

      $(".quill-editor").each(function () {
        var editorEl = $(this);
        var editorId = `#${editorEl.attr("id")}`;
        var fieldName = editorEl.data("name");
        const safeFieldName = fieldName.includes("[")
          ? fieldName.split("[")[0]
          : fieldName;

        var quill = new Quill(editorId, {
          modules: { toolbar: toolbarOptions },
          placeholder: "Type your text here...",
          theme: "snow",
        });

        quill.on("text-change", function (delta, oldDelta, source) {
          const deleted = getImgUrls(quill.getContents().diff(oldDelta));

          $(`#target-editor-${safeFieldName}`).val(
            quill.container.firstChild.innerHTML
          );
          const anu = $(`#target-editor-${safeFieldName}`).val();
          if (deleted.length) removeImageFromServer(deleted);
        });

        function getImgUrls(delta) {
          return delta.ops
            .filter((i) => i.insert && i.insert.image)
            .map((i) => i.insert.image);
        }

        quill.getModule("toolbar").addHandler("image", () => {
          selectLocalImage(quill);
        });
      });

      function selectLocalImage(quill) {
        const input = document.createElement("input");
        input.setAttribute("type", "file");
        input.setAttribute(
          "accept",
          "image/jpeg,image/jpg,image/png,image/gif,image/webp"
        );
        input.click();

        input.onchange = () => {
          const file = input.files[0];
          if (file && /^image\//.test(file.type)) {
            saveToServer(file, quill);
          }
        };
      }

      function saveToServer(file, quill) {
        const fd = new FormData();
        fd.append("image", file);
        fd.append("bucket", "editor");
        const csrfToken = $('meta[name="token"]').attr("value");

        const xhr = new XMLHttpRequest();
        xhr.open("POST", uploadUri, true);
        xhr.setRequestHeader("Authorization", "Bearer " + personalToken);
        xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
        xhr.onload = () => {
          if (xhr.status === 200) {
            const name = JSON.parse(xhr.responseText)[0].filename;
            const url = `${hostUrl}/storage/editor/${name}`;
            insertToEditor(url, quill);
          }
        };
        xhr.send(fd);
      }

      function insertToEditor(url, quill) {
        const range = quill.getSelection();
        quill.insertEmbed(range.index, "image", `${url}`);
      }

      function removeImageFromServer(urlList) {
        const url = urlList[0];
        const splitUrl = url.split("/");

        const fd = new FormData();
        fd.append("filename", splitUrl[splitUrl.length - 1]);
        fd.append("bucket", "editor");

        const csrfToken = $('meta[name="token"]').attr("value");

        const xhr = new XMLHttpRequest();
        xhr.open("POST", deleteFileUri, true);
        xhr.setRequestHeader("Authorization", "Bearer " + personalToken);
        xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
        xhr.send(fd);
      }
    },
  };
})();

jQuery(document).ready(function () {
  quillEditor.init();
});
