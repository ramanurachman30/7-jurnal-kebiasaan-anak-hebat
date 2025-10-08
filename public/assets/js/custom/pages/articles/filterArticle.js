$(document).ready(function () {
    $(function () {
        $("a.filter").on("click", function (e) {
            let data = $(this).data("article");
            var listArticle = $(".allArticle");
            listArticle.removeClass("d-none");
            $(listArticle).each(function (indexInArray, valueOfElement) {
                var dataClass = $(valueOfElement);
                if (!dataClass.hasClass(data)) {
                    dataClass.addClass("d-none");
                }
            });
        });
    });
});
