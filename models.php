<?php
/**
 * Формирует SQL-запрос для получения списка новых лотов от определенной даты, с сортировкой
 * @param string $date Дата в виде строки, в формате 'YYYY-MM-DD'
 * @return string SQL-запрос
 */
function get_query_list_lots($date)
{ 
    return "SELECT l.title, l.start_price, l.img, l.date_finish, l.date_creation, l.id, cat.name_category FROM lots l
    JOIN categories cat ON l.category_id = cat.id
    WHERE l.date_creation > '$date' ORDER BY l.date_creation DESC";
}

/**
 * Формирует SQL-запрос для получения лота по его id
 * @param int $id Целое число
 * @return string SQL-запрос
 */
 function get_query_lot($id)
 {
    return "SELECT l.title, l.start_price, l.img, l.date_finish, l.date_creation, l.id, cat.name_category FROM lots l
    JOIN categories cat ON l.category_id = cat.id
    WHERE l.id = '$id'";
 }

 /**
  * Формирует SQL-запрос для получения массива лотов по фразе из формы поиска
  * @param string $serch Строка запроса
  * @param string SQL-запрос
  */
  function get_query_search($search)
  {
      return "SELECT l.title, l.lot_description, l.start_price, l.img, l.date_finish, l.date_creation, l.id, cat.name_category FROM lots l
      JOIN categories cat ON l.category_id = cat.id
      WHERE MATCH(l.title, l.lot_description) AGAINST('$search')";
  }

 /**
 * Формирует SQL-запрос для получения данных юзера по его email
 * @param string $email электронный адрес 
 * @return string SQL-запрос
 */
function get_query_email($email)
{
    return "SELECT id, email, user_name, user_password FROM users WHERE email = '$email'";
}

 $sql_cat = "SELECT * FROM categories";
 $sql_users = "SELECT email, user_name FROM users";

 /**
 * Формирует SQL-запрос для создания нового лота
 * @param integer $user_id id пользователя
 * @return string SQL-запрос
 */
function get_query_create_lot ($user_id)
 {
    return "INSERT INTO lots (title, category_id, lot_description, start_price, step, date_finish, img, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, '$user_id');";
}

/**
 * Возвращает массив данных пользователей: адресс электронной почты и имя
 * @param $con Подключение к MySQL
 * @return [Array | String] $users_data Двумерный массив с именами и емейлами пользователей
 * или описание последней ошибки подключения
 */
function get_users_data($con) {
    if (!$con) {
    $error = mysqli_connect_error();
    return $error;
    } else {
        $sql = "SELECT email, user_name FROM users";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $users_data= get_arrow($result);
            return $users_data;
        }
        $error = mysqli_error($con);
        return $error;
    }
}

/**
 * Формирует SQL-запрос для регистрации нового пользователя
 * @param integer $user_id id пользователя
 * @return string SQL-запрос
 */
function get_query_create_user() {
    return "INSERT INTO users (date_registration, email, user_password, user_name, contacts) VALUES (NOW(), ?, ?, ?, ?);";
}
