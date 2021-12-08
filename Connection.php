<?php


class Connection
{

    protected static $db;

    public static function initConnection() {
        self::$db = new PDO('jdbc:mysql://lacraftia.fr:3306/cui_quiz', 'quiz', 'cuicuijevole0');
    }

}