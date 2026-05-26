<?php
require_once '../OptionA/data.php'; 

$id                = $_POST['id_reservation'];                
$nom               = $_POST['nom_client'];               
$date_reservation  = $_POST['date_rdv'];  
$heure_reservation = $_POST['heure_rdv']; 

$stmt = $pdo->prepare(" 
    UPDATE reservation  
    SET nom_client = ?, date_rdv = ?, heure_rdv = ?
    WHERE id_reservation = ? 
");

$stmt->execute([$nom, $date_reservation, $heure_reservation, $id]);

header("Location: index.php");
exit;
?>