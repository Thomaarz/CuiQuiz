<?php


class ModeleClassement extends Connection
{

    public function getUsersByLevel() {
        $prepare = self::$db->prepare("SELECT * FROM users NATURAL JOIN rank NATURAL JOIN rank titre ORDER BY user_level DESC;");
        $prepare->execute(array());

        $prepare = $prepare->fetchAll();
        return $prepare;
    }

}