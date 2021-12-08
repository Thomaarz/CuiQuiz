<?php

class ModeleConnection extends Connection {

    public function getUser($name) {
        $prepare = self::$db->prepare("SELECT * FROM user WHERE user_name = ?;");
        $prepare->execute(array($name));

        $prepare = $prepare->fetch();
        return $prepare;
    }

    public function getUserWithPassword($name, $password) {
        $prepare = self::$db->prepare("SELECT * FROM user WHERE user_name = ? AND user_password = ?;");
        $prepare->execute(array($name, $password));

        $prepare = $prepare->fetch();
        return $prepare;
    }

    public function getAllUsers() {
        $prepare = self::$db->prepare("SELECT * FROM user;");
        $prepare->execute(array());

        $prepare = $prepare->fetch();
        return $prepare;
    }

    public function createUser($name, $password) {
        $prepare = self::$db->prepare("INSERT INTO user (user_name, user_password) VALUES (?, ?);");
        $prepare->execute(array($name, $password));
    }

}