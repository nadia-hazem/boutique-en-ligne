<?php
require_once "Model.php";
class Cart extends Model
{

    protected $bdd;

    protected $tablename = "shop_order";

    public function __construct()
    {
        parent::__construct();
    }

    // get the cart of the user
    public function getCart($id)
    {
        $id = htmlspecialchars($id);
        $request = "SELECT $this->tablename.total, $this->tablename.id_order,
        date, state,
        detail.id_product, detail.total AS total_product, detail.quantity, detail.size
        FROM $this->tablename
        INNER JOIN detail ON detail.id_order = shop_order.id_order 
        WHERE $this->tablename.id_user = :id_user AND $this->tablename.state = 'cart'";

        $select = $this->bdd->prepare($request);

        $select->execute([
            ":id_user" => $id
        ]);

        $result = $select->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            return $result;
        } else {
            $result = "Nothing to show here !";
            return $result;
        }
    }

    // verify if the user already own a cart, create it if not and get the id of the cart
    public function cartVerify($id)
    {

        $id = htmlspecialchars($id);

        $request = "SELECT id_order FROM $this->tablename WHERE id_user=:id AND state='cart'";

        $select = $this->bdd->prepare($request);
        $select->execute([
            ":id" => $id
        ]);

        $result = $select->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['id_order'];
        } else {
            $request2 = "INSERT INTO $this->tablename (date, id_user, state) VALUES (NOW(), :id_user, 'cart')";
            $insert = $this->bdd->prepare($request2);
            $insert->execute([
                ":id_user" => $id
            ]);

            if ($insert) {
                return $this->bdd->lastInsertId();
            } else {
                echo "error";
            }
        }
    }

    // add a product to the cart
    public function createDetail($id_order, $id_product,  $quantity, $size, $total)
    {

        $id_order = htmlspecialchars($id_order);
        $id_product = htmlspecialchars($id_product);
        $quantity = htmlspecialchars($quantity);
        $size = htmlspecialchars($size);
        $total = htmlspecialchars($total);

        $request = "SELECT * FROM detail WHERE id_order = :id_order AND id_product = :id_product AND size = :size";
        $select = $this->bdd->prepare($request);
        $select->execute([
            ":id_order" => $id_order,
            ":id_product" => $id_product,
            ":size" => $size,
        ]);
        $result = $select->fetch(PDO::FETCH_ASSOC);
        if ($result) {

            $quantity = $quantity + $result["quantity"];
            $total = $total + $result['total'];

            $request2 = "UPDATE detail SET total=:total, quantity=:quantity WHERE id_order = :id_order AND id_product = :id_product AND size = :size";
            $update = $this->bdd->prepare($request2);
            $update->execute([
                ":total" => $total,
                ":quantity" => $quantity,
                ":id_order" => $id_order,
                "id_product" => $id_product,
                ":size" => $size,
            ]);
            if ($update) {
                return "ok";
            } else {
                return "error";
            }
        } else {
            $request2 = "INSERT INTO detail (id_order, id_product, total, quantity, size) VALUES (:id_order, :id_product, :total, :quantity, :size)";

            $insert = $this->bdd->prepare($request2);
            $insert->execute([
                ":id_order" => $id_order,
                ":id_product" => $id_product,
                ":total" => $total,
                ":quantity" => $quantity,
                ":size" => $size
            ]);

            if ($insert) {
                return "ok";
            } else {
                return "error";
            }
        }
    }

    // update the total of the cart
    public function updateTotal($id_order)
    {
        $request = "SELECT total AS totalProduct FROM detail WHERE id_order=:id_order";
        $select = $this->bdd->prepare($request);
        $select->execute([
            ":id_order" => $id_order,
        ]);

        $select = $select->fetchAll(PDO::FETCH_ASSOC);

        $totalOrder = 0;

        foreach ($select as $product) {
            $totalOrder = $totalOrder + (int)$product['totalProduct'];
        }

        $request2 = "UPDATE $this->tablename SET `total` = $totalOrder WHERE id_order = :id_order";
        $update = $this->bdd->prepare($request2);
        $update->execute([
            ":id_order" => $id_order,
        ]);

        if ($update) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    // delete a product from the cart
    public function deleteProduct($id_product, $id_order, $size)
    {

        $request = "DELETE FROM detail WHERE id_product = :id_product AND id_order = :id_order AND size = :size";
        $delete = $this->bdd->prepare($request);
        $delete->execute([
            ":id_product" => $id_product,
            "id_order" => $id_order,
            ":size" => $size,
        ]);

        if ($delete) {
            return "ok";
        } else {
            return "error";
        }
    }

    // update the quantity of a product in the cart
    public function updateQuantity($id_product, $size_order, $id_order, $quantity, $total)
    {

        $id_product = htmlspecialchars($id_product);
        $size_order = htmlspecialchars($size_order);
        $id_order = htmlspecialchars($id_order);
        $quantity = htmlspecialchars($quantity);
        $total = htmlspecialchars($total);


        $request = "UPDATE detail SET quantity = :quantity ,total = :total WHERE id_product = :id_product AND size = :size AND id_order = :id_order";

        $update = $this->bdd->prepare($request);

        $update->execute([
            ":quantity" => $quantity,
            ":total" => $total,
            ":id_product" => $id_product,
            ":size" => $size_order,
            "id_order" => $id_order
        ]);
        if ($update) {
            return "ok";
        } else {
            return "error";
        }
    }

    // put the cart in pending
    public function orderOk($id_order)
    {
        $id_order = htmlspecialchars($id_order);
        $request = "UPDATE $this->tablename SET date=NOW(), state='pending' WHERE id_order=:id_order";
        $update = $this->bdd->prepare($request);
        $update->execute([
            ":id_order" => $id_order,
        ]);

        if ($update) {
            return "ok";
        } else {
            return "error";
        }
    }

    // get the order(s) of a user
    public function getOrder($id_user, $id_order = null)
    {
        $id_user = htmlspecialchars($id_user);

        $request = "SELECT $this->tablename.total, $this->tablename.id_order,
        DATE_FORMAT(date, '%d/%m/%Y %H:%i') AS date, state
        FROM $this->tablename 
        WHERE $this->tablename.id_user = :id_user AND $this->tablename.state = 'pending'";

        if ($id_order != null) {
            $id_order = htmlspecialchars($id_order);
            $request = $request . " AND $this->tablename.id_order=$id_order";
        }

        $select = $this->bdd->prepare($request);
        $select->execute([
            ":id_user" => $id_user,
        ]);

        $result = $select->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            return $result;
        } else {
            $result = "Nothing to show here !";
            return $result;
        }
    }
}
