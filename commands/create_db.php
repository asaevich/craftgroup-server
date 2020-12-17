<?php

require dirname(__DIR__) . '/config/database.php';

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD);
if ($mysqli->connect_errno) {
    echo 'Не удалось подключиться к MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
    exit();
}
if ($mysqli->select_db(DB_NAME)) {
    echo 'База данных ' . DB_NAME . ' уже существует';
} else {
    if ($mysqli->query('CREATE DATABASE IF NOT EXISTS ' . DB_NAME . ';')) {
        echo 'База данных ' . DB_NAME . ' успешно создана';
    } else {
        echo 'Ошибка при создании базы данных: (' . $mysqli->errno . ') ' . $mysqli->error;
    }
}

$mysqli->close();
