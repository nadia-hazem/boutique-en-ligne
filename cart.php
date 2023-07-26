<?php require_once 'inc/php/callToClasses.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="/boutique-en-ligne/inc/img/icons/favicon.png" />
    <!-- CSS -->
    <link rel="stylesheet" href="inc/css/style.css">
    <!-- jQuery 3.6.4 -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- Fontawesome kit -->
    <script src="https://kit.fontawesome.com/a05ac89949.js" crossorigin="anonymous"></script>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- JS -->
    <script src="inc/js/scrollToTop.js"></script>
    <script src="inc/js/stickToTop.js"></script>
    <script src="inc/js/cart.js"></script>
    <script src="inc/js/features.js"></script>
    <script src="inc/js/wishlist.js"></script>
    <script src="inc/js/search.js"></script>

</head>

<body>

    <?php
    include 'inc/header.php';
    require_once "inc/class/Cart.php";
    $cart = new Cart();

    ?>

    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <h1>Cart</h1>
            <h1 class="ter">Cart</h1>
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <a href="shop.php" class="lead d-inline pt-5 ps-4"><i class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a>
                        <hr>
                        <div class="card-body p-4">

                            <div class="row">

                                <div class="productsCart col-lg-7">
                                </div> <!-- end of col-lg-8 -->

                                <!-- Card details -->
                                <div class="pay col-lg-5">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="popup-container"></section>

    <!-- BEST SELLERS -->
    <section class="love container overflow-hidden">
        <h1>Best Sellers</h1>
        <h1 class="ter">Best Sellers</h1>
        <div id="best_sellers" class="row my-5 gx-4">
        </div>
    </section>

    <?php include 'inc/footer.php'; ?>

    <!-- Bootstrap js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>