<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Réservation Étape 4 | Chichats</title>
</head>
<body>

  <nav>
    <a href="index.php">Accueil</a> |
    <a href="localisation.php">Localisation</a> |
    <a href="services.php">Réservation</a>
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

    <label>
      <input type="checkbox" id="conditions" />
      J'accepte les <a href="#">conditions générales</a> de Chichats.
    </label>

    <br /><br />
    <button type="button" onclick="window.location.href='informations.php'">&larr; Retour</button>
    &nbsp;&nbsp;
    <button type="button" onclick="confirmer()">Confirmer ma réservation ✓</button>

  </div>

  
  <div id="section-succes" style="display:none;">
    <h2> Réservation confirmée !</h2>
    <p>Merci <strong><span id="succes-nom"></span></strong>, votre réservation a bien été enregistrée.</p>
    <table border="1" cellpadding="8" cellspacing="0">
      <tr><th>Service</th>   <td id="succes-service">–</td></tr>
      <tr><th>Date</th>      <td id="succes-date">–</td></tr>
      <tr><th>Heure</th>     <td id="succes-heure">–</td></tr>
      <tr><th>Statut</th>    <td> Confirmée</td></tr>
    </table>
    <br />
    <p>Un email de confirmation vous sera envoyé à <strong><span id="succes-email"></span></strong>.</p>
    <br />
    <button onclick="window.location.href='services.php'">Faire une nouvelle réservation</button>
    &nbsp;&nbsp;
    <button onclick="window.location.href='index.php'">Retour à l'accueil</button>
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

    function confirmer() {
      if (!document.getElementById('conditions').checked) {
        alert('Veuillez accepter les conditions générales.');
        return;
      }

      
      document.getElementById('succes-nom').textContent     = nom;
      document.getElementById('succes-service').textContent = nomService;
      document.getElementById('succes-date').textContent    = date;
      document.getElementById('succes-heure').textContent   = heure;
      document.getElementById('succes-email').textContent   = email;

      
      document.getElementById('section-recap').style.display  = 'none';
      document.getElementById('section-succes').style.display = 'block';

      sessionStorage.clear();
    }
  </script>

  <hr />
  <footer><p>&copy; 2026 Chichats – Tous droits réservés</p></footer>

</body>
</html>