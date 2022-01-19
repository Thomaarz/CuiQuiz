<?php


class ModeleHome extends Connection
{

    public function getActus() {
        $prepare = self::$db->prepare("SELECT * FROM actus ORDER BY actus_date DESC LIMIT 5;");
        $prepare->execute(array());

        $prepare = $prepare->fetchAll();
        return $prepare;
    }

}