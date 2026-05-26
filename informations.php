<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Réservation Étape 3 | Chichats</title>
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
    <strong>[ Étape 3 : Vos informations ]</strong> &rarr;
    Étape 4 : Confirmation
  </p>

  <hr />

  <h2>Étape 3 – Vos informations</h2>
  <p>Renseignez vos coordonnées pour finaliser la réservation.</p>

  <label for="nom_client">Nom :</label><br />
  <input type="text" id="nom_client" placeholder="Votre nom" maxlength="50" /><br /><br />

  <label for="email">Adresse email :</label><br />
  <input type="email" id="email" placeholder="votre@email.com" maxlength="255" /><br /><br />

  <label for="tel">Numéro de téléphone :</label><br />
  <input type="tel" id="tel" placeholder="0612345678" maxlength="10" /><br />
  <small>10 chiffres sans espaces (ex : 0612345678)</small>

  <br /><br />
  <button onclick="window.location.href='dispo.php'">&larr; Retour</button>
  &nbsp;&nbsp;
  <button onclick="suivant()">Suivant →</button>

  <script>
    document.getElementById('nom_client').value = sessionStorage.getItem('nom_client') || '';
    document.getElementById('email').value      = sessionStorage.getItem('email')      || '';
    document.getElementById('tel').value        = sessionStorage.getItem('tel')        || '';

    function suivant() {
      var nom   = document.getElementById('nom_client').value.trim();
      var email = document.getElementById('email').value.trim();
      var tel   = document.getElementById('tel').value.trim();
      if (nom === '')   { alert('Veuillez saisir votre nom.');   return; }
      if (email === '') { alert('Veuillez saisir votre email.'); return; }
      if (!/^[0-9]{10}$/.test(tel)) { alert('Le téléphone doit contenir 10 chiffres.'); return; }
      sessionStorage.setItem('nom_client', nom);
      sessionStorage.setItem('email',      email);
      sessionStorage.setItem('tel',        tel);
      window.location.href = 'comfirmation.php';
    }
  </script>

  <hr />
  <footer><p>&copy; 2026 Chichats – Tous droits réservés</p></footer>

</body>
</html>