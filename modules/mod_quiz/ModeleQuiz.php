<?php

require_once "Connection.php";

class ModeleQuiz extends Connection {

    public function addCoins($user_id, $coins) {
        $prepare = self::$db->prepare("UPDATE users SET user_coins = user_coins + ? WHERE user_id = ?;");
        $prepare->execute(array($coins, $user_id));
    }

    public function getExperience($user_id) {
        $prepare = self::$db->prepare("SELECT user_experience FROM users WHERE user_id = ?;");
        $prepare->execute(array($user_id));

        $prepare = $prepare->fetch();
        return $prepare[0];
    }

    public function addExperience($user_id, $experience) {
        $current_experience = $this->getExperience($user_id);
        $current_experience += $experience;
        $level_to_add = 0;

        while ($current_experience >= 1000) {
            $current_experience -= 1000;
            $level_to_add++;
        }

        $prepare = self::$db->prepare("UPDATE users SET user_experience = ?, user_level = user_level + ? WHERE user_id = ?;");
        $prepare->execute(array($current_experience, $level_to_add, $user_id));
    }

    public function getRandomQuestions($categorie_id) {
        $prepare = self::$db->prepare("SELECT * FROM question NATURAL JOIN categorie WHERE categorie_id = ? ORDER BY rand() DESC LIMIT 10;");
        $prepare->execute(array($categorie_id));

        $prepare = $prepare->fetchAll();
        return $prepare;
    }

    public function getQuizPersoQuestions($quiz_perso_id) {
        $prepare = self::$db->prepare("SELECT * FROM question_perso WHERE quiz_perso_id = ?;");
        $prepare->execute(array($quiz_perso_id));

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

    public function getquizPerso() {
        $prepare = self::$db->prepare("SELECT * FROM quiz_perso NATURAL JOIN users LIMIT 5;");
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

        $prepare = self::$db->prepare("SELECT * FROM tentative_user WHERE user_id = ? ORDER BY tentative_date DESC;");
        $prepare->execute(array($user_id));
        return $prepare->fetchAll()[0]['tentative_id'];
    }

    public function insertReponses($try_id, $question_id, $reponse) {
        $prepare = self::$db->prepare("INSERT INTO reponse_user (tentative_id, question_id, reponse_value) VALUES (?, ?, ?);");
        $prepare->execute(array($try_id, $question_id, $reponse));
    }

    public function insertTentativePerso($user_id, $quiz_perso_id) {
        $prepare = self::$db->prepare("INSERT INTO tentative_perso (user_id, quiz_perso_id) VALUES (?, ?);");
        $prepare->execute(array($user_id, $quiz_perso_id));

        $prepare = self::$db->prepare("SELECT * FROM tentative_perso WHERE user_id = ? ORDER BY tentative_perso_date DESC;");
        $prepare->execute(array($user_id));
        return $prepare->fetchAll()[0]['tentative_perso_id'];
    }

    public function insertReponsesPerso($tentative_perso_id, $question_perso_id, $reponse) {
        $prepare = self::$db->prepare("INSERT INTO reponse_perso (tentative_perso_id, question_perso_id, reponse_perso_value) VALUES (?, ?, ?);");
        $prepare->execute(array($tentative_perso_id, $question_perso_id, $reponse));
    }

}