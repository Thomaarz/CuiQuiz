<?php


class ModeleClassement extends Connection
{

    public function getUsersByLevel() {
        $prepare = self::$db->prepare("SELECT * FROM users NATURAL JOIN rank ORDER BY user_level DESC;");
        $prepare->execute(array());

        $prepare = $prepare->fetchAll();
        return $prepare;
    }

}