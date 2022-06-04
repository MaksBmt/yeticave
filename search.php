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
 
  
  if(isset($_GET['search'])){
    $search = htmlspecialchars($_GET["search"]);
       
        $sql_search = get_query_search($search);
        $lots = get_data($con, $sql_search);

        $product_quantity = count($lots);
        if($product_quantity > 0) {
          $limit = 1;
          $page = intval($_GET['page']) ?: 1;
          $offset = ($page - 1) * $limit;
          $pages_total = ceil($product_quantity/$limit);
          $pages = range(1, $pages_total);
        
          $is_count_lots = true;
          $product_on_page = array_slice($lots,$offset,$limit,true);
     
        } else {
          $is_count_lots = false;
        }
    
        $page_content = include_template("search.php", [
          "categories" => $categories,
          "lots" => $product_on_page,
          "search" => $search,
          "pages" => $pages,
          "page" => $page,
          "count_lots" => $is_count_lots
        ]);
  } else {
    http_response_code(404);
    die();
  }

  $layout_content = include_template("layout.php",[
    "content" => $page_content,
    "categories" => $categories,
    "title" => "Результаты поиска",
    "is_auth" => $is_auth,
    "user_name" => $user_name,
    "search" => $search
]);
  print($layout_content);
}