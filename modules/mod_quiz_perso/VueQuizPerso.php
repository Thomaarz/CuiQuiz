<?php


class VueQuizPerso
{

    /**
     * Formulaire d'insertion
     */
    public function formInsert() {
        ?>

        <div class="main-box">
            <h1 class="main-title">Inserer question</h1>
            <div class="main-subbox">
                <form method="post" autocomplete="off">
                    <div class="form-line">
                        <label class="big-2" for="enonce">Enonce</label>
                        <input class="input" type="text" name="enonce" placeholder="Enonce" required>
                    </div>

                    <div class="form-line">
                        <label class="big-2" for="reponse">Réponse</label>
                        <input class="input" type="text" name="reponse" placeholder="réponse" required>
                    </div>

                    <input class="blue-button" type="submit" name="form-perso-insert" value="Ajouter">
                </form>
            </div>
            <nav id="quiz-perso-actions">
                <a class="blue-button" href="index.php?module=quiz_perso">Retour</a>
            </nav>
        </div>

        <?php
    }

    /**
     * Formulaire de modification
     */
    public function formUpdate($question) {
        ?>

        <div class="main-box">
            <h1 class="main-title">Inserer question</h1>
            <div class="main-subbox">
                <form method="post">
                    <div class="form-line">
                        <label class="big-2" for="enonce">Enonce</label>
                        <input class="input" type="text" name="enonce" value="<?=$question['question_perso_enonce'];?>" required>
                    </div>

                    <div class="form-line">
                        <label class="big-2" for="reponse">Réponse</label>
                        <input class="input" type="text" name="reponse" value="<?=$question['question_perso_reponse'];?>" required>
                    </div>

                    <input class="blue-button" type="submit" name="form-perso-update" value="Mettre a jour">
                </form>
            </div>
            <nav id="quiz-perso-actions">
                <a class="blue-button" href="index.php?module=quiz_perso">Retour</a>
            </nav>
        </div>

        <?php
    }

    /**
     * Manager ses quiz perso
     */
    public function manage($quiz) {
        ?>

        <div class="main-box">
            <h1 class="main-title">Mes Quizs</h1>
            <div class="quiz-perso-box">
                <nav class="quiz-perso-box">
                    <?php

                    foreach ($quiz as $q) {
                        $tentatives = sizeof((new ModeleQuizPerso())->getTentatives($q['quiz_perso_id']));
                        $questions = sizeof((new ModeleQuiz())->getQuizPersoQuestions($q['quiz_perso_id']));
                        ?>

                        <div class="quiz-perso-line">
                            <a class="blue-button-small" href="index.php?module=quiz_perso&action=view&quiz_id=<?=$q['quiz_perso_id'];?>">
                                <?=$q['quiz_perso_name'];?>
                            </a>
                            <h2>Tentatives: <?=$tentatives;?></h2>
                            <h2>Questions: <?=$questions;?></h2>
                        </div>

                        <?php
                    }

                    ?>
                </nav>
                <nav id="quiz-perso-manage-actions">
                    <a class="blue-button" href="index.php?module=compte">Retour</a>
                    <a class="blue-button" href="index.php?module=quiz_perso&action=create">Creer un quiz</a>
                </nav>
            </div>
        </div>

        <?php
    }

    /**
     * Manager un quiz perso
     */
    public function view($quiz, $questions) {
        ?>

        <div class="main-box">
            <h1 class="main-title">Quiz <?=$quiz['quiz_perso_name'];?></h1>
            <div class="quiz-perso-box">
                <?php

                foreach ($questions as $question) {
                    ?>

                    <div class="quiz-perso-line">
                        <h2><?=ModeleQuizPerso::limitLenght($question['question_perso_enonce'], 30);?></h2>
                        <h2><?=ModeleQuizPerso::limitLenght($question['question_perso_reponse'], 15);?></h2>
                        <div class="quiz-perso-line-actions">
                            <a id="quiz-view-edit" class="blue-button-small" href="index.php?module=quiz_perso&action=edit&question_id=<?=$question['question_perso_id'];?>">
                                Modifier
                            </a>
                            <a class="blue-button-small" href="index.php?module=quiz_perso&action=delete&question_id=<?=$question['question_perso_id'];?>">
                                Supprimer
                            </a>
                        </div>
                    </div>

                    <?php
                }

                ?>
                <nav id="quiz-perso-actions">
                    <div>
                        <a class="blue-button" href="index.php?module=quiz_perso">Retour</a>
                        <a class="blue-button" href="index.php?module=quiz_perso&action=insert&quiz_id=<?=$quiz['quiz_perso_id'];?>">Inserer une question</a>
                        <a class="blue-button" href="index.php?module=quiz&action=play&category=perso&id=<?=$quiz['quiz_perso_id'];?>">Tester le quiz</a>
                    </div>
                    <a class="blue-button" href="index.php?module=quiz_perso&action=delete&quiz_id=<?=$quiz['quiz_perso_id'];?>">Supprimer</a>
                </nav>
            </div>
        </div>

        <?php
    }

    /**
     * Creer un quiz perso
     */
    public function create() {
        ?>

        <div class="main-box">
            <h1 class="main-title">Creer un quiz</h1>
            <div class="main-subbox">
                <form method="post" autocomplete="off">
                    <div class="form-line">
                        <label class="big-2" for="name">Nom</label>
                        <input class="input" type="text" name="name" placeholder="Nom" required>
                    </div>

                    <input class="blue-button" type="submit" name="form-perso-create" value="Creer">
                </form>
            </div>
        </div>

        <?php
    }

    public function addQuestion() {
        ?>

        <div class="success-message">
            <p class="big-1">Question ajouté avec succès !</p>
        </div>

        <?php
    }

    public function deleteQuestion() {
        ?>

        <div class="success-message">
            <p class="big-1">Question supprimé avec succès !</p>
        </div>

        <?php
    }

    public function updateQuestion() {
        ?>

        <div class="success-message">
            <p class="big-1">Question mise à jour avec succès !</p>
        </div>

        <?php
    }


    public function createQuiz() {
        ?>

        <div class="success-message">
            <p class="big-1">Quiz crée avec succès !</p>
        </div>

        <?php
    }

    public function deleteQuiz() {
        ?>

        <div class="success-message">
            <p class="big-1">Quiz supprimé avec succès !</p>
        </div>

        <?php
    }

}