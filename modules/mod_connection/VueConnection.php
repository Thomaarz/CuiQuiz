<?php


class VueConnection
{

    public function show_connection() {
        ?>

        <form method="post">
            <input type="text" name="pseudo" placeholder="test@gmail.com" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="submit" name="connection">
        </form>

        <?php
    }

    public function show_register() {
        ?>

        <form method="post">
            <input type="text" name="pseudo" placeholder="test@gmail.com" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="password" name="password-confirm" placeholder="Confirmation" required>
            <input type="submit">
        </form>

        <?php
    }

}