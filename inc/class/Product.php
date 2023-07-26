<?php
require_once "Model.php";
class Product extends Model
{
    protected $bdd;
    protected $tablename = "product";

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll($categ = null)
    {
        $request = "SELECT product.id_product, product.title, product.description, product.image, product.image_1, product.image_2, product.price, product.promotion, product.promotion_percentage FROM $this->tablename";

        if ($categ != null) {
            $categ = htmlspecialchars($categ);
            $request = "SELECT product.id_product, product.title, product.description, product.image, product.image_1, product.image_2, product.price, product.promotion, product.promotion_percentage, link_categ.id_categ, category.id_category, category.name 
            AS category
            FROM $this->tablename 
            INNER JOIN link_categ 
            ON product.id_product=link_categ.id_product 
            INNER JOIN category 
            ON link_categ.id_categ=category.id_category WHERE category.id_category=$categ";
        }


        $select = $this->bdd->prepare($request);

        $select->execute();

        $result = $select->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            return $result;
        } else {
            $result = "Nothing to show here !";
            return $result;
        }
    }

    // get the stock of a product and a size
    public function getStock($idProduct, $idSize)
    {

        $idProduct = htmlspecialchars($idProduct);
        $idSize = htmlspecialchars($idSize);

        $request = 'SELECT product_size.stock AS stock
        FROM product_size
        WHERE product_size.id_product = :idProduct AND product_size.id_size = :idSize';

        $select = $this->bdd->prepare($request);

        $select->execute([
            ":idProduct" => $idProduct,
            ":idSize" => $idSize,
        ]);

        $result = $select->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    // get all the sizes of a product
    public function getSize($idProduct)
    {
        $idProduct = htmlspecialchars($idProduct);

        $request = "SELECT product_size.id_product AS id_size_product,
        product_size.id_size, size.id_size, size.size
        FROM $this->tablename
        INNER JOIN product_size
        ON product.id_product=product_size.id_product
        INNER JOIN size
        ON product_size.id_size=size.id_size
        WHERE product.id_product = :idProduct";

        $select = $this->bdd->prepare($request);

        $select->execute([
            ":idProduct" => $idProduct,
        ]);

        $result = $select->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // get all the data from a table (size and category)
    public function getTable($table)
    {
        $table = htmlspecialchars($table);
        $this->tablename = $table;
        $result = parent::getAll();
        $this->tablename = "product";
        return $result;
    }

    // delete a product (and the images in the folder)
    public function deleteProduct($idProduct, $colname = "id_product")
    {
        $idProduct = htmlspecialchars($idProduct);

        // SELECT the images to delete
        $request = "SELECT image, image_1, image_2 FROM $this->tablename WHERE id_product = :id ";

        $select = $this->bdd->prepare($request);

        $select->execute([
            ":id" => $idProduct,
        ]);

        $result = $select->fetch(PDO::FETCH_ASSOC);

        $image = $result["image"];
        $image_1 = $result["image_1"];
        $image_2 = $result["image_2"];
        // delete the images
        unlink("../img/shop/$image");
        // si l'image n'est pas null, on la supprime
        if ($image_1 != null) {
            unlink("../img/shop/$image_1");
        }
        if ($image_2 != null) {
            unlink("../img/shop/$image_2");
        }

        // delete the product
        echo parent::deleteOne($idProduct, $colname);
    }

    // delete a category
    public function deleteCategory($idCategory, $colname = "id_category")
    {
        $idCategory = htmlspecialchars($idCategory);
        $this->tablename = "category";
        echo parent::deleteOne($idCategory, $colname);
        $this->tablename = "product";
    }

    // ------------------------- Completion -----------------------------------
    public function completion()
    {

        $get = $this->bdd->prepare("SELECT id_product, title FROM $this->tablename");
        $get->execute();
        $result = $get->fetchAll(PDO::FETCH_ASSOC);
        // JSON encode
        $myJSON = json_encode($result);

        echo $myJSON;
    }

    public function searchProducts($search)
    {
        $search = htmlspecialchars($search) . "%";

        $query = $this->bdd->prepare("SELECT id_product, title FROM product WHERE title LIKE :search LIMIT 0,20;");
        $query->execute([':search' => $search]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        // return the search results
        return $result;
    }
    // -------------------------------------------------------------------

    // get the info of a product (but not the categories and size)
    public function getProductInfo($id, $colname = "id_product")
    {
        return parent::getOne($id, $colname);
    }

    // get the name of the categories for a product
    public function getCategoryName($id)
    {
        $id = htmlspecialchars($id);
        $query = $this->bdd->prepare("SELECT name FROM category INNER JOIN link_categ ON category.id_category = link_categ.id_categ WHERE link_categ.id_product = :id");
        $query->execute([':id' => $id]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        } else {
            return 'not ok';
        }
    }

    // get the name of the category
    public function getCategory($id)
    {
        $id = htmlspecialchars($id);
        $request = "SELECT name FROM category WHERE id_category = :id";
        $select = $this->bdd->prepare($request);
        $select->execute([
            ':id' => $id
        ]);
        $result = $select->fetch();
        $this->bdd = null;
        return $result;
    }

    // add a product
    public function addProduct($product)
    {
        $title = htmlspecialchars($product["title"]);
        $description = htmlspecialchars($product["description"]);
        $idCategory = htmlspecialchars($product["category"]);
        $size = htmlspecialchars($product["size"]);
        $stock = htmlspecialchars($product["stock"]);
        $priceEuro = htmlspecialchars($product["priceEuro"]);
        $priceCentime = htmlspecialchars($product["priceCentime"]);
        $imgName = htmlspecialchars($product["imgName"]);

        // change price into centimes
        $realPrice = (int)$priceEuro * 100 + $priceCentime;
        //Insertion of the product
        $request1 = "INSERT INTO $this->tablename (title, description, image, price) VALUES (:title, :description, :image, :price)";
        $insert = $this->bdd->prepare($request1);
        $insert->execute([
            ":title" => $title,
            ":description" => $description,
            ":image" => $imgName,
            ":price" => $realPrice,
        ]);
        //Get the id of the product we've just inserted
        $lastId = $this->bdd->lastInsertId();


        //Link the product with category
        $request2 = "INSERT INTO link_categ (id_product, id_categ) VALUES (:id_product, :id_categ)";
        $insert2 = $this->bdd->prepare($request2);
        $insert2->execute([
            ":id_product" => $lastId,
            ":id_categ" => $idCategory,
        ]);
        //link the product with the first size
        $request3 = "INSERT INTO product_size (id_product, id_size, stock) VALUES (:id_product, :id_size, :stock)";
        $insert3 = $this->bdd->prepare($request3);
        $insert3->execute([
            ":id_product" => $lastId,
            ":id_size" => $size,
            ":stock" => $stock,
        ]);

        // -----------------------------------------------
        // Not required

        //if we have others sizes we link them

        if (isset($product["size2"])) {

            $requestSize = "INSERT INTO product_size (id_product, id_size, stock) VALUES (:id_product, :id_size, :stock)";
            $insertSize = $this->bdd->prepare($requestSize);
            $insertSize->execute([
                ":id_product" => $lastId,
                ":id_size" => $product['size2'],
                ":stock" => $product['stock2'],
            ]);
        }

        if (isset($product["size3"])) {

            $requestSize = "INSERT INTO product_size (id_product, id_size, stock) VALUES (:id_product, :id_size, :stock)";
            $insertSize = $this->bdd->prepare($requestSize);
            $insertSize->execute([
                ":id_product" => $lastId,
                ":id_size" => $product['size3'],
                ":stock" => $product['stock3'],
            ]);
        }
        if (isset($product["size4"])) {

            $requestSize = "INSERT INTO product_size (id_product, id_size, stock) VALUES (:id_product, :id_size, :stock)";
            $insertSize = $this->bdd->prepare($requestSize);
            $insertSize->execute([
                ":id_product" => $lastId,
                ":id_size" => $product['size4'],
                ":stock" => $product['stock4'],
            ]);
        }
        if (isset($product["size5"])) {

            $requestSize = "INSERT INTO product_size (id_product, id_size, stock) VALUES (:id_product, :id_size, :stock)";
            $insertSize = $this->bdd->prepare($requestSize);
            $insertSize->execute([
                ":id_product" => $lastId,
                ":id_size" => $product['size5'],
                ":stock" => $product['stock5'],
            ]);
        }

        if (isset($product["size6"])) {

            $requestSize = "INSERT INTO product_size (id_product, id_size, stock) VALUES (:id_product, :id_size, :stock)";
            $insertSize = $this->bdd->prepare($requestSize);
            $insertSize->execute([
                ":id_product" => $lastId,
                ":id_size" => $product['size6'],
                ":stock" => $product['stock6'],
            ]);
        }

        // img2
        if (isset($product['imgName_1'])) {
            $requestImg = "UPDATE $this->tablename SET `image_1`= :imgName WHERE id_product = :lastId";
            $insertImg = $this->bdd->prepare($requestImg);
            $insertImg->execute([
                ":imgName" => $product['imgName_1'],
                ":lastId" => $lastId,
            ]);
        }

        //img3
        if (isset($product['imgName_2'])) {
            $requestImg = "UPDATE $this->tablename SET `image_2`= :imgName WHERE id_product = :lastId";
            $insertImg = $this->bdd->prepare($requestImg);
            $insertImg->execute([
                ":imgName" => $product['imgName_2'],
                ":lastId" => $lastId,
            ]);
        }



        if ($insert && $insert2 && $insert3) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    // update the stock of a particular size
    public function updateStock($idProduct, $idSize, $newStock)
    {
        //htmlspecialchars
        $idProduct = htmlspecialchars($idProduct);
        $idSize = htmlspecialchars($idSize);
        $newStock = htmlspecialchars($newStock);

        $request = "UPDATE product_size SET stock = :newStock WHERE id_product = :idProduct AND id_size = :idSize";

        $update = $this->bdd->prepare($request);
        $update->execute([
            ":newStock" => $newStock,
            ":idProduct" => $idProduct,
            ":idSize" => $idSize,
        ]);

        if ($update) {
            return "ok";
        } else {
            return "error";
        }
    }

    // add a new size with the stock to a product
    public function addStock($idProduct, $idSize, $newStock)
    {
        //htmlspecialchars
        $idProduct = htmlspecialchars($idProduct);
        $idSize = htmlspecialchars($idSize);
        $newStock = htmlspecialchars($newStock);

        $request = "INSERT INTO `product_size` (`id_size`, `id_product`, `stock`) VALUES (:idSize, :idProduct, :stock)";
        $insert = $this->bdd->prepare($request);
        $insert->execute([
            ":idSize" => $idSize,
            ":idProduct" => $idProduct,
            ":stock" => $newStock,
        ]);

        if ($insert) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    // add a product to new collection
    public function addNewCollection($idProduct, $request)
    {
        $idProduct = htmlspecialchars($idProduct);
        $request = htmlspecialchars($request);
        if ($request == "add") {
            $update = "UPDATE $this->tablename SET `new_collection`= 1 WHERE id_product = :idProduct";
            $update = $this->bdd->prepare($update);
            $update->execute([
                ":idProduct" => $idProduct,
            ]);


            $query = "INSERT INTO `link_categ` (`id_product`, `id_categ`) VALUES (:idProduct, '7')";
            $query = $this->bdd->prepare($query);
            $query->execute([
                ":idProduct" => $idProduct,
            ]);
        } elseif ($request == "del") {
            $update = "UPDATE $this->tablename SET `new_collection`= 0 WHERE id_product = :idProduct";
            $update = $this->bdd->prepare($update);
            $update->execute([
                ":idProduct" => $idProduct,
            ]);

            $query = "DELETE FROM `link_categ` WHERE id_product = :idProduct AND id_categ = 7";
            $query = $this->bdd->prepare($query);
            $query->execute([
                ":idProduct" => $idProduct,
            ]);
        }

        if ($update && $query) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    // add a product to best seller
    public function addBestSeller($idProduct, $request)
    {
        $idProduct = htmlspecialchars($idProduct);
        $request = htmlspecialchars($request);
        if ($request == "add") {
            $update = "UPDATE $this->tablename SET `best_sellers`= 1 WHERE id_product = :idProduct";
            $update = $this->bdd->prepare($update);
            $update->execute([
                ":idProduct" => $idProduct,
            ]);

            $query = "INSERT INTO `link_categ` (`id_product`, `id_categ`) VALUES (:idProduct, '2')";
            $query = $this->bdd->prepare($query);
            $query->execute([
                ":idProduct" => $idProduct,
            ]);
        } elseif ($request == "del") {
            $update = "UPDATE $this->tablename SET `best_sellers`= 0 WHERE id_product = :idProduct";
            $update = $this->bdd->prepare($update);
            $update->execute([
                ":idProduct" => $idProduct,
            ]);

            $query = "DELETE FROM `link_categ` WHERE id_product = :idProduct AND id_categ = 2";
            $query = $this->bdd->prepare($query);
            $query->execute([
                ":idProduct" => $idProduct,
            ]);
        }

        if ($update && $query) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    // put a product on promotion
    public function addPromotion($idProduct, $percentage)
    {
        $idProduct = htmlspecialchars($idProduct);
        $percentage = htmlspecialchars($percentage);

        if ($percentage == 0) {
            $update = "UPDATE $this->tablename SET `promotion`= 0 WHERE id_product = :idProduct";
            $update = $this->bdd->prepare($update);
            $update->execute([
                ":idProduct" => $idProduct,
            ]);

            $query = "DELETE FROM `link_categ` WHERE id_product = :idProduct AND id_categ = 8";
            $query = $this->bdd->prepare($query);
            $query->execute([
                ":idProduct" => $idProduct,
            ]);
        } else {
            $update = "UPDATE $this->tablename SET `promotion`= 1, `promotion_percentage`=:promo WHERE id_product = :idProduct";
            $update = $this->bdd->prepare($update);
            $update->execute([
                ":promo" => $percentage,
                ":idProduct" => $idProduct,
            ]);

            $query = "INSERT INTO `link_categ` (`id_product`, `id_categ`) VALUES (:idProduct, '8')";
            $query = $this->bdd->prepare($query);
            $query->execute([
                ":idProduct" => $idProduct,
            ]);
        }

        if ($update && $query) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    // add new category
    public function addCategory($newCategory)
    {
        $newCategory = htmlspecialchars($newCategory);

        $request = "INSERT INTO `category` (`name`) VALUES (:newCategory)";
        $insert = $this->bdd->prepare($request);
        $insert->execute([
            ":newCategory" => $newCategory,
        ]);

        if ($insert) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    // update category name
    public function updateCategory($idCategory, $newName)
    {
        $idCategory = htmlspecialchars($idCategory);
        $newName = htmlspecialchars($newName);

        $request = "UPDATE category SET name = :newCategory WHERE id_category = :idCategory";
        $update = $this->bdd->prepare($request);
        $update->execute([
            ":newCategory" => $newName,
            ":idCategory" => $idCategory,
        ]);

        if ($update) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    // get 4 random products from a categorie
    public function getRandomCateg($categ, $limit)
    {
        $categ = htmlspecialchars($categ);
        $limit = htmlspecialchars($limit);
        $query = $this->bdd->prepare("SELECT id_product, title, image, image_1, image_2, price, promotion, promotion_percentage 

        FROM $this->tablename 
        WHERE $categ = 1
        ORDER BY RAND() 
        LIMIT " . intval($limit));
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        // si il y a des résultats
        if (count($results) > 0) {
            return $results;
        } else {

            $results = 'Nothing to show here!';
            return $results;
        }
    }

    // Get the size and the stock of a product
    public function getProductSize($id_product, $size)
    {

        $id_product = htmlspecialchars($id_product);
        $size = htmlspecialchars($size);

        $request1 = "SELECT id_size FROM size WHERE `size`= :size";
        $select1 = $this->bdd->prepare($request1);
        $select1->execute([
            ":size" => $size,
        ]);
        $result = $select1->fetch(PDO::FETCH_ASSOC);
        $id_size = $result['id_size'];


        $request2 = "SELECT stock FROM product_size WHERE id_product = :id_product AND id_size = :id_size";
        $select2 = $this->bdd->prepare($request2);
        $select2->execute([
            ":id_product" => $id_product,
            ":id_size" => $id_size,
        ]);
        $result2 = $select2->fetch(PDO::FETCH_ASSOC);

        $table["id_size"] = $id_size;
        $table["stock"] = $result2["stock"];
        return $table;
    }
}
