<?php

require_once "Connection.php";

class ModeleQuizPerso extends Connection
{

    /**
     * Get all quiz perso of an user
     */
    public function getQuizPersoByUser($user_id) {
        $prepare = self::$db->prepare("SELECT * FROM quiz_perso WHERE user_id = ?;");
        $prepare->execute(array($user_id));

        $prepare = $prepare->fetchAll();
        return $prepare;
    }

    /**
     * Get all tentatives of an user
     */
    public function getTentatives($quiz_perso_id) {
        $prepare = self::$db->prepare("SELECT * FROM tentative_perso WHERE quiz_perso_id = ?;");
        $prepare->execute(array($quiz_perso_id));

        $prepare = $prepare->fetchAll();
        return $prepare;
    }

    /**
     * Get all question of a quiz perso
     */
    public function getQuizPersoQuestions($question_perso_id) {
        $prepare = self::$db->prepare("SELECT * FROM question_perso WHERE question_perso_id = ?;");
        $prepare->execute(array($question_perso_id));

        $prepare = $prepare->fetch();
        return $prepare;
    }

    /**
     * Get a quiz perso by id
     */
    public function getQuizPerso($quiz_perso_id) {
        $prepare = self::$db->prepare("SELECT * FROM quiz_perso WHERE quiz_perso_id = ?;");
        $prepare->execute(array($quiz_perso_id));

        $prepare = $prepare->fetch();
        return $prepare;
    }

    /**
     * Insert a question in a quiz perso and return the quiz id
     */
    public function insertQuizPerso($name, $user_id) {
        $prepare = self::$db->prepare("INSERT INTO quiz_perso (quiz_perso_name, user_id) VALUES (?, ?);");
        $prepare->execute(array($name, $user_id));

        $prepare = self::$db->prepare("SELECT * FROM quiz_perso WHERE user_id = ? ORDER BY quiz_perso_date DESC;");
        $prepare->execute(array($user_id));
        return $prepare->fetchAll()[0]['quiz_perso_id'];
    }

    /**
     * Insert a question in a quiz perso
     */
    public function insertQuestionPerso($quiz_perso_id, $enonce, $reponse) {
        $prepare = self::$db->prepare("INSERT INTO question_perso (quiz_perso_id, question_perso_enonce, question_perso_reponse) VALUES (?, ?, ?);");
        $prepare->execute(array($quiz_perso_id, $enonce, $reponse));
    }

    /**
     * Delete a question perso
     */
    public function deleteQuestionPerso($question_perso_id) {
        $prepare = self::$db->prepare("DELETE FROM question_perso WHERE question_perso_id = ?;");
        $prepare->execute(array($question_perso_id));
    }

    /**
     * Update a question perso
     */
    public function updateQuestionPerso($question_perso_id, $enonce, $reponse) {
        $prepare = self::$db->prepare("UPDATE question_perso SET question_perso_enonce = ?, question_perso_reponse = ? WHERE question_perso_id = ?;");
        $prepare->execute(array($enonce, $reponse, $question_perso_id));
    }

    /**
     * Delete a quiz perso
     */
    public function deleteQuizPerso($quiz_perso_id) {
        $prepare = self::$db->prepare("DELETE FROM quiz_perso WHERE quiz_perso_id = ?;");
        $prepare->execute(array($quiz_perso_id));
    }

    /**
     * Si une chaîne est trop longue, elle sera coupé et '...' sera mis à la fin
     */
    public static function limitLenght($string, $amount) {
        if (strlen($string) > $amount) {
            $string = substr($string, 0, $amount - 3) . '...';
        }
        return $string;
    }

}