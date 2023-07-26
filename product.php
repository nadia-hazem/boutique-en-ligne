<?php require_once 'inc/php/callToClasses.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
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
    <script src="inc/js/search.js"></script>
    <script src="inc/js/cart.js"></script>
    <script src="inc/js/wishlist.js"></script>
    <script src="inc/js/features.js"></script>
    <script src="inc/js/comment.js"></script>

</head>

<body>

    <?php include 'inc/header.php'; ?>

    <main class="container my-5">
        <?php
        $id = $_GET['id'];
        $product_info = $product->getProductInfo($id);
        $categories = $product->getCategoryName($id);
        $image = $product_info['image'];
        $image1 = $product_info['image_1'];
        $image2 = $product_info['image_2'];
        $title = $product_info['title'];

        // size for current product
        $sizesProduct = $product->getSize($id);
        ?>


        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">

                <?php $images = [$image, $image1, $image2]; ?>
                <?php foreach ($images as $index => $image) : ?>
                    <?php if (!empty($image) && $index === 0) : ?>
                        <a href="inc/img/shop/<?= $image ?>" data-lightbox="<?= $title ?>">
                            <img src="inc/img/shop/<?= $image ?>" alt="<?= $title ?>" class="product_img img-fluid">
                        </a>
                    <?php elseif (!empty($image) && $index !== 0) : ?>
                        <a href="inc/img/shop/<?= $image ?>" data-lightbox="<?= $title ?>" style="display:none;"></a>
                    <?php endif; ?>
                <?php endforeach; ?>

                <div class="thumbnails">
                    <img class="thumbnail" src="inc/img/shop/<?= $product_info['image'] ?>" data-full-image="inc/img/shop/<?= $product_info['image'] ?>">
                    <?php
                    if ($product_info['image_1'] != "") { ?>
                        <img class="thumbnail" src="inc/img/shop/<?= $product_info['image_1'] ?>" data-full-image="inc/img/shop/<?= $product_info['image_1'] ?>">
                    <?php }
                    if ($product_info['image_2'] != "") { ?>
                        <img class="thumbnail" src="inc/img/shop/<?= $product_info['image_2'] ?>" data-full-image="inc/img/shop/<?= $product_info['image_2'] ?>">
                    <?php } else { ?>
                        <img class="thumbnail" src="inc/img/shop/default.png" data-full-image="inc/img/shop/<?= $product_info['image'] ?>">
                    <?php } ?>

                </div>
            </div>

            <div class="col-md-6">
                <div class="small mb-5">Categories:
                    <?php foreach ($categories as $category) {
                        echo $category['name'] . ', ';
                    } ?></div>
                <h2 class="display-5 fw-bolder my-5"><?php echo $product_info['title'] ?></h2>
                <div class="fs-5 mb-5">
                    <!-- Quantity -->
                    <p class="">Quantity :
                        <input type="number" name="quantity" id="quantity" min="1" max="10" value="1">
                    </p>
                    <!-- Size -->

                    <p class="">Size :
                        <select name="size" id="size">
                            <?php foreach ($sizesProduct as $cols => $valueSize) {
                            ?>
                                <option value="<?= $valueSize['size'] ?>"><?= $valueSize['size'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </p>
                    <?php if ($product_info['promotion'] == 1) {
                        $price = $product_info['price'] / 100;
                        $percentage = $product_info['promotion_percentage'];
                        $newPrice = $price - ($price * $percentage / 100);
                    ?>
                        <h3 class="py-5"><?= '<del>' . $price . '€</del> &nbsp;-' . $percentage . '% &nbsp;' . $newPrice ?>€</h3>
                    <?php } else { ?>
                        <h3 class="py-5"><?= $product_info['price'] / 100; ?>€</h3>
                    <?php } ?>
                    <p class="lead"><?= $product_info['description'] ?></p>
                </div>

                <!-------------------------- ADD TO CART ------------------------------>

                <div class="love d-flex mb-5">
                    <i class="heart heart-bk fas fa-heart px-2 pt-2" data-id="<?= $id ?>">Add to wishlist</i>

                    <?php if ($user->isLogged()) { ?>
                        <button id="add_to_cart" class="connected btn btn-outline-dark flex-shrink-0 mx-1" type="button" data-id="<?= $id ?>">
                            <i class="fas fa-shopping-cart me-1"></i>
                            Add to cart
                        </button>
                    <?php } else { ?>
                        <button id="add_to_cart" class="btn btn-outline-dark flex-shrink-0 mx-1" type="button" data-id="<?= $id ?>">
                            <i class="fas fa-shopping-cart me-1"></i>
                            Add to cart
                        </button>
                    <?php } ?>
                    <p></p>

                </div>
                <!----------------------------------------------------------------------->

                <div class="d-flex mt-5 justify-content-around">
                    <i class="fab fa-2x fa-cc-visa"></i>
                    <i class="fab fa-2x fa-cc-mastercard"></i>
                    <i class="fab fa-2x fa-cc-paypal"></i>
                    <i class="fab fa-2x fa-cc-amex"></i>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <hr class="my-5">
            <div class="col-md-6">
                <h3>Informations</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Fusce tempor id sapien in sollicitudin. Cras ut ex quis nibh g
                    ravida facilisis. Proin tincidunt ante ac ipsum eleifend mattis.</p>
            </div>
            <div class="col-md-6">
                <h3>Shipping</h3>
                <p>Duis euismod lobortis urna vitae vestibulum. Morbi ipsum massa, viverra a massa nec, mattis sagittis lorem. Suspendisse aliquet scelerisque libero, id cursus elit semper hendrerit. Etiam pulvinar gravida velit ut tempus. Suspendisse sagittis enim vitae interdum aliquam.</p>
            </div>
        </div>


        <!-- BEST SELLERS -->
        <section class="container overflow-hidden">
            <h1>Best Sellers</h1>
            <h1 class="ter">Best Sellers</h1>
            <div id="best_sellers" class="row my-5 gx-4">
            </div>
        </section>


        <!-------------------------- COMMENTS ------------------------------>
        <section class="comment_section"></section>

    </main>

    <?php include 'inc/footer.php'; ?>

    <!-- Bootstrap js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Lightbox2 js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <!-- image thumbnails -->
    <script src="inc/js/thumbnails.js"></script>

    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
    </script>

</body>

</html>