<?php
require_once "Model.php";
class Wishlist extends Model
{
    protected $bdd;
    protected $tablename = "wishlist";

    public function __construct()
    {
        parent::__construct();
    }

    public function isFavorite($user_id, $product_id)
    {
        $user_id = htmlspecialchars($user_id);
        $product_id = htmlspecialchars($product_id);

        // Check whether the product is already in the user's wishlist
        $request = "SELECT COUNT(*) FROM $this->tablename WHERE id_user = :id_user AND id_product = :id_product";
        $select = $this->bdd->prepare($request);
        $select->execute([':id_user' => $user_id, ':id_product' => $product_id]);

        $result = $select->fetchColumn();
        return $result > 0;
    }

    public function addToWishlist($user_id, $product_id)
    {
        $user_id = htmlspecialchars($user_id);
        $product_id = htmlspecialchars($product_id);

        // Check whether the product is already in the user's wishlist
        if ($this->isFavorite($user_id, $product_id)) {
            $this->removeFromWishlist($user_id, $product_id);
        } else {
            // Insert the product into the wishlist table
            $request = "INSERT INTO $this->tablename (id_user, id_product, date) VALUES (:id_user, :id_product, NOW())";
            $select = $this->bdd->prepare($request);
            $select->execute([':id_user' => $user_id, ':id_product' => $product_id]);

            if ($select) {
                echo "ok";
            } else {
                echo "error";
            }
        }
    }

    public function removeFromWishlist($user_id, $product_id)
    {
        $user_id = htmlspecialchars($user_id);
        $product_id = htmlspecialchars($product_id);

        // Delete the product from the wishlist table
        $request = "DELETE FROM $this->tablename WHERE id_user = :id_user AND id_product = :id_product";
        $select = $this->bdd->prepare($request);
        $select->execute([':id_user' => $user_id, ':id_product' => $product_id]);

        if ($select) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function getWishlistItems($user_id)
    {
        $user_id = htmlspecialchars($user_id);

        $request = "SELECT product.id_product, product.title, product.image, product.price, DATE_FORMAT(wishlist.date,'%d %m %Y ') AS date 
                    FROM product
                    INNER JOIN wishlist ON product.id_product = wishlist.id_product
                    WHERE wishlist.id_user = :id_user";
        $select = $this->bdd->prepare($request);
        $select->execute([':id_user' => $user_id]);

        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
