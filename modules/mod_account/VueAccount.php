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
                </div>
                <div id="account-bottom">
                    <a class="blue-button">Historique</a>
                    <a href="index.php?module=quiz_perso" class="blue-button">Quiz personnalise</a>
                    <a href="index.php?module=connection&action=disconnect" class="blue-button">Deconnexion</a>
                </div>
            </div>
        </div>

        <?php
    }

}