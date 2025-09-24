<?php
$host = 'auth-db1423.hstgr.io';
$dbname = 'u995161080_simpleDB';
$username = 'u995161080_simpleUserDB';
$password = 'xV5@kR&P0Nug';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("oups : " . $e->getMessage());
}
