<?php
require_once '../OptionA/data.php'; 

$id_reservation         = $_POST['id_reservation'];                
$nom_client             = $_POST['nom_client'];               
$date_rdv               = $_POST['date_rdv'];  
$heure_rdv              = $_POST['heure_rdv']; 

$stmt = $pdo->prepare(" 
    UPDATE reservation  
    SET nom_client = ?, date_rdv = ?, heure_rdv = ?
    WHERE id_reservation = ? 
");

$stmt->execute([$nom_client, $date_rdv, $heure_rdv, $id_reservation]);

header("Location: dashboard.php?success=1");
exit;
?>