<?php

require_once "Connection.php";

class ModeleConnection extends Connection {

    public function __construct() {
    }

    public function getUser($name) {
        $prepare = self::$db->prepare("SELECT * FROM users NATURAL JOIN rank WHERE user_name = ?;");
        $prepare->execute(array($name));

        $prepare = $prepare->fetch();
        return $prepare;
    }

    public function getUserWithPassword($name, $password) {
        $prepare = self::$db->prepare("SELECT * FROM users NATURAL JOIN rank WHERE user_name = ? AND user_password = ?;");
        $prepare->execute(array($name, $password));

        $prepare = $prepare->fetch();
        return $prepare;
    }

    public function getAllUsers() {
        $prepare = self::$db->prepare("SELECT * FROM users NATURAL JOIN rank user;");
        $prepare->execute(array());

        $prepare = $prepare->fetch();
        return $prepare;
    }

    public function createUser($name, $email, $password) {
        $prepare = self::$db->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?);");
        $prepare->execute(array($name, $email, $password));
    }

}