
document.addEventListener('DOMContentLoaded', function() {
    const mainImage = document.getElementById('mainImage');
    const selectors = document.querySelectorAll('.image-detail-selector .selector');
    const preview = document.querySelector('.image-detail-preview');

    if (selectors.length > 0) {
        const firstSelector = selectors[0];
        firstSelector.classList.add('active');
        mainImage.src = firstSelector.src;
    }

    selectors.forEach(function(selector) {
        selector.addEventListener('click', function() {
            selectors.forEach(img => img.classList.remove('active'));
            
            this.classList.add('active');
            
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

document.addEventListener('DOMContentLoaded', function() {
    const descriptionText = document.querySelector('.description-text');
    const readMoreLink = document.querySelector('.read-more');
    const fullText = descriptionText.textContent.trim();

    if (fullText.length > 200) {
        const truncatedText = fullText.substring(0, 200) + '...';
        descriptionText.textContent = truncatedText;
        readMoreLink.style.display = 'inline';

        readMoreLink.addEventListener('click', function(event) {
            event.preventDefault();
            descriptionText.textContent = fullText;
            readMoreLink.style.display = 'none';
        });
    }
});
