<?php

define('HOST', 'localhost');
define('DB_NAME', 'cui_quiz');
define('USER', 'admin');
define('PASS', 'ceq54g96t7e95f');

class Connection {

    protected static $db;

    /**
     * Init the database connection
     */
    public static function initConnection() {
        try {
            self::$db = new PDO("mysql:host=" . HOST . ';dbname=' . DB_NAME, USER, PASS);

            self::$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            echo $error;
        }
    }
}
