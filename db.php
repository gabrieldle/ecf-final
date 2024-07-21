<?php
$host = 'localhost';
$db = 'ZooArcadia';
$user = 'root'; // Remplacer par votre nom d'utilisateur MySQL
$pass = ''; // Remplacer par votre mot de passe MySQL

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit;
}
?>
