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

 $sql_cat = "SELECT * FROM categories";

 /**
 * Формирует SQL-запрос для создания нового лота
 * @param integer $user_id id пользователя
 * @return string SQL-запрос
 */
function get_query_create_lot ($user_id)
 {
    return "INSERT INTO lots (title, category_id, lot_description, start_price, step, date_finish, img, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, '$user_id');";
}
