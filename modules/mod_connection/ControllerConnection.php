<?php

require "ModeleConnection.php";
require "VueConnection.php";

class ControllerConnection
{

    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleConnection();
        $this->vue = new VueConnection();
    }

    public function register() {

        // Register form not send
        if (!isset($_POST['register-form'])) {

            // Show register form
            $this->vue->formRegister();
            return;
        }

        $user_name = $_POST['pseudo'];
        $password = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // User already exist
        $user = $this->modele->getUser($user_name);
        if (isset($user)) {
            $this->vue->alreadyExist();

            echo 2;
            return;
        }

        // Insert user into database & set session variable
        $this->modele->createUser($user_name, $password_hash);
        $_SESSION['user_name'] = $user_name;

        echo $_SESSION['user_name'];
    }

    public function connect() {

        // Connection form not send
        if (!isset($_POST['connection-form'])) {

            // Show connection form
            $this->vue->formConnection();
            return;
        }

        // If already connected
        if ($this->isConnected()) {
            $this->vue->alreadyConnected();
            return;
        }
    }

    public function disconnect() {

        // If not connected
        if (!$this->isConnected()) {
            return;
        }

        // Disconnect & unset session variable
        unset($_SESSION['user_name']);
        $this->connect();
    }

    private function isConnected() {
        return isset($_SESSION['user_name']);
    }

}