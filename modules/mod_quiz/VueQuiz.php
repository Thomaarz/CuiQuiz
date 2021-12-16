<?php


class VueQuiz {

    public function choose($categories, $quiz_community) {
        ?>

        <div class="main-box">
            <h1 class="main-title">Choix</h1>
            <div class="main-subbox" id="quiz-main">
                <div id="quiz-categories">
                    <h2 class="orange-button">Categories</h2>
                    <nav>
                        <?php

                        foreach ($categories as $category) {
                            ?>

                            <a href="index.php?module=quiz&action=play&category=<?=$category['categorie_id'];?>" class="orange-button-small">
                                <?=ucfirst($category['categorie_name']);?>
                            </a>

                            <?php
                        }

                        ?>
                    </nav>
                </div>
                <div id="quiz-categories-perso">
                    <h2 class="orange-button">Communaute</h2>
                    <p class="big-2">
                        Jouez aux thèmes crées par la communauté !
                    </p>
                    <nav>
                        <?php

                        foreach ($quiz_community as $quiz) {
                            ?>

                            <a href="index.php?module=quiz&action=play&category=perso&id=<?=$quiz['quiz_perso_id'];?>" class="orange-button-small">
                                <?=ucfirst($quiz['quiz_perso_name']);?>
                            </a>

                            <?php
                        }

                        ?>
                    </nav>
                </div>
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

                <div class="quiz-recap-box">
                    <?php

                    foreach ($questions as $question) {
                        $reponse = $question['question_reponse'];
                        $user_reponse = $_POST['reponse-' . $question['question_id']];
                        $class = $this->percentSimilarity($reponse, $user_reponse) >= 80 ? "quiz-correct" : "quiz-wrong";
                        ?>

                        <div class="quiz-question-recap-box">
                            <h2><?=$question['question_enonce'];?></h2>
                            <h3 class="quiz-initial">Réponse attendue: <?=$reponse;?></h3>
                            <h3 class="<?=$class;?>">Ta Réponse: <?=$user_reponse;?></h3>
                        </div>

                        <?php
                    }

                    ?>
                </div>

                <p class="big-2">
                    Bien joué à toi ! Clique <a class="orange-button-small" href="index.php?module=quiz&action=choose">ici</a> pour
                    rejouer !
                </p>
            </div>
        </div>

        <?php
    }

    public function quizRecapPerso($questions, $corrects, $wrongs, $percent) {
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

                <div class="quiz-recap-box">
                    <?php

                    foreach ($questions as $question) {
                        $reponse = $question['question_perso_reponse'];
                        $user_reponse = $_POST['reponse-' . $question['question_perso_id']];
                        $class = $this->percentSimilarity($reponse, $user_reponse) >= 80 ? "quiz-correct" : "quiz-wrong";
                        ?>

                        <div class="quiz-question-recap-box">
                            <h2><?=$question['question_perso_enonce'];?></h2>
                            <h3 class="quiz-initial">Réponse attendue: <?=$reponse;?></h3>
                            <h3 class="<?=$class;?>">Ta Réponse: <?=$user_reponse;?></h3>
                        </div>

                        <?php
                    }

                    ?>
                </div>

                <p class="big-2">
                    Bien joué à toi ! Clique <a class="orange-button-small" href="index.php?module=quiz&action=choose">ici</a> pour
                    rejouer !
                </p>
            </div>
        </div>

        <?php
    }

    public function quiz($questions) {
        ?>

        <div class="main-box">
            <form method="post" autocomplete="off">
                <h2 class="orange-button">quiz de <?=sizeof($questions);?> questions</h2>
                <?php

                $id = 1;
                foreach ($questions as $question) {
                    $this->question($question, $id);
                    $id++;
                }

                ?>
                <input type="submit" class="orange-button" name="form-quiz" value="Envoyer">
            </form>
        </div>

        <?php
    }

    public function question($question, $id) {
        $name = "reponse-" . $question['question_id'];
        ?>

        <div class="main-subbox" id="quiz-box-<?=$id;?>">
            <label class="line-value big-2" for="<?=$name;?>"><?=$question['question_enonce'];?></label>
            <input type="text" class="quiz-input" name="<?=$name;?>" placeholder="réponse" required>
        </div>

        <?php
    }

    public function quizPerso($questions) {
        ?>

        <div class="main-box">
            <form method="post" autocomplete="off">
                <h2 class="orange-button">quiz Personnalise de <?=sizeof($questions);?> questions</h2>
                <?php

                $id = 1;
                foreach ($questions as $question) {
                    $this->questionPerso($question, $id);
                    $id++;
                }

                ?>
                <input type="submit" class="orange-button" name="form-quiz-perso" value="Envoyer">
            </form>
        </div>

        <?php
    }

    public function questionPerso($question, $id) {
        $name = "reponse-" . $question['question_perso_id'];
        ?>

        <div class="main-subbox" id="quiz-box-<?=$id;?>">
            <label class="line-value big-2" for="<?=$name;?>"><?=$question['question_perso_enonce'];?></label>
            <input type="text" class="quiz-input" name="<?=$name;?>" placeholder="réponse" required>
        </div>

        <?php
    }

    public function percentSimilarity($text_base, $text_input) {
        $text_input = strtolower($text_input);
        $text_input = iconv('UTF-8','ASCII//TRANSLIT', $text_input);

        $text_base = strtolower($text_base);
        $text_base = iconv('UTF-8','ASCII//TRANSLIT', $text_base);

        similar_text($text_base, $text_input, $percent);

        return $percent;
    }

}