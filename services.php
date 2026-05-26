<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Réservation Étape 1 | Chichats</title>
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
    <strong>[ Étape 1 : Services ]</strong> &rarr;
    Étape 2 : Créneau &rarr;
    Étape 3 : Vos informations &rarr;
    Étape 4 : Confirmation
  </p>

  <hr />

  <h2>Étape 1 – Choisissez votre service</h2>
  <p>Sélectionnez le service que vous souhaitez réserver.</p>

  <label for="services">Service souhaité :</label><br />
  <select id="services">
    <option value="">-- Sélectionnez un service --</option>
    <option value="1">Chicha Simple – 30 min – 15 €</option>
    <option value="2">Chicha Premium – 60 min – 25 €</option>
    <option value="3">Chicha VIP – 90 min – 40 €</option>
    <option value="4">Privatisation de salon – 120 min – 80 €</option>
  </select>

  <br /><br />
  <button onclick="suivant()">Suivant →</button>

  <script>
    var sel = document.getElementById('services');
    sel.value = sessionStorage.getItem('Id_services') || '';

    function suivant() {
      var sel = document.getElementById('services');
      if (sel.value === '') {
        alert('Veuillez sélectionner un service.');
        return;
      }
      sessionStorage.setItem('Id_services', sel.value);
      sessionStorage.setItem('nom_services', sel.options[sel.selectedIndex].text);
      window.location.href = 'creneau.php';
    }
  </script>

  <hr />
  <footer><p>&copy; 2026 Chichats – Tous droits réservés</p></footer>

</body>
</html>