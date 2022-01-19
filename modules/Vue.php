
<?php


class Vue
{

    /**
     * Show the header
     */
    public function header() {
        ?>

        <header>
            <a href="index.php?module=accueil"><img src="images/logo_2.png" alt="CuiCuiz" id="header-img"></a>
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

    /**
     * Show the menu nav
     */
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

    /**
     * Show the footer
     */
    public function footer() {
        ?>

        <footer>
            <div>
                <strong class="white underline">Catégories:</strong>
                <nav>
                    <a href="index.php?module=quiz&action=play&category=3" class="link">Sport</a>
                    <a href="index.php?module=quiz&action=play&category=1" class="link">Oiseaux</a>
                    <a href="index.php?module=quiz&action=play&category=2" class="link">Histoire</a>
                </nav>
            </div>
            <div>
                <strong class="white underline">CuiCuiz:</strong>
                <nav>
                    <a href="index.php?module=accueil" class="link">Accueil</a>
                    <a href="mailto:cuicuiz@gmail.com" class="link">Contact</a>
                    <a href="index.php?module=accueil" class="link">About</a>
                </nav>
            </div>
        </footer>

        <?php
    }

}