<?php
require_once 'data.php';

// On récupère les services pour le select
$services = $pdo->query("SELECT * FROM services")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chichats - Nouvelle réservation</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <header class="hero">
        <div class="hero__content">
            <h1 class="hero__title hero__title--accent">Chichats</h1>
            <p class="hero__subtitle">Le premier bar à chicha où l'on ronronne de plaisir !</p>
        </div>
    </header>

    <main class="container">
        <section id="tableau">
            <h1>Nouvelle réservation</h1>
            <hr>

            <!-- Message d'erreur -->
            <?php if(isset($_GET['error'])): ?>
                <div style="background: #dc3545; color: white; padding: 10px; margin: 10px 0; border-radius: 5px;">
                    ❌ Erreur lors de la création de la réservation. Vérifiez tous les champs.
                </div>
            <?php endif; ?>

            <div class="modale" style="display:block; position:relative; top:auto; left:auto; transform:none; margin: 2rem auto; max-width:500px;">
                <h2>Créer une réservation</h2>

                <form method="POST" action="store.php">

                    <label>Nom du client :<br>
                        <input type="text" name="nom_client" placeholder="Ex : Dupont Jean" required>
                    </label><br><br>

                    <label>Email :<br>
                        <input type="email" name="email" placeholder="Ex : jean@mail.com" required>
                    </label><br><br>

                    <label>Téléphone :<br>
                        <input type="tel" name="tel" placeholder="Ex : 0612345678" required>
                    </label><br><br>

                    <label>Date :<br>
                        <input type="date" name="date_rdv" required>
                    </label><br><br>

                    <label>Heure :<br>
                        <select name="heure_rdv" required>
                            <option value="" disabled selected>Sélectionnez une heure</option>
                            <option value="09:00">09:00</option>
                            <option value="09:30">09:30</option>
                            <option value="10:00">10:00</option>
                            <option value="10:30">10:30</option>
                            <option value="11:00">11:00</option>
                            <option value="11:30">11:30</option>
                            <option value="12:00">12:00</option>
                            <option value="12:30">12:30</option>
                            <option value="13:00">13:00</option>
                            <option value="13:30">13:30</option>
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
                        </select>
                    </label><br><br>

                    <label>Service :<br>
                        <select name="Id_services" required>
                            <option value="" disabled selected>Sélectionnez un service</option>
                            <?php foreach ($services as $service) : ?>
                                <option value="<?= $service['Id_services'] ?>">
                                    <?= htmlspecialchars($service['nom']) ?> - <?= $service['prix_euro'] ?>€
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label><br><br>

                    <div class="modale__actions">
                        <button type="submit"> Enregistrer</button>
                        <a href="dashboard.php">✖ Annuler</a>
                    </div>

                </form>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy;Chichats Since 1908. Tous droits réservés. | 123 Rue des Félins, Chauteau Rouge, Paris</p>
    </footer>
</body>
</html>