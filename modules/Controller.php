<?php

require_once "Connection.php";

include "Vue.php";

include "mod_home/ControllerHome.php";
include "mod_connection/ControllerConnection.php";
include "mod_account/ControllerAccount.php";
include "mod_quiz/ControllerQuiz.php";
include "mod_quiz_perso/ControllerQuizPerso.php";

class Controller {

    private $vue;

    public function __construct() {
        $this->vue = new Vue();
        Connection::initConnection();
    }

    public function main() {
        $module = "accueil";

        if (isset($_GET['module'])) {
            $module = $_GET['module'];
        }

        $this->vue->header();
        $this->vue->nav();

        ?>

        <main>
            <?php

            switch ($module) {
                case 'connection':
                    $controller = new ControllerConnection();
                    $controller->main();
                    break;
                case 'compte':
                    $controller = new ControllerAccount();
                    $controller->main();
                    break;
                case 'quiz':
                    $controller = new ControllerQuiz();
                    $controller->main();
                    break;
                case 'quiz_perso':
                    $controller = new ControllerQuizPerso();
                    $controller->main();
                    break;
                default:
                    $controller = new ControllerHome();
                    $controller->main();
                    break;
            }

            ?>
        </main>

        <?php

        $this->vue->footer();
    }
}