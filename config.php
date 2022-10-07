<?php
$db_name = 'test';
$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = '123456';

$pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_pass);