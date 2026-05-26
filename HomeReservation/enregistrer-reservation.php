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

// Vérification que les données indispensables sont présentes
if (!empty($data['nom_client']) && !empty($data['email_client']) && !empty($data['date_rdv'])) {
    
    try {
        // 3. Préparation de la requête SQL (Adaptez les noms des colonnes et de la table)
        $sql = "INSERT INTO reservations (id_service, id_disponibilite, date_rdv, heure_rdv, nom_client, email, telephone, statut) 
                VALUES (:id_service, :id_dispo, :date_rdv, :heure_rdv, :nom_client, :email, :tel, 'Confirmée')";
        
        $stmt = $pdo->prepare($sql);
        
        // 4. Exécution de la requête avec les données reçues
        $stmt->execute([
            ':id_service' => $data['id_service'],
            ':id_dispo'   => $data['id_dispo'],
            ':date_rdv'   => $data['date_rdv'],
            ':heure_rdv'  => $data['heure_rdv'],
            ':nom_client' => $data['nom_client'],
            ':email'      => $data['email_client'],
            ':tel'        => $data['tel_client']
        ]);

        // On renvoie un signal de succès au JavaScript
        echo json_encode(['success' => true]);

    } catch (PDOException $e) {
        // En cas d'erreur d'écriture SQL
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }

} else {
    // Si les données reçues sont incomplètes
    echo json_encode(['success' => false, 'message' => 'Données du formulaire incomplètes.']);
}
?>