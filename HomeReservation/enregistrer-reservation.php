<?php
// On indique au navigateur qu'on va lui répondre au format JSON
header('Content-Type: application/json');

$host = 'localhost';
$dbname = 'chichats'; // Remplacez par le nom de votre base de données
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur BDD : ' . $e->getMessage()]);
    exit;
}

// 2. Récupération des données JSON envoyées par Fetch
$json = file_get_contents('php://input');
$data = json_decode($json, true);


if (!empty($data['nom_client']) && !empty($data['email_client'])) {
    
    try {
        $sql = "INSERT INTO reservations (id_service, id_disponibilite, date_rdv, heure_rdv, nom_client, email, telephone, statut) 
                VALUES (:id_service, :id_dispo, :date_rdv, :heure_rdv, :nom_client, :email, :tel, 'Confirmée')";
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            ':id_service' => $data['id_service'] ?? null,
            ':id_dispo'   => $data['id_dispo'] ?? null,
            ':date_rdv'   => $data['date_rdv'] ?? null,
            ':heure_rdv'  => $data['heure_rdv'] ?? null,
            ':nom_client' => $data['nom_client'],
            ':email'      => $data['email_client'],
            ':tel'        => $data['tel_client'] ?? null
        ]);

        echo json_encode(['success' => true]);

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur SQL : ' . $e->getMessage()]);
    }

} else {
    // On affiche un message plus précis pour savoir ce qui manque
    echo json_encode([
        'success' => false, 
        'message' => 'Données reçues incomplètes. Nom reçu : ' . ($data['nom_client'] ?? 'VIDE') . ' | Email reçu : ' . ($data['email_client'] ?? 'VIDE')
    ]);
}
?>