function onIncrementClick(id, price) {
    var currentQuantityString = $(`#quantity-${id}`).html();
    var currentQuantityNumber = parseInt(currentQuantityString, 10);
    currentQuantityNumber += 1;
    updateCartQuantity(id,currentQuantityNumber);
    $(`#quantity-${id}`).html(currentQuantityNumber.toString());
    var subtotal = currentQuantityNumber * parseFloat(price);
    $(`#subtotal-${id}`).html(subtotal.toFixed(2));

    var currentTotalString = $(`#total`).html();
    var currentTotalNumber = parseFloat(currentTotalString);
    currentTotalNumber += parseFloat(price);
    $(`#total`).html(currentTotalNumber.toFixed(2));
}

function onDecrementClick(id, price) {
    var currentQuantityString = $(`#quantity-${id}`).html();
    var currentQuantityNumber = parseInt(currentQuantityString, 10);
    if (currentQuantityNumber > 1) {
        currentQuantityNumber -= 1;
        updateCartQuantity(id,currentQuantityNumber);
        $(`#quantity-${id}`).html(currentQuantityNumber.toString());
        var subtotal = currentQuantityNumber * parseFloat(price);
        $(`#subtotal-${id}`).html(subtotal.toFixed(2));

        var currentTotalString = $(`#total`).html();
        var currentTotalNumber = parseFloat(currentTotalString);
        currentTotalNumber -= parseFloat(price);
        $(`#total`).html(currentTotalNumber.toFixed(2));
    }
}

function updateCartQuantity(productId,quantity) {

    var token = $("#token").html();

    $.ajax({
        url: "/cart/update",
        method: 'POST',
        data: {
            _token: token,
            quantity: quantity,
            product_id: productId
        },
        success: function (response) {
            if (response.success) {
                // Show a success message
                alert('Cart updated successfully!');
            }
        },
        error: function (xhr) {
            alert('An error occurred while updating the cart.');
        }
    });
}
