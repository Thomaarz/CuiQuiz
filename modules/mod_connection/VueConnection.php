<?php

class VueConnection {

    public function formConnection() {
        ?>

        <form method="post">
            <input type="text" name="pseudo" placeholder="test@gmail.com" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="submit" name="connection-form">
        </form>

        <?php
    }

    public function formRegister() {
        ?>

        <form method="post">
            <input type="text" name="pseudo" placeholder="test@gmail.com" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="submit" name="register-form">
        </form>

        <?php
    }

    public function alreadyConnected() {
        ?>

        <p>Vous êtes déjà connecté</p>

        <?php
    }

    public function wrongPassword() {
        ?>

        <p>Mauvais mot de passe</p>

        <?php
    }

    public function alreadyExist() {
        ?>

        <p>Ce nom d'utilisateur est déjà utilisé, <a href="index.php?module=connection&action=connect">Se connecter</a>.</p>

        <?php
    }

    public function notExist() {
        ?>

        <p>Vous devez tout d'abord vous inscrire, <a href="index.php?module=connection&action=register">S'inscrire'</a>.</p>

        <?php
    }

}