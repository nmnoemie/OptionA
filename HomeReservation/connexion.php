<?php
$host = 'localhost';
$dbname = 'chichats'; // Votre base de données
$username = 'root';
$password = ''; // Vide pour XAMPP Windows

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si on appelle ce fichier via Fetch, on renvoie du JSON, sinon un message simple
    if (basename($_SERVER['PHP_SELF']) === 'enregistrer-reservation.php') {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Erreur connexion BDD : ' . $e->getMessage()]);
        exit;
    }
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>