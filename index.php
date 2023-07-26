<?php require_once 'inc/php/callToClasses.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="/boutique-en-ligne/inc/img/icons/favicon.png" />
    <!-- CSS -->
    <link rel="stylesheet" href="inc/css/style.css">
    <!-- JQuery 3.6.4 -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- Lightbox2 2.11.3 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <!-- Fontawesome kit -->
    <script src="https://kit.fontawesome.com/a05ac89949.js" crossorigin="anonymous"></script>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- JS -->
    <script src="inc/js/stickToTop.js"></script>
    <script type="text/javascript" src="inc/js/scrollToTop.js"></script>
    <script type="text/javascript" src="inc/js/search.js"></script>
    <script src="inc/js/wishlist.js"></script>
    <script src="inc/js/features.js"></script>
</head>

<body>

    <?php include 'inc/header.php'; ?>

    <section class="hero">
        <div class="slogan">Veni, vedi,</div>
        <img class="logo_big" src="inc/img/design/logo_wt.png" alt="logo">
        <a href="./shop.php"><button class="btn btn-white fw-bold my-5 d-flex justify-items-center">SHOP NOW</button></a>
    </section>

    <main class="love">

        <!-- NEW COLLECTION -->
        <section class="container overflow-hidden">
            <h1>New Collection</h1>
            <h1 class="bis">New Collection</h1>
            <div id="new_collec" class="row my-5 gx-4">
            </div>
        </section> <!-- /container -->

        <!-- SPRING COLLECTION TEASER -->
        <section>
            <div class="photo w-100 d-flex my-5 pt-5">
                <span class="text-body-tertiary fs-3 lh-5 col-lg-6 align-content-center my-auto text-center">SPRING <br>COLLECTION</span>
            </div>
        </section>

        <!-- BEST SELLERS -->
        <section class="container overflow-hidden">
            <h1>Best Sellers</h1>
            <h1 class="ter">Best Sellers</h1>
            <div id="best_sellers" class="row my-5 gx-4">
            </div>
        </section>

    </main>

    <?php include 'inc/footer.php'; ?>

    <!-- Bootstrap js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Lightbox2 js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
    </script>

</body>

</html>