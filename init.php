<?php
require_once("models.php");

$con = mysqli_connect("localhost", "root", "", "yeticave");
mysqli_set_charset($con, "utf8");

$sql_lots = get_query_list_lots("2020-01-15");
$sql_cat = 'SELECT * FROM categories';

if(!$con){
  $error = mysqli_connect_error();
  $page_content = include_template("error.php", ["error"=>$error]);
} else {
  $lots = get_data($con,$sql_lots);
  $categories = get_data($con,$sql_cat);
}


