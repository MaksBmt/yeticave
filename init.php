<?php
session_start();

$is_auth = !empty($_SESSION["name"]);
if ($is_auth) {
    $user_name = $_SESSION["name"];
}

$con = mysqli_connect("localhost", "root", "", "yeticave");
mysqli_set_charset($con, "utf8");
