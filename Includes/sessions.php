<?php

session_start();

function message() {
    if (isset($_SESSION["message"])) {
        $output = "<div class=\"message\">";
        $output .= htmlentities($_SESSION["message"]);
        $output .= "</div>";


        $_SESSION["message"] = NULL;

        return $output;
    }
}

function message1() {
    if (isset($_SESSION["message1"])) {
        $output = "<div class=\"message1\">";
        $output .= htmlentities($_SESSION["message1"]);
        $output .= "</div>";


        $_SESSION["message1"] = NULL;

        return $output;
    }
}

?>