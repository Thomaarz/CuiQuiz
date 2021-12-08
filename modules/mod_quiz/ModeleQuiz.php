<?php


class ModeleQuiz extends Connection {

    public function getRandomQuestions($categorie_name, $amount) {
        $prepare = self::$db->prepare("SELECT * FROM question NATURAL JOIN categorie WHERE categorie_name = ? ORDER BY rand() LIMIT ?;");
        $prepare->execute(array($categorie_name, $amount));

        $prepare = $prepare->fetch();
        return $prepare;
    }

    public function getQuestion($enonce) {
        $prepare = self::$db->prepare("SELECT * FROM question WHERE question_enonce = ?;");
        $prepare->execute(array($enonce));

        $prepare = $prepare->fetch();
        return $prepare;
    }

    public function getReponse($enonce) {
        return $this->getQuestion($enonce)['question_reponse'];
    }
}