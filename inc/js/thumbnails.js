const thumbnails = document.querySelectorAll('.thumbnail');
const mainImage = document.querySelector('.product_img');

thumbnails.forEach(thumbnail => {
    thumbnail.addEventListener('click', () => {
        const fullImage = thumbnail.dataset.fullImage;
        mainImage.src = fullImage;
    });
});
