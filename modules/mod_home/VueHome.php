<?php


class VueHome
{

    public function main($actus) {
        ?>

        <div class="main-box">
            <h1 class="main-title">Accueil</h1>
            <div class="main-subbox">
                <h2 class="blue-button big-3">Bienvenue</h2>
                <p class="big-1">
                    Nous vous souhaitons la bienvenue sur CuiCuiz,<br/>
                    Sur notre site, vous pourrez faire des quizz en tout
                    genre et sur plein de sujets variés. Choisissez un thème et répondez au quizz. Il sera composé de 10
                    questions, chacune aura un niveau de difficultés différentes et chaque bonne réponse vous octroiera
                    un certain nombre de points liés à la difficulté de la question. Ces points vous permettront ensuite
                    d'obtenir des récompenses que vous pourrez consulter dans notre onglet Boutique.<br/>
                    Amusez-vous bien sur CuiCuiz !
                </p>
            </div>
            <div class="main-subbox">
                <h2 class="blue-button">A Propos</h2>
                <p class="big-1">
                    Nous sommes 3 oisillons et nous avons pondu ce site web dans le cadre de nos études. Ce site web est parfait pour vous amusez et en même temps pour apprendre.
                </p>
                <p class="big-1">
                    Allez mes poulets prenez votre envol vers ce quizz ludique et amusant.
                    Si vous voulez nous contacter, notre nid est disponible dans l'onglet contact. Faites nous des dons de graines on a faim !<br/>
                    CuiCui !
                </p>
            </div>

            <div class="main-subbox">
                <h2 class="blue-button">Actualites</h2>

                <?php
                if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                    ?>
                    <a class="blue-button-small" href="index.php?module=administration&category=news&action=create">Ajouter une Actualite</a>
                    <?php
                }

                foreach ($actus as $actu) {
                    ?>

                    <div class="actus-box">
                        <div class="actus-box-line">
                            <h1 class="orange-button"><?=$actu['actus_title'];?></h1>
                            <h3 class="white">
                                <?=$actu['actus_sender'];?> <span class="yellow">-</span>
                                <?=date('d/m/Y', strtotime($actu['actus_date']));?> <span class="yellow">-</span>
                                <?=date('H', strtotime($actu['actus_date'])) . 'H' . date('i', strtotime($actu['actus_date']));?>
                                <?php

                                if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                                    ?>
                                    <span class="yellow">-</span>
                                    <a class="blue-button-small" href="index.php?module=administration&category=news&action=edit&actus_id=<?=$actu['actus_id'];?>">
                                        Modifier
                                    </a>
                                    <span class="yellow">-</span>
                                    <a class="blue-button-small" href="index.php?module=administration&category=news&action=delete&actus_id=<?=$actu['actus_id'];?>">
                                        Supprimer
                                    </a>
                                    <?php
                                }

                                ?>
                            </h3>
                        </div>
                        <p class="big-2"><?=$actu['actus_lore'];?></p>
                    </div>

                    <?php
                }

                ?>
            </div>
        </div>

        <?php
    }

}