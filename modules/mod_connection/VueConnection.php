<?php


class VueConnection
{

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

    public function alreadyExist() {
        ?>

        <p>Ce nom d'utilisateur est déjà utilisé, <a>Se connecter</a>.</p>

        <?php
    }

}