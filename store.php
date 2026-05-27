<?php
require_once 'data.php';

// Récupération des données du formulaire
$nom_client   = $_POST['nom_client'];
$email        = $_POST['email'];
$tel          = str_replace(' ', '', $_POST['tel']);  // Enlève les espaces
$date_rdv     = $_POST['date_rdv'];
$heure_rdv    = $_POST['heure_rdv'];
$id_services  = $_POST['Id_services'];

// Statut par défaut pour une nouvelle réservation
$statut_defaut = 'en_attente';

// Vérification que tous les champs sont remplis (CORRIGÉ)
if(empty($nom_client) || empty($email) || empty($tel) || empty($date_rdv) || empty($heure_rdv) || empty($id_services)) {
    header("Location: create.php?error=1");
    exit;
}

// Vérification que le téléphone est valide (10 chiffres)
if(!preg_match('/^[0-9]{10}$/', $tel)) {
    header("Location: create.php?error=1");
    exit;
}

// Préparation de la requête d'insertion
$stmt = $pdo->prepare("
    INSERT INTO reservation (nom_client, email, tel, date_rdv, heure_rdv, Id_services, statut)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");

// Exécution de la requête
$success = $stmt->execute([
    $nom_client,
    $email,
    $tel,
    $date_rdv,
    $heure_rdv,
    $id_services,
    $statut_defaut
]);

// Redirection en fonction du résultat
if($success) {
    header("Location: dashboard.php?created=1");
} else {
    header("Location: create.php?error=1");
}
exit;
?>