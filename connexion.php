<?php
$host = 'localhost';
$dbname = 'chatapp';
$user = 'root';
$pw = '';
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
try {
    $con = new PDO($dsn, $user . $pw);
} catch (Exception $e) {
    echo 'Error connexion : ' . $e->getMessage();
}