const images = document.querySelectorAll('.golden-img img');
const modal = document.getElementById('imageModal');
const modalImg = document.getElementById('fullImage');
const closeBtn = document.querySelector('.close-btn');
const prevBtn = document.querySelector('.prev-btn');
const nextBtn = document.querySelector('.next-btn');

let currentImageIndex = 0;
let startX = 0;
let endX = 0;

// Open Modal with Selected Image
function openModal(index) {
    modal.style.display = 'flex';
    modalImg.src = images[index].src;
    currentImageIndex = index;
}

// Close Modal
function closeModal() {
    modal.style.display = 'none';
}

// Show Previous Image
function prevImage() {
    currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
    modalImg.src = images[currentImageIndex].src;
}

// Show Next Image
function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % images.length;
    modalImg.src = images[currentImageIndex].src;
}

// Touch Events for Swipe
modalImg.addEventListener('touchstart', (e) => {
    startX = e.touches[0].clientX;
});

modalImg.addEventListener('touchend', (e) => {
    endX = e.changedTouches[0].clientX;
    handleSwipe();
});

function handleSwipe() {
    const threshold = 50;
    const diffX = endX - startX;
    if (Math.abs(diffX) > threshold) {
        if (diffX > 0) {
            prevImage();
        } else {
            nextImage();
        }
    }
}

// Event Listeners
images.forEach((img, index) => {
    img.addEventListener('click', () => openModal(index));
});

closeBtn.addEventListener('click', closeModal);
prevBtn.addEventListener('click', prevImage);
nextBtn.addEventListener('click', nextImage);

// Close Modal on Outside Click
window.addEventListener('click', (e) => {
    if (e.target === modal) {
        closeModal();
    }
});

// Close Modal + Navigate on Keyboard
window.addEventListener('keydown', (e) => {
    if (modal.style.display === 'flex') {
        if (e.key === 'Escape') {
            closeModal();
        } else if (e.key === 'ArrowLeft') {
            prevImage();
        } else if (e.key === 'ArrowRight') {
            nextImage();
        }
    }
});
