function renderItem(ul, item) {
  return $("<li>")
    .append("<div>" + item.label + "</div>")
    .appendTo(ul);
}

$(document).on("focus", ".product-name", function () {
  $(this)
    .autocomplete({
      source: function (request, response) {
        $.ajax({
          type: "POST",
          url: "include/AutoCompleteProducts.php",
          dataType: "json",
          data: {
            keyword: request.term,
          },
          success: function (data) {
            response(
              $.map(data, function (item) {
                return {
                  label: item.product_name,
                  value: item.product_name,
                };
              })
            );
          },
        });
      },
      minLength: 1,
      select: function (event, ui) {
        $(this).val(ui.item.value);
        return false;
      },
      focus: function (event, ui) {
        $(this).val(ui.item.value);
        return false;
      },
    })
    .autocomplete("instance")._renderItem = renderItem;
});
