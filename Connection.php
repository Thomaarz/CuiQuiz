<?php

define('HOST', 'localhost');
define('DB_NAME', 'cui_quiz');
define('USER', 'quiz');
define('PASS', 'cuicuijevole0');

class Connection {

    protected static $db;

    public static function initConnection() {
        try {
            $db = new PDO("mysql:host=" . HOST . ';dbname=' . DB_NAME, USER, PASS);

            $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e;
        }
    }

}