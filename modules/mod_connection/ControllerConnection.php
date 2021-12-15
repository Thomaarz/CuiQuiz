<?php

require "ModeleConnection.php";
require "VueConnection.php";

class ControllerConnection {

    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleConnection();
        $this->vue = new VueConnection();
    }

    public function main() {
        $action = "";
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        }

        switch ($action) {
            case 'disconnect':
                $this->disconnect();
                break;
            case 'register':
                $this->register();
                break;
            default:
                $this->connect();
                break;
        }
    }

    private function register() {

        // Register form not send
        if (!isset($_POST['register-form'])) {
            $this->vue->formRegister();
            return;
        }

        $user_name = $_POST['pseudo'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password-confirm'];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Already exist
        $user = $this->modele->getUser($user_name);
        if (isset($user) && !empty($user)) {
            $this->vue->alreadyExist();
            $this->vue->formRegister();
            return;
        }

        // Different passwords
        if ($password != $password_confirm) {
            $this->vue->differentPassword();
            $this->vue->formRegister();
            return;
        }

        // Insert user into database & set session variable
        $this->modele->createUser($user_name, $email, $password_hash);
        $_SESSION['user_name'] = $user_name;
        header( "refresh:0;url=index.php?module=compte");
    }

    private function connect() {

        // Connection form not send
        if (!isset($_POST['connection-form'])) {
            $this->vue->formConnection();
            return;
        }

        // Already connected
        if ($this->isConnected()) {
            $this->vue->connectionSuccess();
            return;
        }

        $user_name = $_POST['pseudo'];
        $password = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $user = $this->modele->getUser($user_name);

        // User not exist
        if (!isset($user) || empty($user)) {
            $this->vue->notExist();
            $this->vue->formConnection();
            return;
        }

        // Wrong password
        if (!password_verify($password, $user['user_password'])) {
            $this->vue->wrongPassword();
            $this->vue->formConnection();
            return;
        }

        $_SESSION['user_name'] = $user_name;
        header( "refresh:0;url=index.php?module=compte");
    }

    private function disconnect() {

        // If not connected
        if (!$this->isConnected()) {
            return;
        }

        // Disconnect & unset session variable
        unset($_SESSION['user_name']);
        $this->connect();
        header( "refresh:0;url=index.php?module=connection&action=connect");
    }

    private function isConnected() {
        return isset($_SESSION['user_name']);
    }

}