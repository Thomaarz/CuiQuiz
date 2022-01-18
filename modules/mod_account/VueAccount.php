<?php


class VueAccount
{

    public function infos($user) {
        ?>

        <div class="main-box">
            <h1 class="main-title">Mon Compte</h1>
            <div id="account-box">
                <div id="account-banner">
                    <img src="images/profil.png" id="account-img">
                    <div id="account-banner-infos">
                        <h2><?=$user['user_name'];?></h2>
                        <h2><?=$user['rank_name'];?></h2>
                    </div>
                </div>
                <div id="account-mainbox">
                    <div class="line">
                        <h2 class="line-key blue-button">Adresse Mail</h2>
                        <h2 class="line-value"><?=$user['user_email'];?></h2>
                    </div>
                    <div class="line">
                        <h2 class="line-key blue-button">Coins</h2>
                        <h2 class="line-value"><?=$user['user_coins'];?></h2>
                    </div>
                    <div class="line">
                        <h2 class="line-key blue-button">Niveau</h2>
                        <h2 class="line-value"><?=$user['user_level'];?></h2>
                    </div>
                    <div class="line">
                        <h2 class="line-key blue-button">Experience</h2>
                        <h2 class="line-value"><?=$user['user_experience'];?>/1000</h2>
                    </div>

                    <div class="line">
                        <h2 class="line-key blue-button">Titre</h2>
                        <h2 class="line-value"><?=$user['titre_name'];?></h2>
                    </div>
                </div>
                <div id="account-bottom">
                    <a href="index.php?module=compte&action=historique" class="blue-button">Historique</a>
                    <a href="index.php?module=quiz_perso" class="blue-button">Quiz personnalise</a>
                    <a href="index.php?module=connection&action=disconnect" class="blue-button">Deconnexion</a>
                </div>
            </div>
        </div>

        <?php
    }

    public function historique($tentatives) {
        ?>

        <div class="main-box">
            <h1 class="main-title">Historique</h1>
            <div>
                <?php

                $i = 1;
                foreach ($tentatives as $tentative) {
                    ?>

                    <a href="index.php?module=compte&action=historique&tentative=<?=$tentative['tentative_id'];?>" class="historique-box">
                        <h2>Tentative #<?=$i++;?></h2>
                        <h2>Le <?=date('d/m/Y à H:i', strtotime($tentative['tentative_date']));?></h2>
                    </a>

                    <?php
                }

                ?>
            </div>
        </div>

        <!--
        <script>
            $(document).ready(function () {
                $('.historique-box').click(function () {
                    const tentativeId = $(this).attr("id");
                    $.ajax({
                        url: "{{ url('index.php?module=compte','post') }}",
                        type: 'POST',
                        data: {
                            tentativeId: tentativeId
                        },
                        dataType: "text",
                        success: function (res) {
                            window.location.reload();
                            try {
                                res = JSON.parse(res);
                                console.log(res);
                            } catch (e) {}
                        },
                        error: function (request, err) {
                            console.error(err);
                        }
                    })
                })
            });
        </script>
        -->

        <?php
    }

    public function historiqueTentative($reponses) {
        ?>
        <div class="main-box">
            <h1 class="main-title">Historique</h1>
            <p>
                Regardez votre tentative pour vous améliorer !
            </p>
            <div>
                <?php

                foreach ($reponses as $reponse) {
                    $question = (new ModeleQuiz())->getQuestion($reponse['question_id']);
                    $user_reponse = $reponse['reponse_value'];
                    $class = (new VueQuiz())->percentSimilarity($question['question_reponse'], $user_reponse) >= 80 ? "quiz-correct" : "quiz-wrong";
                    ?>

                    <div class="quiz-question-recap-box">
                        <h2><?=$question['question_enonce'];?></h2>
                        <h3 class="quiz-initial">Réponse attendue: <?=$question['question_reponse'];?></h3>
                        <h3 class="<?=$class;?>">Ta Réponse: <?=$user_reponse;?></h3>
                    </div>

                    <?php
                }

                ?>
            </div>
            <div>
                <a href="index.php?module=compte&action=historique" class="blue-button">Retour</a>
            </div>
        </div>
        <?php
    }
}