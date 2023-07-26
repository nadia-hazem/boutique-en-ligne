<?php
require_once 'inc/php/callToClasses.php';
if (!$user->isAdmin()) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="/boutique-en-ligne/inc/img/icons/favicon.png" />
    <!-- CSS -->
    <link rel="stylesheet" href="inc/css/style.css">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- Fontawesome kit -->
    <script src="https://kit.fontawesome.com/a05ac89949.js" crossorigin="anonymous"></script>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- JS -->
    <?php if ($user->isAdmin()) : ?>
        <script src="inc/js/scrollToTop.js"></script>
        <script src="inc/js/stickToTop.js"></script>
        <script src="inc/js/admin.js"></script>
        <script src="inc/js/adminThumbs.js"></script>
        <script src="inc/js/search.js"></script>
    <?php endif; ?>

    <script>
        /* Tabs script */
        function openTab(evt, information) {
            let i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace("active", "");
            }

            document.getElementById(information).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>

</head>

<body>

    <?php include 'inc/header.php'; ?>

    <main class="container mt-2">


        <h1>Admin</h1>
        <h1 class="bis">Admin</h1>
        <h4 class="mb-5">Welcome <?= $user->getLogin() ?></h4>

        <div class="tab admin">
            <button id="users" class="tablinks" onclick="openTab(event, 'member')">MEMBER MANAGEMENT</button>
            <button id="products" class="tablinks" onclick="openTab(event, 'product')">PRODUCT MANAGEMENT</button>
            <button id="categories" class="tablinks" onclick="openTab(event, 'category')">CATEGORY MANAGEMENT</button>
        </div>

        <!-- Tabs content -->
        <div id="member" class="tabcontent pt-3"> </div>
        <div id="product" class="tabcontent pt-3"> </div>
        <div id="category" class="tabcontent pt-3"> </div>

        <section id="gestion"></section>
        <section id="display"></section>
        <p></p>
        <section class="popup-container"></section>

    </main>

    <?php include 'inc/footer.php'; ?>

    <!-- Bootstrap js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.5 pl-5.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>