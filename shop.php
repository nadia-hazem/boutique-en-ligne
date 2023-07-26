<?php require_once 'inc/php/callToClasses.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="/boutique-en-ligne/inc/img/icons/favicon.png" />
    <!-- CSS -->
    <link rel="stylesheet" href="inc/css/style.css">
    <!-- jQuery 3.6.4 -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- Lightbox2 2.11.3 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <!-- Fontawesome kit -->
    <script src="https://kit.fontawesome.com/a05ac89949.js" crossorigin="anonymous"></script>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- JS -->
    <script src="inc/js/scrollToTop.js"></script>
    <script src="inc/js/stickToTop.js"></script>
    <script src="inc/js/menu.js"></script>
    <script src="inc/js/search.js"></script>
    <script src="inc/js/wishlist.js"></script>
    <script src="inc/js/features.js"></script>
</head>

<body>
    <?php include 'inc/header.php'; ?>

    <main class="mt-0">

        <section class="shop_hero">
            <h1>SHOP</h1>
            <h1 class="bis">SHOP</h1>
        </section>

        <!-- Icons -->
        <section class="bg-shopmenu shadow-lg text-center  w-100 px-5 py-2 mb-0">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="btn btn-default square-button shadow m-3 col-lg col-md-1 col-sm-1">
                        <div class="square-button-content">
                            <a class="category_link" href="" data-id="1"><img class="img-fluid" src="inc/img/icons/accessory.png" alt="Accessory" data-id="1"></a>
                        </div>
                    </div>
                    <div class="btn btn-default square-button shadow m-3 col-lg col-md-1 col-sm-1">
                        <div class="square-button-content">
                            <a class="category_link" href="" data-id="4"><img class="img-fluid" src="inc/img/icons/coat.png" alt="Coat" data-id="4"></a>
                        </div>
                    </div>
                    <div class="btn btn-default square-button shadow m-3 col-lg col-md-1 col-sm-1">
                        <div class="square-button-content">
                            <a class="category_link" href="" data-id="5"><img class="img-fluid" src="inc/img/icons/dress.png" alt="Dress" data-id="5"></a>
                        </div>
                    </div>
                    <div class="btn btn-default square-button shadow m-3 col-lg col-md-1 col-sm-1">
                        <div class="square-button-content">
                            <a class="category_link" href="" data-id="3"><img class="img-fluid" src="inc/img/icons/pants.png" alt="Bottoms" data-id="3"></a>
                        </div>
                    </div>
                    <div class="btn btn-default square-button shadow m-3 col-lg col-md-1 col-sm-1">
                        <div class="square-button-content">
                            <a class="category_link" href="" data-id="9"><img class="img-fluid" src="inc/img/icons/sportswear.png" alt="Sportswear" data-id="9"></a>
                        </div>
                    </div>
                    <div class="btn btn-default square-button shadow m-3 col-lg col-md-1 col-sm-1">
                        <div class="square-button-content">
                            <a class="category_link" href="" data-id="10"><img class="img-fluid" src="inc/img/icons/suit.png" alt="Suit" data-id="10"></a>
                        </div>
                    </div>
                    <div class="btn btn-default square-button shadow m-3 col-lg col-md-1 col-sm-1">
                        <div class="square-button-content">
                            <a class="category_link" href="" data-id="11"><img class="img-fluid" src="inc/img/icons/top.png" alt="Tops" data-id="11"></a>
                        </div>
                    </div>
                    <div class="btn btn-default square-button shadow m-3 col-lg col-md-1 col-sm-1">
                        <div class="square-button-content">
                            <a class="category_link" href="" data-id="6"><img class="img-fluid" src="inc/img/icons/underwear.png" alt="Loungewear" data-id="6"></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="title"></div>
        <!-- Products fetch container -->
        <div id="products_container" class="container d-flex flex-wrap my-5 love"> </div>


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
    <!-- Lightbox2 2.11.3 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
    </script>

</body>

</html>