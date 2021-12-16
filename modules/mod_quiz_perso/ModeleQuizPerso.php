<?php

require_once "Connection.php";

class ModeleQuizPerso extends Connection
{

    public function getquizPersoByUser($user_id) {
        $prepare = self::$db->prepare("SELECT * FROM quiz_perso WHERE user_id = ?;");
        $prepare->execute(array($user_id));

        $prepare = $prepare->fetchAll();
        return $prepare;
    }

    public function getquizPerso($quiz_perso_id) {
        $prepare = self::$db->prepare("SELECT * FROM quiz_perso WHERE quiz_perso_id = ?;");
        $prepare->execute(array($quiz_perso_id));

        $prepare = $prepare->fetch();
        return $prepare;
    }

    public function insertquizPerso($name, $user_id) {
        $prepare = self::$db->prepare("INSERT INTO quiz_perso (quiz_perso_name, user_id) VALUES (?, ?);");
        $prepare->execute(array($name, $user_id));

        $prepare = self::$db->prepare("SELECT * FROM quiz_perso WHERE user_id = ? ORDER BY quiz_perso_date DESC;");
        $prepare->execute(array($user_id));
        return $prepare->fetchAll()[0]['quiz_perso_id'];
    }

    public function insertQuestionPerso($quiz_perso_id, $enonce, $reponse) {
        $prepare = self::$db->prepare("INSERT INTO question_perso (quiz_perso_id, question_perso_enonce, question_perso_reponse) VALUES (?, ?, ?);");
        $prepare->execute(array($quiz_perso_id, $enonce, $reponse));
    }

    public function deleteQuestionPerso($question_perso_id) {
        $prepare = self::$db->prepare("DELETE FROM question_perso WHERE question_perso_id = ?;");
        $prepare->execute(array($question_perso_id));
    }

    public function deleteQuizPerso($quiz_perso_id) {
        $prepare = self::$db->prepare("DELETE FROM quiz_perso WHERE quiz_perso_id = ?;");
        $prepare->execute(array($quiz_perso_id));
    }

}