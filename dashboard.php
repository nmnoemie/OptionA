<?php
require_once '../OptionA/data.php';
//première requete
$sql= "SELECT * FROM reservation";
$result = $pdo->query($sql);
$reservations = $result->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chichats - Réservation de table</title>
    <link rel="stylesheet" href="style.css">
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
            <h1>Liste des reservations</h1>
            <hr>

            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>id_reservation</th>
                        <th>Nom</th>
                        <th>Dates de reservation</th>
                        <th>Heure de reservation</th>
                        <th>Modifier</th>
                
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $reservation) : ?>
                        <tr>
                            <td><p><?= htmlspecialchars($reservation['Id_reservation']) ?></p></td>
                            <td><p><?= htmlspecialchars($reservation['nom_client']) ?></p></td>
                            <td><p><?= htmlspecialchars($reservation['date_rdv']) ?></p></td>
                            <td><p><?= htmlspecialchars($reservation['heure_rdv']) ?></p></td>
                           <td>
                                <button onclick="ouvrirModale(
                                    <?= $reservation['Id_reservation'] ?>,
                                    '<?= htmlspecialchars($reservation['nom_client']) ?>',
                                    '<?= $reservation['date_rdv'] ?>',
                                    '<?= $reservation['heure_rdv'] ?>'
                                )" title="Modifier" style="background:none; border:none; cursor:pointer;">
                                    <i class="fa-solid fa-pen" style="color: rgb(255, 77, 166);"></i>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                
            </table>
            

        </section>
    
        
        <section id="call-to-action" class="cta">
            <div class="cta__glow"></div>
            <div class="cta__content">
                <h2 class="section-title">Qu'est-ce que tu attends ?</h2>
                <p>Réserve tout de suite !</p>
                
                <a href="/reservation" class="btn btn--primary btn--lg"> reserver</a>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy;Chichats Since 1908. Tous droits réservés. | 123 Rue des Félins,Chauteau Rouge, Paris</p>
    </footer>
    <div id="overlay" class="overlay"></div>

    <div id="modale" class="modale">

        <h2>Modifier la réservation</h2>

        <form method="POST" action="update.php">

            <input type="hidden" name="id_reservation" id="input-id">

            <label>Nom :<br>
                <input type="text" name="nom_client" id="input-nom">
            </label><br><br>

            <label>Date :<br>
                <input type="date" name="date_rdv" id="input-date">
            </label><br><br>

            <label>Heure :<br>
                <input type="time" name="heure_rdv" id="input-heure">
            </label><br><br>

            <button type="submit">💾 Enregistrer</button> 
            <button type="button" onclick="fermerModale()">✖ Annuler</button>

        </form>
    </div>
<script src="js/update.js"></script>
</body>
</html>