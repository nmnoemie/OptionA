<?php
// On inclut la connexion propre
require_once 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $date_rdv  = htmlspecialchars($_POST['date_rdv'] ?? '');
    $heure_rdv = htmlspecialchars($_POST['heure_rdv'] ?? '');
    $nom_client = htmlspecialchars($_POST['nom_client'] ?? '');
    $email     = htmlspecialchars($_POST['email'] ?? '');
    $tel       = htmlspecialchars($_POST['tel'] ?? '');

    if (!empty($nom_client) && !empty($email)) {
        try {
            // Changement de :nom en :nom_client pour être raccord avec le execute
            $sql = "INSERT INTO reservations (nom_client, email, date_rdv, heure_rdv, telephone, statut) 
                    VALUES (:nom_client, :email, :date_rdv, :heure_rdv, :tel, 'Confirmée')";
            
            $stmt = $pdo->prepare($sql);

            // Correction des clés (suppression des deux-points inutiles parfois manquants dans votre version)
            $stmt->execute([
                ':nom_client' => $nom_client,
                ':email'      => $email,
                ':date_rdv'   => $date_rdv,
                ':heure_rdv'  => $heure_rdv,
                ':tel'        => $tel
            ]);

            echo "Données enregistrées avec succès !";
            
        } catch (PDOException $e) {
            echo "Erreur lors de l'enregistrement : " . $e->getMessage();
        }
    } else {
        echo "Veuillez remplir les champs obligatoires (Nom et Email).";
    }
}
?>