<?php


class VueQuizPerso
{

    public function formInsert($quiz_id) {
        ?>

        <div class="main-box">
            <h1 class="main-title">Inserer question</h1>
            <div class="main-subbox">
                <form method="post">
                    <div class="form-line">
                        <label class="big-2" for="enonce">Enonce</label>
                        <input class="input" type="text" name="enonce" placeholder="Enonce" required>
                    </div>

                    <div class="form-line">
                        <label class="big-2" for="reponse">Réponse</label>
                        <input class="input" type="text" name="reponse" placeholder="réponse" required>
                    </div>

                    <input class="orange-button" type="submit" name="form-perso-insert" value="Ajouter">
                </form>
            </div>
        </div>

        <?php
    }

    public function manage($quiz) {
        ?>

        <div class="main-box">
            <h1 class="main-title">Mes Quizs</h1>
            <div class="main-subbox">
                <?php

                foreach ($quiz as $q) {
                    ?>

                    <a class="orange-button-small" href="index.php?module=quiz_perso&action=view&quiz_id=<?=$q['quiz_perso_id'];?>">
                        <?=$q['quiz_perso_name'];?>
                    </a>

                    <?php
                }

                ?>
                <nav>
                    <a class="orange-button" href="index.php?module=quiz_perso&action=create">Creer un quiz</a>
                </nav>
            </div>
        </div>

        <?php
    }

    public function view($quiz, $questions) {
        ?>

        <div class="main-box">
            <h1 class="main-title">Quiz <?=$quiz['quiz_perso_name'];?></h1>
            <div class="main-subbox">
                <?php

                foreach ($questions as $question) {
                    ?>

                    <div class="quiz-perso-view-line">
                        <h2><?=$question['question_perso_enonce'];?></h2>
                        <h2><?=$question['question_perso_reponse'];?></h2>
                        <a class="orange-button-small" href="index.php?module=quiz_perso&action=delete&question_id=<?=$question['question_perso_id'];?>">
                            Supprimer la question
                        </a>
                    </div>

                    <?php
                }

                ?>
                <nav id="quiz-perso-actions">
                    <div>
                        <a class="orange-button" href="index.php?module=quiz_perso&action=insert&quiz_id=<?=$quiz['quiz_perso_id'];?>">Inserer une question</a>
                        <a class="orange-button" href="index.php?module=quiz&action=play&category=perso&id=<?=$quiz['quiz_perso_id'];?>">Tester le quiz</a>
                    </div>
                    <a class="orange-button" href="index.php?module=quiz_perso&action=delete&quiz_id=<?=$quiz['quiz_perso_id'];?>">Supprimer</a>
                </nav>
            </div>
        </div>

        <?php
    }

    public function create() {
        ?>

        <div class="main-box">
            <h1 class="main-title">Creer un quiz</h1>
            <div class="main-subbox">
                <form method="post">
                    <div class="form-line">
                        <label class="big-2" for="name">Nom</label>
                        <input class="input" type="text" name="name" placeholder="Nom" required>
                    </div>

                    <input class="orange-button" type="submit" name="form-perso-create" value="Creer">
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

    public function createquiz() {
        ?>

        <div class="success-message">
            <p class="big-1">Quiz crée avec succès !</p>
        </div>

        <?php
    }

    public function deletequiz() {
        ?>

        <div class="success-message">
            <p class="big-1">Quiz supprimé avec succès !</p>
        </div>

        <?php
    }

}