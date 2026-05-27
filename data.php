<?php

$host= 'localhost';
$dbname='chichats';
$username='root';
$password='';
$charset= 'utf8mb4';

$dsn= "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    // Active le lancer d'exceptions en cas d'erreur SQL (indispensable pour le debogage)
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    // Définit le mode de récupération par défaut : ici, on récupère sous forme de tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // Désactive l'émulation des requêtes préparées pour utiliser les vraies requêtes préparées de MySQL
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : ". $e->getMessage());
}

?>