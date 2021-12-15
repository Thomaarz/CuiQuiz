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
                $this->vue->choose($this->modele->getCategories());
                break;

        }
    }

    private function play() {
        if (isset($_POST['form-quizz']) && isset($_SESSION['questions'])) {
            $this->recap();
            return;
        }

        if (!isset($_GET['category'])) {
            $this->vue->choose($this->modele->getCategories());
            return;
        }

        $category_id = $_GET['category'];
        $amount = 10;

        $_SESSION['questions'] = $this->modele->getRandomQuestions($category_id, $amount);
        $this->vue->quizz($_SESSION['questions']);
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

            if (strtolower($input_answer) == strtolower($answer)) {
                $corrects++;
            } else {
                $wrongs++;
            }

            if ($connected) {
                $this->modele->insertReponses($tentative_id, $question['question_id'], $corrects,$wrongs, $input_answer);
            }
        }
        $total = $corrects + $wrongs;
        $percent = round(($corrects * 100) / ($total < 1 ? 1 : $total), 0);
        $this->vue->quizRecap($questions, $corrects, $wrongs, $percent);
        unset($_SESSION['questions']);
    }

}