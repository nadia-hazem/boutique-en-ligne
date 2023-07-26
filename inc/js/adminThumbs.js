document.addEventListener('DOMContentLoaded', () => {

    const popUp = document.querySelector(".popup-container");

    popUp.addEventListener('click', event => {
        if(event.target.classList.contains('thumbnail')){
            const fullImage = event.target.dataset.fullImage;
            let mainImage = event.target.parentElement.parentElement.querySelector('.product_img');
            mainImage.src = fullImage;
        }
    });
}); // End of DOM