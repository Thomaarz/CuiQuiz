<?php

include "ModeleQuiz.php";
include "VueQuiz.php";

class ControllerQuiz {

    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleQuiz();
        $this->vue = new VueQuiz();
    }

    public function main() {

        $action = "choose";
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        }

        switch ($action) {
            case 'play':
                $this->play();
                break;
            default:
                $this->vue->choose($this->modele->getCategories(), $this->modele->getquizPerso());
                break;

        }
    }

    private function play() {

        // Default quiz
        if (isset($_POST['form-quiz']) && isset($_SESSION['questions'])) {
            $this->recap();
            return;
        }

        // Perso quiz
        if (isset($_POST['form-quiz-perso']) && isset($_SESSION['questions'])) {
            $this->recapPerso();
            return;
        }

        if (!isset($_GET['category'])) {
            $this->vue->choose($this->modele->getCategories(), $this->modele->getquizPerso());
            return;
        }

        $category_id = $_GET['category'];

        // Quiz perso
        if ($category_id === "perso") {
            if (!isset($_GET['id'])) {
                return;
            }
            $_SESSION['questions'] = $this->modele->getquizPersoQuestions($_GET['id']);
            $this->vue->quizPerso($_SESSION['questions']);
            return;
        }

        $_SESSION['questions'] = $this->modele->getRandomQuestions($category_id);
        $this->vue->quiz($_SESSION['questions']);
    }

    private function recap() {
        $questions = $_SESSION['questions'];
        $corrects = 0;
        $wrongs = 0;

        $tentative_id = 0;
        $connected = isset($_SESSION['user_name']) && !empty($_SESSION['user_name']);
        if ($connected) {
            $user = (new ModeleConnection())->getUser($_SESSION['user_name']);
            if (!isset($user) || empty($user)) {
                $connected = false;
            } else {
                $tentative_id = $this->modele->insertTentative($user['user_id']);
            }
        }

        foreach ($questions as $question) {
            $input_answer = $_POST['reponse-' . $question['question_id']];
            $answer = $question['question_reponse'];

            if ($this->vue->percentSimilarity($input_answer, $answer) >= 80) {
                $corrects++;
            } else {
                $wrongs++;
            }

            if ($connected) {
                $this->modele->insertReponses($tentative_id, $question['question_id'], $input_answer);
            }
        }
        $coins = $corrects * 2;
        $experience = $corrects * 10;
        if ($connected) {
            $this->modele->addCoins($user['user_id'], $coins);
            $this->modele->addExperience($user['user_id'], $experience);
        }
        $total = $corrects + $wrongs;
        $percent = round(($corrects * 100) / ($total < 1 ? 1 : $total), 0);
        $this->vue->quizRecap($questions, $corrects, $wrongs, $percent, $coins, $experience);
        unset($_SESSION['questions']);
    }

    private function recapPerso() {
        $questions = $_SESSION['questions'];
        $corrects = 0;
        $wrongs = 0;

        $tentative_id = 0;
        $connected = isset($_SESSION['user_name']) && !empty($_SESSION['user_name']);
        if ($connected) {
            $user = (new ModeleConnection())->getUser($_SESSION['user_name']);
            if (!isset($user) || empty($user)) {
                $connected = false;
            } else {
                $tentative_id = $this->modele->insertTentativePerso($user['user_id'], $questions[0]['quiz_perso_id']);
            }
        }

        foreach ($questions as $question) {
            $input_answer = $_POST['reponse-' . $question['question_perso_id']];
            $answer = $question['question_perso_reponse'];

            if ($this->vue->percentSimilarity($input_answer, $answer) >= 80) {
                $corrects++;
            } else {
                $wrongs++;
            }

            if ($connected) {
                $this->modele->insertReponsesPerso($tentative_id, $question['question_perso_id'], $input_answer);
            }
        }
        $total = $corrects + $wrongs;
        $percent = round(($corrects * 100) / ($total < 1 ? 1 : $total), 0);
        $this->vue->quizRecapPerso($questions, $corrects, $wrongs, $percent);
        unset($_SESSION['questions']);
    }

}