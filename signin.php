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

  $page_content = include_template("signin.php", [
    "categories" => $categories   
  ]);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $required = ["email", "password"];
    $errors = [];

    $rules = [
        "email" => function($value) {
            return validate_email($value);
        },
        "password" => function($value) {
            return validate_length ($value, 6, 12);
        }
    ];

    $user_info = filter_input_array(INPUT_POST,
    [
        "email"=>FILTER_DEFAULT,
        "password"=>FILTER_DEFAULT
    ], true);

    foreach ($user_info as $field => $value) {
        if (isset($rules[$field])) {
            $rule = $rules[$field];
            $errors[$field] = $rule($value);
        }
        if (in_array($field, $required) && empty($value)) {
            $errors[$field] = "Поле $field нужно заполнить";
        }
    }

    $errors = array_filter($errors);


    if (count($errors)) {
        $page_content = include_template("signin.php", [
            "categories" => $categories,
            "user_info" => $user_info,
            "errors" => $errors
        ]);
    } else {
      $users_data = get_data($con, get_query_email($user_info["email"]));
   
        if ($users_data){
         
            if (password_verify($user_info["password"], $users_data[0]["user_password"])) {
                    $_SESSION['name'] = $users_data[0]["user_name"];
                    $_SESSION['id'] = $users_data[0]["id"];
                 
                    header("Location: /index.php");
            } else {
                $errors["password"] = "Вы ввели неверный пароль";
            }
        } else {
            $errors["email"] = "Пользователь с таким е-mail не зарегестрирован";
        }
    if (count($errors)) {
        $page_content = include_template("signin.php", [
            "categories" => $categories,
            "user_info" => $user_info,
            "errors" => $errors
        ]);
        }
    }
  }
 
  $layout_content = include_template("layout.php",[
    "content" => $page_content,
    "categories" => $categories,
    "is_auth" => $is_auth,
     "user_name" => $user_name,
     "title" => "Вход"
  ]);

   print($layout_content);
}