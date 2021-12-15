<?php

require_once "Connection.php";

class ModeleQuiz extends Connection {

    public function getRandomQuestions($categorie_id, $amount) {
        $prepare = self::$db->prepare("SELECT * FROM question NATURAL JOIN categorie WHERE categorie_id = ? ORDER BY rand() DESC LIMIT ?;");
        $prepare->execute(array($categorie_id, $amount));

        $prepare = $prepare->fetchAll();
        return $prepare;
    }

    public function getTentatives($user_id) {
        $prepare = self::$db->prepare("SELECT * FROM tentative_user WHERE user_id = ?;");
        $prepare->execute(array($user_id));

        $prepare = $prepare->fetchAll();
        return $prepare;
    }

    public function getCategories() {
        $prepare = self::$db->prepare("SELECT * FROM categorie;");
        $prepare->execute(array());

        $prepare = $prepare->fetchAll();
        return $prepare;
    }

    public function getTentative($tentative_id) {
        $prepare = self::$db->prepare("SELECT * FROM tentative_user WHERE tentative_id = ?;");
        $prepare->execute(array($tentative_id));

        $prepare = $prepare->fetch();
        return $prepare;
    }

    /**
     * Insert a tentative
     * @param $user_id
     * @return int: the id of the tentative
     */
    public function insertTentative($user_id) {
        $prepare = self::$db->prepare("INSERT INTO tentative_user (user_id) VALUES (?);");
        $prepare->execute(array($user_id));

        $prepare = self::$db->prepare("SELECT * FROM tentative_user WHERE user_id = ? ORDER BY tentative_date DESC");
        $prepare->execute(array($user_id));
        return $prepare->fetchAll()[0]['tentative_id'];
    }

    public function insertReponses($try_id, $question_id, $reponse, $corrects, $wrongs) {
        $prepare = self::$db->prepare("INSERT INTO reponse_user (tentative_id, question_id, tentative_correct, tentative_wrong, reponse_value) 
                VALUES (?, ?, ?, ?, ?);");
        $prepare->execute(array($try_id, $question_id, $corrects, $wrongs, $reponse));
    }

}