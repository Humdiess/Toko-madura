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

document.addEventListener('DOMContentLoaded', function() {
    const mainImage = document.getElementById('mainImage');
    const selectors = document.querySelectorAll('.image-detail-selector .selector');
    const preview = document.querySelector('.image-detail-preview');

    // Ganti gambar utama dengan gambar yang dipilih
    selectors.forEach(function(selector) {
        selector.addEventListener('click', function() {
            mainImage.src = this.src;
        });
    });

    preview.addEventListener('mousemove', function(e) {
        const rect = preview.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const img = mainImage;

        img.style.transformOrigin = `${x}px ${y}px`;
        img.style.transform = 'scale(2)';
    });

    preview.addEventListener('mouseleave', function() {
        mainImage.style.transform = 'scale(1)';
    });
});

