<?php require_once("Includes/functions.php"); ?>
<?php require_once("Includes/sessions.php"); ?>
<?php

$_SESSION["id"] = NULL;
$_SESSION["username"] = NULL;
redirect_to("login.php");
?>