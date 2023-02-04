<?php

class db {
    public static function getConnection() {
    $host = '';
    $dbname = '';
    $user = '';
    $password = '';
    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    return $db;
    }
}
?>
