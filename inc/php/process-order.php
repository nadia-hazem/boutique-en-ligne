<?php
session_start();
require_once "../class/User.php";
require_once "../class/Product.php";
require_once "../class/Cart.php";
$user = new User();
$product = new Product();
$cart = new Cart();

$id = $user->getUserId();
$login = $user->getLogin();
if (isset($_GET["cart"])) {

    // $displaTitle = $product->getProductInfo($displayCart[0]["id_product"]);
    $carts = $cart->getCart($id);
?>



    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="mb-1">Shopping cart</p>
            <?php if ($carts == "Nothing to show here !") {
            ?>
                <p class="mb-0">Your cart is empty</p>
            <?php
            } else {
                $count = count($carts)
            ?>
                <p class="mb-0">You have <?= $count ?> different items in your cart</p>
            <?php
            }
            ?>
        </div>
    </div>
    <?php
    if ($carts !== "Nothing to show here !") {
        foreach ($carts as $order) {
            $id_pro = $order['id_product'];
            $item = $product->getProductInfo($id_pro);
            $price = $item['price'] / 100;
            $promotion = $item['promotion'];
            $size = $order["size"];
            $id_order = $cart->cartVerify($id);

    ?>
            <div class="card mb-3">
                <div class="card-body shadow p-3 bg-white rounded">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <div>
                                <img src="inc/img/shop/<?= $item['image'] ?>" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                            </div>
                            <div class="ms-3" id="article">
                                <h5><?= $item['title'] ?></h5>
                                <?php if ($promotion == 1) {
                                    $percentage = $item['promotion_percentage'];
                                    $newPrice = $price - ($price * $percentage / 100);
                                ?>
                                    <p>Prix unitaire: <?= '<del>' . $price . '€</del> &nbsp;-' . $percentage . '% &nbsp;' . $newPrice ?>€</p>
                                <?php
                                } else {
                                ?>
                                    <p>Prix unitaire: <?= $price ?>€</p>
                                <?php
                                }
                                ?>
                                <p>Size: <?= $size ?></p>
                                <?php
                                ?>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <div style="width: 70px;">
                                <div class="form-outline">
                                    <input id="form1" min="1" max="99" name="quantity" value="<?= $order['quantity'] ?>" type="number" class="quantity form-control" data-id="<?= $id_pro ?>" data-size="<?= $size ?>" data-order="<?= $id_order ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <div style="width: 80px;">
                                <h5 class="mb-0"><?= $order['total_product'] ?>€</h5>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt" data-id="<?= $id_pro ?>" data-size="<?= $size ?>" data-order="<?= $id_order ?>" id="delProduct"></i></a>
                        </div>
                    </div>
                </div>
            </div>

    <?php
        }
    }
}

if (isset($_GET["pay"])) {
    $id = $user->getUserId();
    $total = $cart->getCart($id);
    ?>
    <div class="card bg-dark text-white rounded-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">Card details</h5>
                <h6><?= $login ?></h6>
            </div>

            <p class="small mb-2">Card type</p>
            <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-mastercard fa-2x me-2"></i></a>
            <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-visa fa-2x me-2"></i></a>
            <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-amex fa-2x me-2"></i></a>
            <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>

            <form class="mt-4">
                <div class="form-outline form-white mb-4">
                    <input type="text" id="typeName" class="form-control form-control-lg" siez="17" placeholder="Cardholder's Name" />
                    <label class="form-label" for="typeName">Cardholder's Name</label>
                </div>

                <div class="form-outline form-white mb-4">
                    <input type="text" id="typeCardNumber" class="form-control form-control-lg" siez="17" placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                    <label class="form-label" for="typeText">Card Number</label>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-outline form-white">
                            <input type="text" id="typeExp" class="form-control form-control-lg" placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" />
                            <label class="form-label" for="typeExp">Expiration</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-outline form-white">
                            <input type="password" id="typeText" class="form-control form-control-lg" placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                            <label class="form-label" for="typeText">Cvv</label>
                        </div>
                    </div>
                </div>
            </form>

            <hr class="my-4">

            <div class="d-flex justify-content-between">
                <p class="mb-2">Subtotal</p>
                <?php if ($total !== "Nothing to show here !") {
                ?>
                    <p class="mb-2"><?= $total[0]['total'] ?>€</p>
                <?php } else {
                ?>
                    <p class="mb-2">0€</p>
                <?php
                }
                ?>
            </div>

            <div class="d-flex justify-content-between">
                <p class="mb-2">Shipping</p>
                <p class="mb-2">00.00€</p>
            </div>

            <div class="d-flex justify-content-between mb-4">
                <p class="mb-2">Total(Incl. taxes)</p>
                <?php if ($total !== "Nothing to show here !") {
                ?>
                    <p class="mb-2"><?= $total[0]['total'] ?>€</p>
                <?php } else {
                ?>
                    <p class="mb-2">0€</p>
                <?php
                }
                ?>
            </div>


            <?php if ($total !== "Nothing to show here !") {
            ?>
                <button type="button" class="pay-btn btn btn-info btn-block btn-lg">
                    <div class="pay-btn d-flex justify-content-between">
                        <span class="pay-btn"><?= $total[0]['total'] ?>€ </span>
                        <span class="pay-btn">&nbsp; Pay Now <i class="cart-empty fas fa-long-arrow-alt-right ms-2"></i></span>
                    </div>
                </button>
            <?php } else {
            ?>
                <button type="button" class="cart-empty btn btn-info btn-block btn-lg">
                    <div class="cart-empty d-flex justify-content-between">
                        <span class="cart-empty">0€ </span>
                        <span class="cart-empty">&nbsp; Pay Now <i class="cart-empty fas fa-long-arrow-alt-right ms-2"></i></span>
                    </div>
                </button>
            <?php
            }
            ?>
        </div>
    </div>
    <?php
}

if (isset($_POST["addToCart"])) {

    if ($user->isLogged()) {
        $id_product = $_POST["id"];
        $quantity = $_POST["quantity"];
        $size = $_POST["size"];

        $id_order = $cart->cartVerify($id);
        $item = $product->getProductInfo($id_product);
        $price = $item["price"] / 100;

        if ($item["promotion"] === 1) {
            $price = $price - ($price * ($item["promotion_percentage"] / 100));
        }

        $total = $price * $quantity;


        $result = $cart->createDetail($id_order, $id_product, $quantity, $size, $total);
        if ($result === "ok") {
            $cart->updateTotal($id_order);
        };
    } else {
        echo "not connected";
    }
}

if (isset($_POST["delFromCart"])) {

    $id_product = $_POST["id"];
    $size = $_POST["size"];
    $id_order = $_POST["id_order"];

    $result = $cart->deleteProduct($id_product, $id_order, $size);
    if ($result === "ok") {
        $cart->updateTotal($id_order);
    }
}

if (isset($_POST["updateProduct"])) {

    $id_product = $_POST["id"];
    $size_product = $_POST["size"];
    $id_order = $_POST["id_order"];
    $quantity = $_POST["quantity"];

    $item = $product->getProductInfo($id_product);

    $total = $item["price"] / 100 * $quantity;



    $result = $cart->updateQuantity($id_product, $size_product, $id_order, $quantity, $total);

    if ($result === "ok") {
        $cart->updateTotal($id_order);
    }
}

if (isset($_GET["validate"])) {
    $order = $cart->getCart($id);
    foreach ($order as $item) {

        $id_product = $item["id_product"];
        $size = $item['size'];
        $quantity = $item['quantity'];

        $table = $product->getProductSize($id_product, $size);
        $stock = $table['stock'];
        $id_size = $table['id_size'];
        $newStock = $stock - $quantity;

        $request = $product->updateStock($id_product, $id_size, $newStock);
        if ($request === "error") {
            echo "error";
            die();
        }
    }
    echo "ok";
}

if (isset($_GET["confirm"])) {
    $order = $cart->getCart($id);
    $id_order = $order[0]['id_order'];
    $result = $cart->orderOk($id_order);
    if ($result === "error") {
        echo $result;
    } else if ($result === "ok") {
        $item = $cart->getOrder($id, $id_order);
        $date = $item[0]['date'];
        $id_order = $item[0]['id_order'];
        $total = $item[0]['total'];
    ?>
        <div class="popup">
            <h3>Your <?= $total ?>€ payment has been successfully processed</h3>
            <p> Your command has been registered on <?= $date ?> </p>
            <p>Congratulations on your purchase from Vetix! We are delighted that you have found clothes that you love. We hope you enjoy them and feel confident and stylish in your new outfits. Please do not hesitate to visit us again for more shopping in the future. Thank you for your trust and see you soon!</p>

            <a href="shop.php">Continue Shopping</a>
        </div>
<?php

    }
}

?>