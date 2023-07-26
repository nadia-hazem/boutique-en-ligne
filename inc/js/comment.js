document.addEventListener('DOMContentLoaded', function() {

    const pageTitle = document.querySelector("head title").innerHTML;
    const commentSection = document.querySelector(".comment_section");

    if (pageTitle === "Product"){
        const str = window.location.href;
        const url = new URL(str);
        const id = url.searchParams.get("id");

        function getComments() {
            fetch("inc/php/leaveComment.php?getComments&id=" + id)
            .then(response => response.text())
            .then(data => {
                commentSection.innerHTML = data;
            })
            .catch(error => console.log(error));
        }

    } else if (pageTitle === "About Us") {

        function getComments() {
            fetch("inc/php/leaveComment.php?getComments")
            .then(response => response.text())
            .then(data => {
                commentSection.innerHTML = data;
            })
            .catch(error => console.log(error));
        }
    }

    function addComment($form) {
        const formData = new FormData($form);
        formData.append("postComment", true);
        fetch("inc/php/leaveComment.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            data = data.trim();
            if (data === "ok") {
                getComments();
            } else {
                alert(data);
            }
        })
        .catch(error => console.log(error));
    }


    // call the function
    getComments();

    commentSection.addEventListener("submit", function(e) {
        e.preventDefault();
        const $form = e.target;
        addComment($form);
    });
});