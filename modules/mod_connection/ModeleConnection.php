<?php

require_once "Connection.php";

class ModeleConnection extends Connection {

    public function __construct() {
    }

    /**
     * Retourne un utilisateur
     */
    public function getUser($name) {
        $prepare = self::$db->prepare("SELECT * FROM users NATURAL JOIN rank NATURAL JOIN titre WHERE user_name = ?;");
        $prepare->execute(array($name));

        $prepare = $prepare->fetch();
        return $prepare;
    }

    /**
     * Get all users
     */
    public function getAllUsers() {
        $prepare = self::$db->prepare("SELECT * FROM users NATURAL JOIN rank user;");
        $prepare->execute(array());

        $prepare = $prepare->fetch();
        return $prepare;
    }

    /**
     * Insert an user
     */
    public function createUser($name, $email, $password) {
        $prepare = self::$db->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?);");
        $prepare->execute(array($name, $email, $password));
    }

}