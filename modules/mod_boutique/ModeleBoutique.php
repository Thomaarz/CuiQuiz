<?php


class ModeleBoutique extends Connection
{

    public function getCategories() {
        $prepare = self::$db->prepare("SELECT * FROM categorie_shop;");
        $prepare->execute(array());

        $prepare = $prepare->fetchAll();
        return $prepare;
    }

    public function getItems($category_id) {
        $prepare = self::$db->prepare("SELECT * FROM item_shop WHERE categorie_shop_id = ?;");
        $prepare->execute(array($category_id));

        $prepare = $prepare->fetchAll();
        return $prepare;
    }

}