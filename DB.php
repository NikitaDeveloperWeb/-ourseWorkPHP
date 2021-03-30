<?php
// header('Content-Type: text/html; charset=utf-8');
$dblogin = "mysql"; // ЛОГИН К БАЗЕ ДАННЫХ
$dbpass = "mysql"; //  ПАРОЛЬ К БАЗЕ ДАННЫХ
$db = "taxi"; // НАЗВАНИЕ БАЗЫ ДЛЯ САЙТА
$dbhost="localhost";

$mysqli = new mysqli($dbhost, $dblogin, $dbpass, $db);
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->query("SET NAMES 'utf8' ");


?>
