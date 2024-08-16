let index = 0;

function showSlide(slideIndex) {
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;

    if (slideIndex >= totalSlides) {
        index = 0;
    } else if (slideIndex < 0) {
        index = totalSlides - 1;
    } else {
        index = slideIndex;
    }

    const newTransformValue = `translateX(${-index * 100}%)`;
    document.querySelector('.slider').style.transform = newTransformValue;
}

function nextSlide() {
    showSlide(index + 1);
}

function prevSlide() {
    showSlide(index - 1);
}

// Optionally, set an interval to change slides automatically
setInterval(nextSlide, 5000); // Change slide every 5 seconds