<?php


class VueAccount
{

    public function main($user) {
        ?>

        <div class="main-box">
            <h1 class="main-title">Mon Compte</h1>
            <div id="account-box">
                <div id="account-banner">
                    <img src="images/profile.png" id="account-img">
                    <div id="account-banner-infos">
                        <h2><?=$user['user_name'];?></h2>
                        <h2><?=$user['rank_name'];?></h2>
                    </div>
                </div>
                <div id="account-mainbox">
                    <div class="line">
                        <h2 class="line-key orange-button">Adresse Mail</h2>
                        <h2 class="line-value"><?=$user['user_email'];?></h2>
                    </div>
                    <div class="line">
                        <h2 class="line-key orange-button">Coins</h2>
                        <h2 class="line-value"><?=$user['user_coins'];?></h2>
                    </div>
                    <div class="line">
                        <h2 class="line-key orange-button">Niveau</h2>
                        <h2 class="line-value"><?=$user['user_level'];?></h2>
                    </div>
                    <div class="line">
                        <h2 class="line-key orange-button">Experience</h2>
                        <h2 class="line-value"><?=$user['user_experience'];?>/1000</h2>
                    </div>
                </div>
                <div id="account-bottom">
                    <a class="orange-button">Historique</a>
                    <a class="orange-button">Theme personnalise</a>
                    <a href="index.php?module=connection&action=disconnect" class="orange-button">Deconnexion</a>
                </div>
            </div>
        </div>

        <?php
    }

}