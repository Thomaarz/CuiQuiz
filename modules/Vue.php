
<?php


class Vue
{

    public function header() {
        ?>

        <header>
            <a href="index.php?module=accueil"><img src="images/logo.png" alt="CuiCuiz" id="header-img"></a>
            <?php

            if (isset($_SESSION['user_name'])) {
                ?>
                <a href="index.php?module=compte" class="blue-button">Mon Compte</a>
                <?php
            } else{
                ?>
                <a href="index.php?module=connection&action=connect" class="blue-button">Connexion</a>
                <?php
            }

            ?>
        </header>

        <?php
    }

    public function nav() {
        ?>

        <nav class="menu-nav">
            <a href="index.php?module=accueil" class="white undecorated">Accueil</a>
            <a href="index.php?module=quiz" class="white undecorated">quiz</a>
            <a href="index.php?module=boutique" class="white undecorated">Boutique</a>
            <a href="index.php?module=classement" class="white undecorated">Classement</a>
        </nav>

        <?php
    }

    public function footer() {
        ?>

        <footer>
            <div>
                <strong class="white underline">Catégories:</strong>
                <nav>
                    <a href="index.php?module=quiz&category=sport" class="link">Sport</a>
                    <a href="index.php?module=quiz&category=oiseaux" class="link">Oiseaux</a>
                    <a href="index.php?module=quiz&category=histoire" class="link">Histoire</a>
                </nav>
            </div>
            <div>
                <strong class="white underline">CuiQuiz:</strong>
                <nav>
                    <a href="index.php?module=accueil" class="link">Accueil</a>
                    <a href="index.php?module=contact" class="link">Contact</a>
                    <a href="index.php?module=about" class="link">About</a>
                </nav>
            </div>
        </footer>

        <?php
    }

}