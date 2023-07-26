<?php
session_start();
require_once '../class/Product.php';
require_once '../class/User.php';
require_once '../class/Wishlist.php';
$Product = new Product();
$user = new User();
$wishlist = new Wishlist();
if ($user->isLogged()) {
    $user_id = $_SESSION['user']['id'];
    $wishproduct = $wishlist->getWishlistItems($user_id);
    $favorites = [];
    foreach ($wishproduct as $wish) {
        $wishproduct = $wish['id_product'];
        // push dans le tableau
        array_push($favorites, $wishproduct);
    }
}
$limit = 4;

// SHOP
if (isset($_GET['category_id'])) :
    if (!empty($_GET['category_id'])) {
        $categoryId = $_GET['category_id'];
        $products = $Product->getAll($categoryId);
        $Categ = $Product->getCategory($categoryId);
        $nameCateg = $Categ['name'];
    } else {
        $products = $Product->getAll();
        $nameCateg = "All";
    }
    if ($products === 'Nothing to show here !') {
        echo $products;
    } else {
?>
        <div class="container overflow-hidden">
            <h2>
                <hr><?= $nameCateg ?>
                <hr>
            </h2>
            <div class="row my-0 gx-4">
                <?php
                foreach ($products as $result) :
                    $id = $result['id_product'];
                    $title = $result['title'];
                    $price = $result['price'];
                    $image = $result['image'];
                    $image1 = $result['image_1'];
                    $image2 = $result['image_2'];
                    $promotion = $result['promotion'];
                    $percentage = $result['promotion_percentage'];
                    $price = $price / 100;
                    $newPrice = $price - ($price * $percentage / 100);
                ?>
                    <!-- card -->
                    <div class="col-lg-3 col-md-6 col-sm-12 p-3">
                        <div class="position-relative shadow-lg mb-5">
                            <h4 class="card-title text-center p-3"><?= $title ?></h4>
                            <?php $images = [$image, $image1, $image2]; ?>
                            <?php foreach ($images as $index => $image) : ?>
                                <?php if (!empty($image) && $index === 0) : ?>
                                    <a href="./inc/img/shop/<?= $image ?>" data-lightbox="<?= $title ?>">
                                        <img src="./inc/img/shop/<?= $image ?>" alt="<?= $title ?>" class="img-fluid">
                                    </a>
                                <?php elseif (!empty($image) && $index !== 0) : ?>
                                    <a href="./inc/img/shop/<?= $image ?>" data-lightbox="<?= $title ?>" style="display:none;"></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <div class="bottom-menu shadow bg-dark position-absolute w-100 py-2">
                                <div class="d-flex justify-content-between px-3">
                                    <div class="d-flex">
                                        <!-- love -->
                                        <?php if ($user->isLogged()) { ?>
                                            <?php if (in_array($id, $favorites)) { ?>
                                                <i class="clicked heart fas fa-heart px-2 pt-1" data-id="<?= $id ?>"></i></a>
                                            <?php } else { ?>
                                                <i class="heart fas fa-heart px-1 pt-1" data-id="<?= $id ?>"></i></a>
                                            <?php } ?>
                                        <?php } ?>
                                        <!-- Go product -->
                                        <a href="product.php?id=<?= $id ?>" class="px-1"><i class="fas fa-search"></i></a>
                                    </div>
                                    <div class="d-flex">
                                        <!-- price -->
                                        <?php if ($promotion == 1) : ?>
                                            <?php $newPrice = $price - ($price * $percentage / 100); ?>
                                            <p class="card-text text-white my-auto"><?= '<del>' . $price . '€</del> &nbsp;-' . $percentage . '% &nbsp;' . $newPrice . '€' ?></p>
                                        <?php else : ?>
                                            <p class="card-text text-white my-auto"><?= $price ?>€</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    <?php
    }; ?>
    <?php
// INDEX -- PROFIL -- 
elseif (isset($_GET['limit'])) :
    if (isset($_GET['new'])) {
        $categ = 'new_collection';
        $products = $Product->getRandomCateg($categ, $limit);
    } elseif (isset($_GET['best'])) {
        $categ = 'best_sellers';
        $products = $Product->getRandomCateg($categ, $limit);
    } elseif (isset($_GET['promo'])) {
        $categ = 'promotion';
        $products = $Product->getRandomCateg($categ, $limit);
    }
    // CARDS
    if ($products == "Nothing to show here!") {
        echo $products;
    } else {

        foreach ($products as $result) :
            $id = $result['id_product'];
            $title = $result['title'];
            $price = $result['price'];
            $image = $result['image'];
            $image1 = $result['image_1'];
            $image2 = $result['image_2'];
            $promotion = $result['promotion'];
            $percentage = $result['promotion_percentage'];
            $price = $price / 100;
            $newPrice = $price - ($price * $percentage / 100);
    ?>

            <!-- card -->
            <div class="col-lg-3 col-md-6 col-sm-12 p-3 justify-content-center">
                <div class="position-relative shadow-lg mb-5">
                    <h4 class="card-title  text-center p-3"><?= $title ?></h4>
                    <?php $images = [$image, $image1, $image2]; ?>
                    <?php foreach ($images as $index => $image) : ?>
                        <?php if (!empty($image) && $index === 0) : ?>
                            <a href="./inc/img/shop/<?= $image ?>" data-lightbox="<?= $title ?>">
                                <img src="./inc/img/shop/<?= $image ?>" alt="<?= $title ?>" class="img-fluid">
                            </a>
                        <?php elseif (!empty($image) && $index !== 0) : ?>
                            <a href="./inc/img/shop/<?= $image ?>" data-lightbox="<?= $title ?>" style="display:none;"></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <div class="bottom-menushadow bg-dark position-absolute w-100 py-2">
                        <div class="d-flex justify-content-between px-3">
                            <div class="d-flex">
                                <!-- love -->
                                <?php if ($user->isLogged()) { ?>
                                    <?php if (in_array($id, $favorites)) { ?>
                                        <i class="clicked heart fas fa-heart px-2 pt-1" data-id="<?= $id ?>"></i></a>
                                    <?php } else { ?>
                                        <i class="heart fas fa-heart px-1 pt-1" data-id="<?= $id ?>"></i></a>
                                    <?php } ?>
                                <?php } ?>
                                <!-- Go product -->
                                <a href="product.php?id=<?= $id ?>" class="ico px-1"><i class="fas fa-search"></i></a>
                            </div>
                            <div class="d-flex">
                                <!-- price -->
                                <?php if ($promotion == 1) : ?>
                                    <?php $newPrice = $price - ($price * $percentage / 100); ?>
                                    <p class="card-text text-white my-auto"><?= '<del>' . $price . '€</del> &nbsp;-' . $percentage . '% &nbsp;' . $newPrice . '€' ?></p>
                                <?php else : ?>
                                    <p class="card-text text-white my-auto"><?= $price ?>€</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /card -->

        <?php endforeach; ?>
        <div class="d-flex justify-content-center">
            <a class="" href="shop.php?category_id=7" data-id="7"><button class="btn btn-dark my-5">SEE ALL</button></a>
        </div>
<?php
    }
endif;
?>