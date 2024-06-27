<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$database = "tf2";

$connect = mysqli_connect($hostname, $username, $password, $database);

if (!$connect) {
    die("Не удалось подключиться к MySql: " . mysqli_connect_error());
}