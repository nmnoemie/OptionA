<?php
require_once '../OptionA/data.php';
//première requete
$sql= "SELECT * FROM services";
$result = $pdo->query($sql);
$services = $result->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chichats - Réservation de table</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="hero">
        <div class="hero__content">
            <h1 class="hero__title hero__title--accent">Chichats</h1>
            <p class="hero__subtitle">Le premier bar à chicha où l'on ronronne de plaisir !</p>
        </div>
    </header>
    <main class="container">
        <section id="a-propos" class="content-section">
            <h2>Bienvenue chez Chichats</h2>
            <p>Venez vous détendre en fumant une bonne chicha tout en profitant de la compagnie apaisante de nos adorables chats. Réservez votre table dès maintenant !</p>
        </section>
        
        
        <section id="tableau">
            <h1>Liste de reservation</h1>
            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>id_reservation</th>
                        <th>Nom</th>
                        <th>Dates de reservation</th>
                        <th>Heure de reservation.</th>
                
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $reservation) : ?>
                        <tr>
                            <td><p><?= htmlspecialchars($reservation['Id_reservation']) ?></p></td>
                            <td><p><?= htmlspecialchars($reservation['nom_client']) ?></p></td>
                            <td><p><?= htmlspecialchars($reservation['date_rdv']) ?></p></td>
                            <td><p><?= htmlspecialchars($reservation['heure_rdv']) ?></p></td>
                           
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
</body>
</html>