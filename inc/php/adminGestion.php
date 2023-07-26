
<?php
session_start();
require_once "../class/User.php";
require_once "../class/Product.php";
$user = new User();
$product = new Product();


// USER ---------------------------------------------
if (isset($_GET['delUser'])) {
    $id = $_GET['delUser'];
    if ($user->isAdmin()) {
        if ($id != $_SESSION['user']['id']) {
            $user->deleteOne($id);
        }
    }
}

if (isset($_POST['changeRole'])) {
    $newRole = $_POST['role'];
    $id = $_POST['id'];
    // si le user est admin, on lance le changeRole
    if ($user->isAdmin()) {
        $user->changeRole($newRole, $id);
    }
}

// PRODUCT ---------------------------------------------

if (isset($_GET['delProduct'])) {
    $idProduct = $_GET['delProduct'];

    echo $product->deleteProduct($idProduct);
}

if (isset($_POST['updateStock'])) {
    $idProduct = $_POST['idProduct'];
    $idSize = $_POST['idSize'];
    $newStock = $_POST['stock'];

    echo $product->updateStock($idProduct, $idSize, $newStock);
}

if (isset($_POST['addStock'])) {
    $idProduct = $_POST['idProduct'];
    $idSize = $_POST['idSize'];
    $newStock = $_POST['stock'];

    $product->addStock($idProduct, $idSize, $newStock);
}

if (isset($_POST['addNewCollection'])) {
    if ($_POST['addNewCollection'] == 'add') {
        $request = 'add';
        $idProduct = $_POST['idProduct'];
        $product->addNewCollection($idProduct, $request);
    } elseif ($_POST['addNewCollection'] == 'del') {
        $request = 'del';
        $idProduct = $_POST['idProduct'];
        $product->addNewCollection($idProduct, $request);
    }
}

if (isset($_POST['addBestSeller'])) {
    if ($_POST['addBestSeller'] == 'add') {
        $request = 'add';
        $idProduct = $_POST['idProduct'];
        $product->addBestSeller($idProduct, $request);
    } elseif ($_POST['addBestSeller'] == 'del') {
        $request = 'del';
        $idProduct = $_POST['idProduct'];
        $product->addBestSeller($idProduct, $request);
    }
}

if (isset($_POST['addPromotion'])) {
    $idProduct = $_POST['idProduct'];
    $percentage = $_POST['promotion'];
    $product->addPromotion($idProduct, $percentage);
}



if (isset($_POST['addProduct'])) {
    if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['category']) && isset($_POST['size']) && isset($_POST['stock']) && isset($_POST['priceEuro']) && isset($_POST['priceCentime']) && isset($_FILES['imageProduct']['name'])) {


        // form's variables
        $arrayProduct = [];
        $title = $_POST['title'];
        $descritpion = $_POST['description'];
        $idCategory = $_POST['category'];
        $sizeProduct = $_POST['size'];
        $stock = $_POST['stock'];
        $priceEuro = $_POST['priceEuro'];
        $priceCentime = $_POST['priceCentime'];
        $imgName = $_FILES["imageProduct"]["name"];

        $arrayProduct = [
            "title" => $title,
            "description" => $descritpion,
            "category" => $idCategory,
            "size" => $sizeProduct,
            "stock" => $stock,
            "priceEuro" => $priceEuro,
            "priceCentime" => $priceCentime,
            "imgName" => $imgName,
        ];

        $target_dir = "../img/shop/";

        $allowedType = [
            'image/jpeg',
            'image/jpg',
            'image/png'
        ];

        $fileName = $_FILES["imageProduct"]["name"];

        $type = $_FILES["imageProduct"]["type"];
        $size = $_FILES["imageProduct"]["size"];


        if (in_array($type, $allowedType) && $size > 300000) {

            echo "Image too big or type image not allowed";
        } else {
            if (!move_uploaded_file($_FILES["imageProduct"]['tmp_name'], $target_dir . $fileName)) {
                echo "Sorry there was an error";
            }
        }

        // 2eme images -----------------------------------------
        if ($_FILES['imageProduct_1']['name'] != "") {
            $fileName_1 = $_FILES["imageProduct_1"]["name"];

            $type_1 = $_FILES["imageProduct_1"]["type"];
            $size_1 = $_FILES["imageProduct_1"]["size"];

            if (in_array($type_1, $allowedType) && $size_1 > 300000) {

                echo "Image too big or type image not allowed";
            } else {
                if (!move_uploaded_file($_FILES["imageProduct_1"]['tmp_name'], $target_dir . $fileName_1)) {
                    echo "Sorry there was an error";
                }
            }
            $arrayProduct["imgName_1"] = $fileName_1;
        }

        // 3eme -----------------------------------------------------------------

        if ($_FILES['imageProduct_2']["name"] != "") {
            $fileName_2 = $_FILES["imageProduct_2"]["name"];

            $type_2 = $_FILES["imageProduct_2"]["type"];
            $size_2 = $_FILES["imageProduct_2"]["size"];

            if (in_array($type_2, $allowedType) && $size_2 > 300000) {

                echo "Image too big or type image not allowed";
            } else {
                if (!move_uploaded_file($_FILES["imageProduct_2"]['tmp_name'], $target_dir . $fileName_2)) {
                    echo "Sorry there was an error";
                }
            }
            $arrayProduct["imgName_2"] = $fileName_2;
        }

        // Deuxieme taille

        if (isset($_POST["size2"]) && $_POST["stock2"]) {
            $size2 = $_POST['size2'];
            $stock2 = $_POST['stock2'];
            $arrayProduct["size2"] = $size2;
            $arrayProduct["stock2"] = $size2;
        }
        //Troisieme taille
        if (isset($_POST["size3"]) && $_POST["stock3"]) {
            $size3 = $_POST['size3'];
            $stock3 = $_POST['stock3'];
            $arrayProduct["size3"] = $size3;
            $arrayProduct["stock3"] = $size3;
        }
        //Quatrieme taille
        if (isset($_POST["size4"]) && $_POST["stock4"]) {
            $size4 = $_POST['size4'];
            $stock4 = $_POST['stock4'];
            $arrayProduct["size4"] = $size4;
            $arrayProduct["stock4"] = $stock4;
        }
        //Cinquieme taille
        if (isset($_POST["size5"]) && $_POST["stock5"]) {
            $size5 = $_POST['size5'];
            $stock5 = $_POST['stock5'];
            $arrayProduct["size5"] = $size5;
            $arrayProduct["stock5"] = $stock5;
        }
        //Sixieme taille
        if (isset($_POST["size6"]) && $_POST["stock6"]) {
            $size6 = $_POST['size6'];
            $stock6 = $_POST['stock6'];
            $arrayProduct["size6"] = $size6;
            $arrayProduct["stock6"] = $stock6;
        }


        // once img are uploaded
        $product->addProduct($arrayProduct);
    } else {
        echo "You must fill all the fields";
    }
}

if (isset($_GET["getStock"])) {
    $idProduct = $_GET['idProduct'];
    $idSize = $_GET['idSize'];
    $stock = $product->getStock($idProduct, $idSize);
    echo json_encode($stock);
}

// CATEGORY -------------------------------------------------

if (isset($_GET['delCategory'])) {
    $idCategory = $_GET['delCategory'];
    $product->deleteCategory($idCategory);
}


if (isset($_POST['addCategory'])) {
    $newCategory = $_POST['category'];
    $product->addCategory($newCategory);
}

if (isset($_POST["updateCategory"])) {
    $idCategory = $_POST['id_category'];
    $newName = $_POST['category'];
    $product->updateCategory($idCategory, $newName);
}
