<?php

abstract class Model
{
    protected $bdd;
    protected $tablename = '';

    public function __construct()
    {
        // connexion à la bdd
        // variables de connexion à la bdd
        $host = 'localhost';
        $dbname = 'boutique';
        $dbUser = 'root';
        $dbPass = '';

        try {
            $this->bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbUser, $dbPass);
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->bdd->exec("set names utf8");
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            die();
        }
    }

    // get one data from a table
    protected function getOne($id, $colname)
    {
        $id = htmlspecialchars($id);

        $query = "SELECT * FROM $this->tablename WHERE $colname = :id";
        $select = $this->bdd->prepare($query);
        $select->execute([':id' => $id]);
        $result = $select->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // get all data from a table
    protected function getAll()
    {
        $query = "SELECT * FROM $this->tablename";
        $select = $this->bdd->prepare($query);
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //Delete one from table//
    protected function deleteOne($id, $colname)
    {
        $id = htmlspecialchars($id);

        $request = "DELETE FROM $this->tablename WHERE $colname = :id ";

        $delete = $this->bdd->prepare($request);

        $delete->execute([
            ":id" => $id,
        ]);

        if ($delete) {
            return "ok";
        } else {
            return "error";
        }
    }
}
