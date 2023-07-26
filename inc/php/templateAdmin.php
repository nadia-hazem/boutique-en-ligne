<?php
session_start();
require_once "../class/User.php";
require_once "../class/Product.php";
$user = new User();
$users = $user->getAll();
$product = new Product();
$tableSize = 'size';
$sizes = $product->getTable($tableSize);
$tableCategory = 'category';
$categories = $product->getTable($tableCategory);

// MEMBER MANAGEMENT --------------------------------
if (isset($_GET["users"])) :
?>
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="bg-light py-5">
                <tr>
                    <th scope="row" class="lead fw-medium">Login</th>
                    <th scope="row" class="lead fw-medium">Role</th>
                    <th scope="row" class="lead fw-medium">Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $cols => $value) {
                ?>
                    <tr>
                        <th class="fw-normal">
                            <?= $value["login"]; ?>
                        </th>
                        <th class="fw-normal">
                            <?= $value['role']; ?>
                        </th>
                        <?php if ($user->getLogin() != $value["login"]) { ?>
                            <th>
                                <form method="post" id="formRole">
                                    <select name="role" id="catchRole" data-id="<?= $value['id_user'] ?>" class="role">
                                        <option data-id="user" value="user">user</option>
                                        <option data-id="admin" value="admin">admin</option>
                                    </select>
                                    <input type="submit" class="changeDroit btn btn-sm btn-dark" id="changeDroit" data-id="<?= $value['id_user'] ?>" value="Change">
                                </form>

                            </th>
                            <th>
                                <p class="delUser" data-id="<?= $value['id_user'] ?>"><!----TRASHBIN--><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="delUser bi bi-trash3" data-id="<?= $value['id_user'] ?>" viewBox="0 0 16 16">
                                        <path class="delUser" data-id="<?= $value['id_user'] ?>" d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                    </svg></p>
                            </th>
                        <?php
                        } else {
                        ?>
                            <th>
                                <span>Current user</span>
                            </th>
                        <?php
                        }
                        ?>
                    </tr>
                <?php
                }

                ?>
            </tbody>

        </table>
    </div>

    <!-- PRODUCTS MANAGEMENT ---------------------------------->
<?php
elseif (isset($_GET["products"])) :
    if ($_GET['categ'] != "") {
        $products = $product->getAll($_GET['categ']);
    } else {
        $products = $product->getAll();
    }
?>
    <div class="row mb-5">
        <div class="col-6">
            <select class="filterCateg form-select form-select-lg mb-2" aria-label=".form-select-lg">
                <option value="" selected>Category</option>

                <?php foreach ($categories as $cols => $value) {
                ?>
                    <option value="<?= $value['id_category'] ?>"><?= $value['name'] ?></option>
                <?php
                } ?>
            </select>
        </div>
        <div class="col-6">
            <p class="lead">Select a category to filter products</p>
        </div>
    </div> <!-- end row -->

    <div class="table-responsive">
        <table class="table table-striped align-middle ">
            <thead>
                <tr>
                    <th scopr="row" class="lead fw-medium">PRODUCT</th>

                    <th scopr="row" class="lead fw-medium">REFERENCE</th>

                    <th scopr="row" class="lead fw-medium">CATEGORY</th>

                    <th scopr="row" class="lead fw-medium">SIZE</th>

                    <th scopr="row" class="lead fw-medium">STOCK</th>
                </tr>

            </thead>
            <tbody>

                <?php
                if ($products == "Nothing to show here !") {
                ?>
                    <tr>
                        <th class="fw-normal"><?= $products ?></th>
                    </tr>
                    <?php
                } else {
                    foreach ($products as $cols => $value) {
                        $categories = $product->getCategoryName($value['id_product']);
                    ?>
                        <tr>
                            <th class="fw-normal">
                                <span class="delProduct px-2" data-id="<?= $value['id_product'] ?>"><!----TRASHBIN--><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="delProduct bi bi-trash3" data-id="<?= $value['id_product'] ?>" viewBox="0 0 16 16">
                                        <path class="delProduct" data-id="<?= $value['id_product'] ?>" d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                    </svg><!--END-->
                                </span> <span class="changeProduct px-2" data-id="<?= $value['id_product'] ?>"><!------CRAYON--><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="grey" class="changeProduct bi bi-pencil-fill" data-id="<?= $value['id_product'] ?>" viewBox="0 0 16 16">
                                        <path class="changeProduct" data-id="<?= $value['id_product'] ?>" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                    </svg><!--END-->
                                </span> <?= $value['title'] ?>
                            </th>
                            <th class="fw-normal"><?= $value['id_product'] ?></th>
                            <th class="fw-normal">
                                <?php
                                foreach ($categories as $category) {
                                    echo $category['name'] . ", ";
                                } ?></th>
                            <th class="fw-normal">
                                <select class="displayStock form-select form-select mb-2" aria-label=".form-select" name="size" data-id="<?= $value['id_product'] ?>">
                                    <option value="" selected disabled>Select a size</option>
                                    <?php
                                    // size for current product
                                    $sizesProduct = $product->getSize($value['id_product']);
                                    foreach ($sizesProduct as $cols => $valueSize) {
                                    ?>
                                        <option value="<?= $valueSize['id_size'] ?>"><?= $valueSize['size'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </th>
                            <!-- stock display -->
                            <th class="fw-normal"></th>
                        </tr>

                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>


    <!-- PRODUCT MANAGEMENT ---------------------------------->
<?php
elseif (isset($_GET["changeProduct"])) :
    $id = $_GET["changeProduct"];
    $product_info = $product->getProductInfo($id);
    $category = $product->getCategoryName($id);
    $size = $product->getSize($id);
    $title = $product_info['title'];
    $price = $product_info['price'] / 100;
    $image = $product_info['image'];
    $image1 = $product_info['image_1'];
    $image2 = $product_info['image_2'];
    $promotion = $product_info['promotion'];
    $percentage = $product_info['promotion_percentage'];
    $description = $product_info['description'];
    $bestSellers = $product_info['best_sellers'];
    $newCollection = $product_info['new_collection'];
    // Put each size in an array
    $sizesProduct = array();
    foreach ($size as $cols => $value) {
        array_push($sizesProduct, $value['size']);
    }
?><div class="popup position-relative">
        <span class="closePopUp position-absolute"><!----- CLOSE svg--><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="closePopUp bi bi-x-square-fill" viewBox="0 0 16 16">
                <path class="closePopUp" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z" />
            </svg><!--END-->
        </span>
        <div class="row">
            <div class="col-md-4">
                <img class="product_img fw-light" src="inc/img/shop/<?= $image ?>" alt="<?= $title ?> ">
                <div class="thumbnails">
                    <img class="thumbnail" src="inc/img/shop/<?= $image ?>" data-full-image="inc/img/shop/<?= $image ?>">
                    <?php
                    if ($image1 != "") { ?>
                        <img class="thumbnail" src="inc/img/shop/<?= $image1 ?>" data-full-image="inc/img/shop/<?= $image1 ?>">
                    <?php }
                    if ($image2 != "") { ?>
                        <img class="thumbnail" src="inc/img/shop/<?= $image2 ?>" data-full-image="inc/img/shop/<?= $image2 ?>">
                    <?php } else { ?>
                        <img class="thumbnail" src="inc/img/shop/default.png" data-full-image="inc/img/shop/<?= $image ?>">
                    <?php } ?>

                </div>
            </div>
            <!-- image thumbnails -->
            <script src="inc/js/thumbnails.js"></script>

            <div class="col-md-6">
                <div class="small mb-3">
                    <p class="text"><em>Category :</em> <span class="lead">
                            <?php foreach ($category as $categ) {
                                echo $categ['name'] . ", ";
                            } ?></span></p>
                </div>
                <h2 class="display-5 fw-light my-3"><?php echo $title ?></h2>
                <div class=" my-3 ">
                    <!-- Size with Stock-->
                    <div class="table-responsive">
                        <table class="table bg-light">
                            <thead>
                                <tr>
                                    <th class="table-secondary fw-normal">Size</th>
                                    <th class="table-secondary fw-normal">Stock</th>
                                    <th class="table-secondary fw-normal">Refill</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($size as $value) {
                                    $stock = $product->getStock($id, $value['id_size']);
                                ?>
                                    <tr>
                                        <th class="sizeName"><?= $value['size'] ?></th>
                                        <th class="stock"><?= $stock['stock'] ?></th>
                                        <th>
                                            <input type="number" class="changeStock" data-id="<?= $value['id_size'] ?>" data-product="<?= $id ?>" value="0" min="0">
                                        </th>
                                    </tr>
                                <?php
                                }
                                // Add size -----------------
                                ?>
                                <tr>
                                    <th>
                                        <select class="addSize form-select" aria-label=".form-select" name="size" data-id="<?= $id ?>">
                                            <option value="" selected disabled>Choose a size</option>
                                            <?php
                                            // size pour le produit en cours
                                            foreach ($sizes as $cols => $valueSize) {
                                                if (!in_array($valueSize['size'], $sizesProduct)) {
                                            ?>
                                                    <option value="<?= $valueSize['id_size'] ?>"><?= $valueSize['size'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </th>
                                    <th>
                                        <input type="number" class="addStock" data-id="<?= $id ?>" value="0" min="0">
                                    </th>
                                    <th>
                                        Add size
                                    </th>

                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row my-3">
                        <div class="col">
                            <!-- Best Seller/ New collection with radio checked or not-->
                            <?php if ($newCollection == 1) { ?>
                                <input type="radio" name="newCollection" class="newCollection p-2 m-2" data-id="<?= $id ?>" data-value="checked" checked><span class="pr-5">New Collection</span>
                            <?php } else { ?>
                                <input type="radio" name="newCollection" class="newCollection p-2 m-2" data-id="<?= $id ?>" data-value="unchecked"><span class="pr-5">New Collection
                                <?php } ?>
                        </div>
                        <div class="col">
                            <?php if ($bestSellers == 1) { ?>
                                <input type="radio" name="bestSeller" class="bestSeller p-2 m-2" data-id="<?= $id ?>" data-value="checked" checked><span class="pr-5">Best Seller
                                <?php } else { ?>
                                    <input type="radio" name="bestSeller" class="bestSeller p-2 m-2" data-id="<?= $id ?>" data-value="unchecked"><span class="pr-5">Best Seller
                                    <?php } ?>
                        </div>
                    </div>

                    <!--  Price & Promotion -->
                    <?php
                    if ($promotion == 1) {
                        $newPrice = $price - ($price * $percentage / 100);
                    ?>
                        <p class="lead my-3"><?= '<del>' . $price . '€</del> &nbsp;-' . $percentage . '% &nbsp;' . $newPrice . '€' ?> </p>
                    <?php
                    } else {
                    ?>
                        <p class="lead fw-medium my-3"><?= $price ?>€</p>
                    <?php
                    } ?>

                    <select name="promotion" class="promotion form-select form-select-sm my-3" aria-label=".form-select-sm" data-id="<?= $id ?>">
                        <option value="" selected disabled>Choose a promotion</option>
                        <option value="0">Not on sale</option>
                        <option value="5">5%</option>
                        <option value="10">10%</option>
                        <option value="20">20%</option>
                        <option value="50">50%</option>
                        <option value="75">75%</option>
                    </select>


                    <!-- Description -->
                    <p class="lead"><?php echo $product_info['description'] ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD PRODUCT ---------------------------------->
<?php
elseif (isset($_GET["addProducts"])) :
?>

    <div class="container bg-light shadow px-5 my-5 py-2">

        <form method="POST" id="formProduct" class="">

            <div class="row mt-5 mb-3"> <!--TITLE & DESCRIPTION-->
                <div class="col-lg-6 col-sm-12">
                    <label for="title">Title <span class="red">*</span></label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                    <label for="descritpion">Description <span class="red">*</span></label>
                    <input type="text" name="description" class="form-control">
                </div>
            </div> <!--END ROW-->
            <div class="row d-flex mb-3"> <!--PHOTOS-->
                <div class="col-lg-4 col-sm-12">
                    <label for="imageProduct">photo 1 <span class="red">*</span></label>
                    <input type="file" name="imageProduct" class="form-control" required>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <label for="imageProduct_1">photo 2</label>
                    <input type="file" name="imageProduct_1" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                    <label for="imageProduct_2">photo 3</label>
                    <input type="file" name="imageProduct_2" class="form-control">
                </div>
            </div> <!--END ROW-->
            <div class="row d-flex mb-3"> <!--CATEGORY-->
                <div class="col-lg-3 col-sm-12">
                    <label for="category">Category <span class="red">*</span></label>
                    <select class="form-select form-select mb-2" aria-label=".form-select" name="category">
                        <option value="" disabled selected>Select category</option>
                        <?php
                        foreach ($categories as $cols => $value) {
                        ?>
                            <option value="<?= $value['id_category'] ?>"><?= $value['name'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div> <!--END ROW-->
            <div class="container">
                <div class="row d-flex mb-3"> <!--SIZE-->
                    <div class="sizeDiv col-lg-3 col-sm-12">
                        <label for="size">Size <span class="red">*</span></label>
                        <select class="selectSize form-select form-select mb-2" aria-label=".form-select" name="size">
                            <option value="" disabled selected>Size</option>
                            <?php
                            foreach ($sizes as $cols => $value) {
                            ?>
                                <option value="<?= $value['id_size'] ?>"><?= $value['size'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-sm-12"> <!--STOCK-->
                        <label for="stock">Stock <span class="red">*</span></label>
                        <input type="number" name="stock" min="1" class="form-control">
                    </div>
                </div> <!--END ROW-->
                <div class="row d-flex mb-3"> <!-- BUTTON size-->
                    <button data-id="size2" class="addSize btn btn-dark mt-4"><span>+</span> Add a new size</button>
                </div> <!--END ROW-->
            </div> <!--END CONTAINER-->

            <div class="row d-flex mb-3"> <!--PRICE-->
                <div class="col-4">
                    <label for="price">Price <span class="red">*</span></label>
                    <input type="number" name="priceEuro" min="1" id="euros" placeholder="00" class="form-control text-right">
                </div>
                <div class="col-1">
                    <label></label>
                    <p class="my-auto mx-0 px-0 fs-5">,</p>
                </div>
                <div class="col-4">
                    <label></label>
                    <input type="number" name="priceCentime" min="0" id="centimes" placeholder="00" class="form-control text-right">
                </div>
                <div class="col-1">
                    <label></label>
                    <p class="mt-1 mx-0 px-0 fs-5">€</p>
                </div>
            </div> <!--END ROW-->
            <div class="row d-flex my-5"> <!--BUTTON submit-->
                <input type="submit" name="add" value="ADD" class="submitAdd btn btn-dark">
            </div> <!--END ROW-->

        </form> <!--END FORM-->

    </div> <!--END CONTAINER-->


    <!-- ADD A SIZE -------------------------------------------->
<?php // if size 2 is added
elseif (isset($_GET["size2"])) :
?>
    <div class="row d-flex mb-3"> <!--SIZE 2-->
        <div class="sizeDiv col-lg-3 col-sm-12">
            <label for="size2">Size</label>
            <select class="selectSize form-select form-select mb-2" aria-label=".form-select" name="size2">
                <option value="" disabled selected>Size</option>
                <?php
                foreach ($sizes as $cols => $value) {
                ?>
                    <option value="<?= $value['id_size'] ?>"><?= $value['size'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="col-lg-3 col-sm-12"> <!--STOCK 2-->
            <label for="stock2">Stock</label>
            <input type="number" name="stock2" min="1" class="form-control">
        </div>
    </div> <!--END ROW-->
    <div class="row d-flex mb-3"> <!--BUTTON-->
        <button data-id="size3" class="addSize btn btn-dark mt-4"><span>+</span>add a new size </button>
    </div> <!--END ROW-->

<?php // if size 3 is added
elseif (isset($_GET["size3"])) :
?>
    <div class="row d-flex mb-3"> <!--SIZE 3-->
        <div class="sizeDiv col-lg-3 col-sm-12">
            <label for="size3">Size</label>
            <select class="selectSize form-select form-select mb-2" aria-label=".form-select" name="size3">
                <option value="" disabled selected>Size</option>
                <?php
                foreach ($sizes as $cols => $value) {
                ?>
                    <option value="<?= $value['id_size'] ?>"><?= $value['size'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="col-lg-3 col-sm-12"> <!--STOCK 3-->
            <label for="stock3">Stock</label>
            <input type="number" name="stock3" min="1" class="form-control">
        </div>
    </div> <!--END ROW-->
    <div class="row d-flex mb-3"> <!--BUTTON-->
        <button data-id="size4" class="addSize btn btn-dark mt-4"><span>+</span>add a new size </button>
    </div> <!--END ROW-->

<?php // if size 4 is added
elseif (isset($_GET["size4"])) :
?>
    <div class="row d-flex mb-3"> <!--SIZE 4-->
        <div class="sizeDiv col-lg-3 col-sm-12">
            <label for="size4">Size</label>
            <select class="selectSize form-select form-select mb-2" aria-label=".form-select" name="size4">
                <option value="" disabled selected>Size</option>
                <?php
                foreach ($sizes as $cols => $value) {
                ?>
                    <option value="<?= $value['id_size'] ?>"><?= $value['size'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="col-lg-3 col-sm-12"> <!--STOCK 4-->
            <label for="stock4">Stock</label>
            <input type="number" name="stock4" min="1" class="form-control">
        </div>
    </div> <!--END ROW-->
    <div class="row d-flex mb-3"> <!--BUTTON submit-->
        <button data-id="size5" class="addSize  btn btn-dark mt-4"><span>+</span>add a new size </button>
    </div> <!--END ROW-->

<?php // if size 5 is added
elseif (isset($_GET["size5"])) :
?>
    <div class="row d-flex mb-3"> <!--SIZE 5-->
        <div class="sizeDiv col-lg-3 col-sm-12">
            <label for="size5">Size</label>
            <select class="selectSize form-select form-select mb-2" aria-label=".form-select" name="size5">
                <option value="" disabled selected>Size</option>
                <?php
                foreach ($sizes as $cols => $value) {
                ?>
                    <option value="<?= $value['id_size'] ?>"><?= $value['size'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="col-lg-3 col-sm-12"> <!--STOCK 5-->
            <label for="stock5">Stock</label>
            <input type="number" name="stock5" min="1" class="form-control">
        </div>
    </div> <!--END ROW-->
    <div class="row d-flex mb-3"> <!--BUTTON submit-->
        <button data-id="size6" class="addSize btn btn-dark mt-4"><span>+</span>add a new size </button>
    </div> <!--END ROW-->

<?php // if size 6 is added
elseif (isset($_GET["size6"])) :
?>
    <div class="row d-flex mb-3"> <!--SIZE 6-->
        <div class="sizeDiv col-lg-3 col-sm-12">
            <label for="size6">Size</label>
            <select class="selectSize orm-select form-select mb-2" aria-label=".form-select" name="size6">
                <option value="" disabled selected>Size</option>
                <?php
                foreach ($sizes as $cols => $value) {
                ?>
                    <option value="<?= $value['id_size'] ?>"><?= $value['size'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="col-lg-3 col-sm-12"> <!--STOCK 6-->
            <label for="stock6">Stock</label>
            <input type="number" name="stock6" min="1" class="form-control">
        </div>
    </div> <!--END ROW-->


    <!-- CATEGORIES MANAGEMENT -------------------------------------------->
<?php
elseif (isset($_GET["categories"])) :
?>
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="bg-light py-5">
                <tr>
                    <th scope="row" class="lead fw-medium">MANAGE</th>
                    <th scope="row" class="lead fw-medium">CATEGORY</th>
                </tr>

            </thead>
            <tbody>
                <?php
                foreach ($categories as $col => $value) {


                ?>
                    <tr>
                        <th>
                            <span class="delCategory" data-id="<?= $value['id_category'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="delCategory bi bi-trash3" data-id="<?= $value['id_category'] ?>" viewBox="0 0 16 16">
                                    <path class="delCategory" data-id="<?= $value['id_category'] ?>" d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg>
                            </span>
                            <span class="changeCategory" data-id="<?= $value['id_category'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="grey" class="changeCategory bi bi-pencil-fill" data-id="<?= $value['id_category'] ?>" viewBox="0 0 16 16">
                                    <path class="changeCategory" data-id="<?= $value['id_category'] ?>" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                </svg><!--END-->
                            </span>
                        </th>
                        <th class="fw-normal">
                            <?= $value['name'] ?>
                        </th>
                    </tr>
                <?php
                } ?>
            </tbody>
        </table>
    </div>

<?php
elseif (isset($_GET["addCategories"])) :
?>
    <div class="container bg-grey p-3 my-3">
        <form method="POST" id="addCategory">
            <div class="row mt-5">
                <label for="category" class="lead">Add a category</label>
                <div class="col-6">
                    <input type="text" name="category" class="form-control">
                </div>
                <div class="col-6">
                    <button class="validate btn btn-dark px-5 mb-5">ADD</button>
                </div>
            </div>
        </form>
    </div>
<?php
elseif (isset($_GET["changeCategory"])) :
    $category = $product->getCategory($_GET["changeCategory"]);
?>
    <div class="popup position-relative align-content-center w-100">
        <span class="closePopUp position-absolute"><!----- CLOSE svg--><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="closePopUp bi bi-x-square-fill" viewBox="0 0 16 16">
                <path class="closePopUp" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z" />
            </svg><!--END-->
        </span>
        <form method="POST" id="UpdateCategory">
            <div class="row align-items-center my-5">
                <div class="col-12 text-center">
                    <label for="category" class="lead mb-3">Change the category</label>
                    <input type="text" name="category" class="form-control mx-auto w-50" value="<?= $category['name'] ?>">
                    <input type="hidden" name="id_category" value="<?= $_GET["changeCategory"] ?>">
                </div>
            </div>
            <div class="col-12 text-center">
                <button class="validate btn btn-dark mt-5">CHANGE</button>
            </div>
        </form>
    </div>
<?php
endif;
