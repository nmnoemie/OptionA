<?php
// 1. On inclut le fichier de connexion créé à l'étape 3
require_once 'connexion.php';

// 2. On vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // On récupère et sécurise minimalement les données du collaborateur / formulaire
    $date_rdv = htmlspecialchars($_POST['date_rdv']);
    $heure_rdv = htmlspecialchars($_POST['heure_rdv']);
    $nom_client = htmlspecialchars($_POST['nom_client']);
    $email=htmlspecialchars($_POST['email']);
    $tel=htmlspecialchars($_POST['tel']);


    try {
        // 3. On prépare la requête SQL d'insertion
        $sql = "INSERT INTO reservation (nom_client, email, date_rdv, heure_rdv, tel) VALUES (:nom, :email, :date_rdv, :heure_rdv, :tel)";
        $stmt = $pdo->prepare($sql);

        // 4. On associe les valeurs et on exécute la requête
        $stmt->execute([
            ':nom_client' => $nom,
            ':email' => $email,
            'date_rdv'=> $date_rdv,
            'heure_rdv'=> $heure_rdv,
            'tel'=> $tel
            
        ]);

        echo "Données enregistrées avec succès !";
        
    } catch (PDOException $e) {
        echo "Erreur lors de l'enregistrement : " . $e->getMessage();
    }
}
?>