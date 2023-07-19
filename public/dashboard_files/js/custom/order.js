//start of add order
$(".add-product").on("click", function (e) {
    e.preventDefault();
    var name = $(this).data("name");
    var id = $(this).data("id");
    var price = $.number($(this).data("price"), 2);
    $(this).removeClass("btn-info").addClass("btn-default disabled");

    var html = `<tr>
                    <td>${name}</td>
                    <td><input type="number" name="products[${id}][quantity]" data-price="${price}" class="form-control input-sm product-quantity" min="1" value="1"></td>
                    <td class="product-price">${price}</td>
                    <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
                </tr>`;

    $(".order-list").append(html);
    calculate_total_price();
});
//end of add order

$("body").on("click", ".disabled", function (e) {
    e.preventDefault();
});
//start of remove order
$("body").on("click", ".remove-product-btn", function (e) {
    var id = $(this).data("id");
    e.preventDefault();
    $(this).closest("tr").remove();
    $("#product-" + id)
        .removeClass("btn-default disabled")
        .addClass("btn-info");
    calculate_total_price();
}); //end of remove order

//end of change price by quantity

$("body").on("keyup change", ".product-quantity", function () {
    var quantity = parseInt($(this).val()); //quantity 2
    var price = parseFloat($(this).data("price").replace(/,/g, "")); //price 150

    $(this)
        .closest("tr")
        .find(".product-price")
        .html($.number(quantity * price), 2); // new price 300
    calculate_total_price(); // total = new price + price to each product
}); //end of change price by quantity

// start of calculate total price
function calculate_total_price() {
    var price = 0;
    $(".order-list .product-price").each(function (index) {
        price += parseFloat($(this).html().replace(/,/g, ""));
    });
    $(".total-price").html($.number(price, 2));

    if (price > 0) {
        $("#add-order-form-btn").removeClass("disabled");
    } else {
        $("#add-order-form-btn").addClass("disabled");
    }
}
//end of calculate price

$(".order-products").on("click", function () {
    var url = $(this).data("url");
    var method = $(this).data("method");
    let _token = $("input[name=_token]").val();

    $.ajax({
        url: url,
        type: method,

        data: {

        },
        success: function (response) {
      console.log(response);
            },
    });
});
//end of order products
//
