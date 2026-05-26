<?php
require_once 'data.php';

// On récupère le terme de recherche s'il existe
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if (!empty($search)) {
    // On filtre par nom de client ou par date si une recherche est lancée
    $sql = "SELECT * FROM reservation WHERE nom_client LIKE :nom OR date_rdv LIKE :date";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nom'  => '%' . $search . '%',
        'date' => '%' . $search . '%'
    ]);
    $reservations = $stmt->fetchAll();
} else {
    // Sinon, on affiche tout par défaut
    $sql = "SELECT * FROM reservation";
    $result = $pdo->query($sql);
    $reservations = $result->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chichats - Réservation de table</title>
    <link rel="stylesheet" href="/CSS/style.css">
    
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
            <h1>Liste des reservations</h1> <br>
            <form method="GET" action="dashboard.php">
                <input type="text" name="search" placeholder="Rechercher un nom ou une date (AAAA-MM-JJ)..." value="<?= htmlspecialchars($search) ?>"> <br><br>
                <button type="submit" class="btn btn--primary btn--lg">Rechercher</button>
            </form>
            
            <hr>

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
                
                <a href="services.php" class="btn btn--primary btn--lg"> reserver</a>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy;Chichats Since 1908. Tous droits réservés. | 123 Rue des Félins,Chauteau Rouge, Paris</p>
    </footer>
</body>
</html>