<?php

$dsn = 'mysql:dbname=jptest;host=localhost';
$user = 'mamp';
$password = 'tadashi';

try {
    $db = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>