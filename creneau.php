<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Réservation Étape 2 | Chichats</title>
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
    <strong>[ Étape 2 : Créneau ]</strong> &rarr;
    Étape 3 : Vos informations &rarr;
    Étape 4 : Confirmation
  </p>

  <hr />

  <h2>Étape 2 – Choisissez un créneau</h2>
  <p>Sélectionnez la date et l'heure de votre séance.</p>

  <label for="date_rdv">Date du rendez-vous :</label><br />
  <input type="date" id="date_rdv" /><br /><br />

  <label for="heure_rdv">Heure du rendez-vous :</label><br />
  <select id="heure_rdv">
    <option value="">-- Sélectionnez une heure --</option>
    <option value="10:00">10:00</option>
    <option value="10:30">10:30</option>
    <option value="11:00">11:00</option>
    <option value="11:30">11:30</option>
    <option value="12:00">12:00</option>
    <option value="12:30">12:30</option>
    <option value="14:00">14:00</option>
    <option value="14:30">14:30</option>
    <option value="15:00">15:00</option>
    <option value="15:30">15:30</option>
    <option value="16:00">16:00</option>
    <option value="16:30">16:30</option>
    <option value="17:00">17:00</option>
    <option value="17:30">17:30</option>
    <option value="18:00">18:00</option>
    <option value="18:30">18:30</option>
    <option value="19:00">19:00</option>
    <option value="19:30">19:30</option>
    <option value="20:00">20:00</option>
    <option value="20:30">20:30</option>
    <option value="21:00">21:00</option>
    <option value="21:30">21:30</option>
    <option value="22:00">22:00</option>
  </select>

  <br /><br />
  <em>Note : Les créneaux déjà réservés sont bloqués côté serveur.</em>

  <br /><br />
  <button onclick="window.location.href='services.php'">&larr; Retour</button>
  &nbsp;&nbsp;
  <button onclick="suivant()">Suivant →</button>

  <script>
    document.getElementById('date_rdv').value  = sessionStorage.getItem('date_rdv')  || '';
    document.getElementById('heure_rdv').value = sessionStorage.getItem('heure_rdv') || '';

    function suivant() {
      var date  = document.getElementById('date_rdv').value;
      var heure = document.getElementById('heure_rdv').value;
      if (date === '')  { alert('Veuillez choisir une date.');  return; }
      if (heure === '') { alert('Veuillez choisir une heure.'); return; }
      sessionStorage.setItem('date_rdv',  date);
      sessionStorage.setItem('heure_rdv', heure);
      window.location.href = 'informations.php';
    }
  </script>

  <hr />
  <footer><p>&copy; 2026 Chichats – Tous droits réservés</p></footer>

</body>
</html>