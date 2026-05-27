<?php

$host     = "localhost";
$user     = "root";
$password = "";
$database = "chichats";

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}


$enregistre = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Id_services = $_POST['Id_services'];
    $date_rdv    = $_POST['date_rdv'];
    $heure_rdv   = $_POST['heure_rdv'];
    $nom_client  = $_POST['nom_client'];
    $email       = $_POST['email'];
    $tel         = $_POST['tel'];
    $statut      = "en_attente";

    $sql = "INSERT INTO reservation (date_rdv, heure_rdv, nom_client, email, tel, statut, Id_disponibilite, Id_services)
            VALUES (?, ?, ?, ?, ?, ?, 1, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssi", $date_rdv, $heure_rdv, $nom_client, $email, $tel, $statut, $Id_services);
    mysqli_stmt_execute($stmt);
    $enregistre = true;
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Réservation Étape 4 | Chichats</title>
</head>
<body>

  <nav>
    <a href="index.html">Accueil</a> |
    <a href="localisation.html">Localisation</a> |
    <a href="services.html">Réservation</a>
  </nav>

  <hr />
  <h1>Chichats – Réservation en ligne</h1>

  <p>
    Étape 1 : Service &rarr;
    Étape 2 : Créneau &rarr;
    Étape 3 : Vos informations &rarr;
    <strong>[ Étape 4 : Confirmation ]</strong>
  </p>

  <hr />

  <div id="section-recap">

    <h2>Étape 4 – Récapitulatif de votre réservation</h2>
    <p>Vérifiez vos informations avant d'envoyer.</p>

    <table border="1" cellpadding="8" cellspacing="0">
      <tr><th>Service</th>   <td id="recap-service">–</td></tr>
      <tr><th>Date</th>      <td id="recap-date">–</td></tr>
      <tr><th>Heure</th>     <td id="recap-heure">–</td></tr>
      <tr><th>Nom</th>       <td id="recap-nom">–</td></tr>
      <tr><th>Email</th>     <td id="recap-email">–</td></tr>
      <tr><th>Téléphone</th> <td id="recap-tel">–</td></tr>
      <tr><th>Statut</th>    <td>En attente de confirmation</td></tr>
    </table>

    <br />

    <form id="form-reservation" action="comfirmation.php" method="POST">
      <input type="hidden" name="Id_services" id="final_service" />
      <input type="hidden" name="date_rdv"    id="final_date" />
      <input type="hidden" name="heure_rdv"   id="final_heure" />
      <input type="hidden" name="nom_client"  id="final_nom" />
      <input type="hidden" name="email"       id="final_email" />
      <input type="hidden" name="tel"         id="final_tel" />

      <label>
        <input type="checkbox" id="conditions" />
        J'accepte les <a href="#">conditions générales</a> de Chichats.
      </label>

      <br /><br />
      <button type="button" onclick="window.location.href='informations.html'">&larr; Retour</button>
      &nbsp;&nbsp;
      <button type="button" onclick="confirmer()">Confirmer ma réservation ✓</button>
    </form>

  </div>

  
  <div id="section-succes" style="display:<?php echo $enregistre ? 'block' : 'none'; ?>;">
    <h2> Réservation confirmée !</h2>
    <p>Merci, votre réservation a bien été enregistrée.</p>
    <table border="1" cellpadding="8" cellspacing="0">
      <tr><th>Statut</th><td> Confirmée</td></tr>
    </table>
    <br />
    <p>Un email de confirmation vous sera envoyé.</p>
    <br />
    <button onclick="window.location.href='services.html'">Faire une nouvelle réservation</button>
    &nbsp;&nbsp;
    <button onclick="window.location.href='index.html'">Retour à l'accueil</button>
  </div>

  <script>
    var idService  = sessionStorage.getItem('Id_services')  || '';
    var nomService = sessionStorage.getItem('nom_services') || '';
    var date       = sessionStorage.getItem('date_rdv')     || '';
    var heure      = sessionStorage.getItem('heure_rdv')    || '';
    var nom        = sessionStorage.getItem('nom_client')   || '';
    var email      = sessionStorage.getItem('email')        || '';
    var tel        = sessionStorage.getItem('tel')          || '';

    document.getElementById('recap-service').textContent = nomService;
    document.getElementById('recap-date').textContent    = date;
    document.getElementById('recap-heure').textContent   = heure;
    document.getElementById('recap-nom').textContent     = nom;
    document.getElementById('recap-email').textContent   = email;
    document.getElementById('recap-tel').textContent     = tel;

    
    document.getElementById('final_service').value = idService;
    document.getElementById('final_date').value    = date;
    document.getElementById('final_heure').value   = heure;
    document.getElementById('final_nom').value     = nom;
    document.getElementById('final_email').value   = email;
    document.getElementById('final_tel').value     = tel;

    function confirmer() {
      if (!document.getElementById('conditions').checked) {
        alert('Veuillez accepter les conditions générales.');
        return;
      }
      sessionStorage.clear();
      document.getElementById('form-reservation').submit();
    }
  </script>

  <hr />
  <footer><p>&copy; 2026 Chichats – Tous droits réservés</p></footer>

</body>
</html>