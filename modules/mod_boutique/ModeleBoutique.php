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
        $prepare = self::$db->prepare("SELECT * FROM item_shop NATURAL JOIN categorie_shop WHERE categorie_shop_id = ?;");
        $prepare->execute(array($category_id));

        $prepare = $prepare->fetchAll();
        return $prepare;
    }

    public function getItem($item_id) {
        $prepare = self::$db->prepare("SELECT * FROM item_shop NATURAL JOIN categorie_shop WHERE item_shop_id = ?;");
        $prepare->execute(array($item_id));

        $prepare = $prepare->fetch();
        return $prepare;
    }

    public function removeCoins($coins, $user) {
        $prepare = self::$db->prepare("UPDATE users SET user_coins = user_coins - ? WHERE user_id = ?;");
        $prepare->execute(array($coins, $user));
    }

    public function setTitre($item_id, $user) {
        $prepare = self::$db->prepare("UPDATE users SET titre_id = ? WHERE user_id = ?;");
        $prepare->execute(array($item_id, $user));
    }

    public function setGrade($rank_id, $user) {
        $prepare = self::$db->prepare("UPDATE users SET rank_id = ? WHERE user_id = ?;");
        $prepare->execute(array($rank_id, $user));
    }

}