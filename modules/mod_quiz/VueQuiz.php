<?php


class VueQuiz {

    public function choose($categories) {
        ?>

        <div class="main-box">
            <h1 class="main-title">Choix</h1>
            <div class="main-subbox">
                <h2 class="orange-button">Categories</h2>
                <nav>
                    <?php

                    foreach ($categories as $category) {
                        ?>

                        <a href="index.php?module=quizz&action=play&category=<?=$category['categorie_id'];?>" class="orange-button-small">
                            <?=ucfirst($category['categorie_name']);?>
                        </a>

                        <?php
                    }

                    ?>
                </nav>
            </div>
        </div>

        <?php
    }

    public function quizRecap($questions, $corrects, $wrongs, $percent) {
        ?>

        <div class="main-box">
            <h1 class="main-title">Recapitulatif</h1>
            <div class="main-subbox">
                <p class="big-2">
                    Vous avez répondu à un total de <span class="orange-button-small"><?=$corrects + $wrongs;?></span>
                    questions. Vous avez eu bon à <span class="orange-button-small"><?=$corrects;?></span> questions et faux
                    à <span class="orange-button-small"><?=$wrongs;?></span> questions.<br/>
                    Votre score est de <span class="orange-button-small"><?=$percent;?></span>%.
                </p>

                <div class="quizz-recap-box">
                    <?php

                    foreach ($questions as $question) {
                        $reponse = $question['question_reponse'];
                        $user_reponse = $_POST['reponse-' . $question['question_id']];
                        $class = strtolower($reponse) == strtolower($user_reponse) ? "quizz-correct" : "quizz-wrong";
                        ?>

                        <div class="quizz-question-recap-box">
                            <h2><?=$question['question_enonce'];?></h2>
                            <h3 class="quizz-initial">Réponse attendue: <?=$reponse;?></h3>
                            <h3 class="<?=$class;?>">Ta Réponse: <?=$user_reponse;?></h3>
                        </div>

                        <?php
                    }

                    ?>
                </div>

                <p class="big-2">
                    Bien joué à toi ! Clique <a class="orange-button-small" href="index.php?module=quizz&action=choose">ici</a> pour
                    rejouer !
                </p>
            </div>
        </div>

        <?php
    }

    public function quizz($questions) {
        ?>

        <div class="main-box">
            <form method="post" autocomplete="off">
                <h2 class="orange-button">Quizz de <?=sizeof($questions);?> questions</h2>
                <?php

                $id = 1;
                foreach ($questions as $question) {
                    $this->question($question, $id);
                    $id++;
                }

                ?>
                <input type="submit" class="orange-button" name="form-quizz" value="Envoyer">
            </form>
        </div>

        <?php
    }

    public function question($question, $id) {
        $name = "reponse-" . $question['question_id'];
        ?>

        <div class="main-subbox" id="quizz-box-<?=$id;?>">
            <label class="line-value big-2" for="<?=$name;?>"><?=$question['question_enonce'];?></label>
            <input type="text" class="quizz-input" name="<?=$name;?>" placeholder="réponse" required>
        </div>

        <?php
    }

}