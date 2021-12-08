<?php


class ModeleConnection extends Connection
{

    public function get_account($pseudo) {
        $prepare = self::$db->prepare("SELECT * FROM user WHERE pseudo = ?;");
        $prepare->execute(array($pseudo));

        $prepare = $prepare->fetch();
        return $prepare;
    }

    public function get_all_accounts() {
        $prepare = self::$db->prepare("SELECT * FROM user;");
        $prepare->execute(array());

        $prepare = $prepare->fetch();
        return $prepare;
    }

    public function isConnected() {
        return isset($_SESSION['pseudo']);
    }

}