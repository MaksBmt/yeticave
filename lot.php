<?php
require_once("helpers.php");
require_once("functions.php");
require_once("init.php");
require_once("functions.php");
require_once("models.php");

if (!$con) {
  $error = mysqli_connect_error();
  $page_content = include_template("error.php", ["error"=>$error]); 
} else {
  $categories = get_data($con, $sql_cat);
 
  if(isset($_GET['lot'])){
        $lot_id = intval($_GET['lot']);
   
        $sql_lot = get_query_lot($lot_id);
        $lot = get_data($con, $sql_lot);
     
        $page_content = include_template("main-lot.php", [
          "categories" => $categories,
          "lot" => $lot
        ]);
  } else {
    http_response_code(404);
    die();
  }

  $layout_content = include_template("layout.php",[
    "content" => $page_content,
    "categories" => $categories,
    "title" => "Лот № '$lot_id'",
    "is_auth" => $is_auth,
    "user_name" => $user_name
]);
  print($layout_content);
}
?>