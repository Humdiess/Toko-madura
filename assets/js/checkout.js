document.addEventListener("DOMContentLoaded", function() {
    const minusBtn = document.getElementById("minusBtn");
    const plusBtn = document.getElementById("plusBtn");
    const quantityInput = document.getElementById("orderQuantity");
    const subtotalDisplay = document.getElementById("subtotal");
    const productPrice = 100000;

    function updateSubtotal() {
        const quantity = Math.max(1, parseInt(quantityInput.value));
        const subtotal = quantity * productPrice;
        subtotalDisplay.textContent = `Subtotal: Rp. ${subtotal.toLocaleString()}`;
    }

    minusBtn.addEventListener("click", function() {
        if (quantityInput.value > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
            updateSubtotal();
        }
    });

    plusBtn.addEventListener("click", function() {
        quantityInput.value = parseInt(quantityInput.value) + 1;
        updateSubtotal();
    });

    quantityInput.addEventListener("input", updateSubtotal);

    updateSubtotal();
});
