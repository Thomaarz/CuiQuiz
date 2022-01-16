<?php

include "ModeleQuizPerso.php";
include "VueQuizPerso.php";

class ControllerQuizPerso
{

    private $modele;
    private $vue;

    public function __construct() {
        $this->vue = new VueQuizPerso();
        $this->modele = new ModeleQuizPerso();
    }

    public function main() {

        if (!isset($_SESSION['user_name'])) {
            return;
        }

        $user = (new ModeleConnection())->getUser($_SESSION['user_name']);
        if (!isset($user) || empty($user)) {
            return;
        }

        $quiz_id = -1;
        if (isset($_GET['quiz_id'])) {
            $quiz_id = $_GET['quiz_id'];
        }

        $action = "manage";
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        }

        switch ($action) {
            case "create":
                $this->create($user);
                break;
            case "view":
                $this->view($quiz_id);
                break;
            case "insert":
                $this->insert($quiz_id);
                break;
            case "delete":
                $this->delete($quiz_id);
                break;
            case "edit":
                $this->edit();
                break;
            default:
                $this->manageQuiz($user);
                break;
        }
    }

    private function manageQuiz($user) {
        $this->vue->manage($this->modele->getQuizPersoByUser($user['user_id']));
    }

    private function view($quiz_id) {
        if ($quiz_id == -1) {
            return;
        }

        $this->vue->view($this->modele->getQuizPerso($quiz_id), (new ModeleQuiz())->getQuizPersoQuestions($quiz_id));
    }

    private function create($user) {
        if (isset($_POST['form-perso-create'])) {
            $quiz_id = $this->modele->insertquizPerso($_POST['name'], $user['user_id']);
            $this->vue->createQuiz();
            header("refresh:1;url=index.php?module=quiz_perso&action=view&quiz_id=" . $quiz_id);
            return;
        }

        $this->vue->create();
    }

    private function insert($quiz_id) {
        if ($quiz_id == -1) {
            return;
        }

        if (isset($_POST['form-perso-insert'])) {

            $this->modele->insertQuestionPerso($quiz_id, $_POST['enonce'], $_POST['reponse']);
            $this->vue->addQuestion();
            header("refresh:2;url=index.php?module=quiz_perso&action=view&quiz_id=" . $quiz_id);
            return;
        }

        $this->vue->formInsert();
    }

    public function delete($quiz_id) {

        // Delete question
        if ($quiz_id == -1) {
            $question_id = -1;
            if (isset($_GET['question_id'])) {
                $question_id = $_GET['question_id'];
            }

            if ($question_id == -1) {
                return;
            }

            $this->modele->deleteQuestionPerso($question_id);
            $this->vue->deleteQuestion();
            header("refresh:1;url=index.php?module=quiz_perso&quiz_id=" . $quiz_id);
            return;
        }

        // Delete quiz
        $this->modele->deleteQuizPerso($quiz_id);
        $this->vue->deleteQuiz();
        header("refresh:1;url=index.php?module=quiz_perso");

    }

    public function edit() {

        $question_id = -1;
        if (isset($_GET['question_id'])) {
            $question_id = $_GET['question_id'];
        }

        if ($question_id == -1) {
            return;
        }

        $question = $this->modele->getQuizPersoQuestions($question_id);

        // Update question
        if (isset($_POST['form-perso-update'])) {
            $this->modele->updateQuestionPerso($question_id, $_POST['enonce'], $_POST['reponse']);
            $this->vue->updateQuestion();
            header("refresh:1;url=index.php?module=quiz_perso&action=view&quiz_id=" . $question['quiz_perso_id']);
            return;
        }

        // Show form
        $this->vue->formUpdate($question);

    }

}