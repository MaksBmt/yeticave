<?php
require_once("helpers.php");
require_once("functions.php");
require_once("init.php");
require_once("models.php");

if (!$con) {
    $error = mysqli_connect_error();
} else {
    $sql = "SELECT character_code, name_category FROM categories";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($con);
    }
}

$sql = get_query_list_lots('2021-07-15');

$res = mysqli_query($con, $sql);
if ($res) {
   $lots = mysqli_fetch_all($res, MYSQLI_ASSOC);
} else {
   $error = mysqli_error($con);
}

$page_content = include_template("main.php", [
    "categories" => $categories,
    "lots" => $lots
]);
 $layout_content = include_template("layout.php",[
     "content" => $page_content,
     "categories" => $categories,
     "title" => "Главная"
 ]);

 print($layout_content);
 


