<?php
function connectToDatabase() {
    $mysqli = new mysqli('127.0.0.1', 'root', '', 'blog');

    if ($mysqli->connect_error) {
        die('Ошибка подключения к БД: ' . $mysqli->connect_error);
    }

    $mysqli->set_charset('utf8mb4');

    return $mysqli;
}
?>
