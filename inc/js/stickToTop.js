document.addEventListener('DOMContentLoaded', () => {
    // sticky menu on scroll up
    // When the user scrolls the page, execute myFunction
    window.onscroll = function() {stickToTop()};
    // Get the header
    let mainmenu = document.getElementById("mainmenu");
    // Get the offset position of the navbar
    let sticky = mainmenu.offsetTop;
    // Add the sticky class to the .mainmenu when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function stickToTop() {
        if (window.pageYOffset > sticky) {
            mainmenu.classList.add("sticky");
        } else {
            mainmenu.classList.remove("sticky");
        }
    }

}); // End of DOM