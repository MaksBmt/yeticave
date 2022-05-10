<?php
/**
 * Формирует SQL-запрос для получения списка новых лотов от определенной даты, с сортировкой
 * @param string $date Дата в виде строки, в формате 'YYYY-MM-DD'
 * @return string SQL-запрос
 */
function get_query_list_lots($date)
{
    // return "SELECT l.title, l.start_price, l.img, l.date_finish, l.date_creation, cat.name_category FROM lots l
    // JOIN categories cat ON l.category_id = cat.id
    // WHERE l.date_creation > $date ORDER BY l.date_creation DESC";

return "SELECT * FROM lots
WHERE date_creation > $date ORDER BY date_creation DESC";
}
