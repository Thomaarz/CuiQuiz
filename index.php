<?php
@ini_set('display_errors', 'on');

session_start();

include "modules/Controller.php";

$module = "Accueil";
if (isset($_GET['module'])) {
    $module = $_GET['module'];
}

?>
<html lang="fr">
<head>
    <title>CuiQuiz - <?=ucfirst($module);?></title>
    <meta charset="utf-8">
    <link rel="icon" href="images/logo.png">

    <!-- FONTS -->
    <link rel="stylesheet" type="text/css" href="style/font.css">
    <link href="https://fonts.googleapis.com/css?family=Ruda" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="style/default.css">
    <link rel="stylesheet" type="text/css" href="style/header.css">
    <link rel="stylesheet" type="text/css" href="style/nav.css">
    <link rel="stylesheet" type="text/css" href="style/main.css">
    <link rel="stylesheet" type="text/css" href="style/footer.css">
    <link rel="stylesheet" type="text/css" href="style/connection.css">
    <link rel="stylesheet" type="text/css" href="style/account.css">
    <link rel="stylesheet" type="text/css" href="style/quiz.css">
    <link rel="stylesheet" type="text/css" href="style/shop.css">
    <link rel="stylesheet" type="text/css" href="style/classement.css">

</head>
<body>

<?php

$controller = new Controller();
$controller->main();

?>

</body>
</html>

