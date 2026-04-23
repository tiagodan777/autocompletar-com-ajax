<?php
$type = 'mysql';
$server = 'localhost';
$db = 'autocompletar-com-ajax';
$charset = 'utf8mb4';
$port = '8889';

$username = 'autocompleta';
$password = 'Tiago1234';

$dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), $e->getCode());
}

function pdo($pdo, $sql, $arguments = null) {
    if (!$arguments) {
        return $pdo->query($sql);
    } 
    $statement = $pdo->prepare($sql);
    $statement->execute($arguments);
    return $statement;
}
