<?php
require_once("helpers.php");
require_once("functions.php");
require_once("init.php");
require_once("functions.php");
require_once("models.php");

// $sql_cat = "SELECT character_code, name_category FROM categories";
$sql_lots = get_query_list_lots('2019-04-15');
// $sql_lot = "SELECT * FROM lots WHERE lots.id = '$lot_id'";

if (!$con) {
    $error = mysqli_connect_error();
    $page_content = include_template("error.php", ["error"=>$error]); 
} else {
    $categories = get_data($con, $sql_cat);
    $lots = get_data($con, $sql_lots);

    $page_content = include_template("main.php", [
      "categories" => $categories,
      "lots" => $lots
    ]); 
}

$layout_content = include_template("layout.php",[
    "content" => $page_content,
    "categories" => $categories,
    "title" => "Главная"
 ]);

print($layout_content);
