<?php
require_once "Model.php";
class Comment extends Model
{
    protected $bdd;
    protected $tablename = "comment";

    public function __construct()
    {
        parent::__construct();
    }

    // function to get all comments for a product
    public function getComments($id)
    {
        $id = (int)$id;
        $request = "SELECT comment.*, DATE_FORMAT(comment.date, '- %d %m %Y %H:%i -') as date, user.login as author 
        FROM comment 
        INNER JOIN user ON comment.id_user = user.id_user 
        WHERE comment.id_product = :id 
        ORDER BY date DESC
        ";
        // request
        $select = $this->bdd->prepare($request);
        // exec with params
        $select->execute([
            'id' => $id,
        ]);

        // get results
        $comments = $select->fetchAll(PDO::FETCH_ASSOC);
        // if $result produce an error, we return null
        if (!$comments) {
            return null;
        } else {
            // else we return the result
            return $comments;
        }
    }

    // function to add a comment
    public function addComment($subject, $comment, $id_product, $id_user)
    {
        // html special chars to avoid injections
        $subject = htmlspecialchars($subject);
        $comment = htmlspecialchars($comment);
        $id_product = htmlspecialchars($id_product);
        $id_user = htmlspecialchars($id_user);

        // request
        $request = "INSERT INTO $this->tablename (subject, comment, date, id_product, id_user) VALUES (:subject, :comment, NOW(), :id_product, :id_user)";

        $insert = $this->bdd->prepare($request);

        // exec with params
        $insert->execute([
            'subject' => $subject,
            'comment' => $comment,
            'id_product' => $id_product,
            'id_user' => $id_user,
        ]);

        // echo "ok" if the request went well
        if ($insert) {
            echo "ok";
        } else {
            echo "erreur";
        }
        $this->bdd = null;
    }

    // function to delete a comment
    public function deleteComment($id)
    {
        // request
        $request = "DELETE FROM comment WHERE id_comment = :id";

        $delete = $this->bdd->prepare($request);
        // exec with params
        $delete->execute([
            'id_comment' => $id
        ]);

        // echo "ok" if the request went well
        if ($delete) {
            echo "ok";
        } else {
            echo "erreur";
        }
    }

    // function to update a comment
    public function updateComment($id, $subject, $comment)
    {
        // html special char to avoid injections
        $subject = htmlspecialchars($subject);
        $comment = htmlspecialchars($comment);

        // request
        $request = "UPDATE comment SET subject = :subject, comment = :comment WHERE id_comment = :id_comment";

        $update = $this->bdd->prepare($request);

        // exec with params
        $update->execute([
            'subject' => $subject,
            'comment' => $comment,
            'id_comment' => $id,
        ]);

        // echo "ok" if the request went well
        if ($update) {
            echo "ok";
        } else {
            echo "erreur";
        }
    }
}
