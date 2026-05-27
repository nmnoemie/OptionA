<?php
require_once 'data.php'; // Votre fichier de connexion qui contient la variable $pdo

// --- LOGIQUE POUR LE BOUTON NEW ---
if (isset($_GET['action']) && $_GET['action'] === 'create') {
    try {
        // On prépare des données par défaut ou temporaires
        $nom_defaut = "Nouvelle réservation (En attente)";
        $date_defaut = date('Y-m-d'); // Date du jour
        $heure_defaut = "19:00";
        $tel_defaut = "0600000000";

        $sql_insert = "INSERT INTO reservation (nom_client, date_rdv, heure_rdv, tel) 
                       VALUES (:nom, :date_rdv, :heure_rdv, :tel)";
        
        $stmt_insert = $pdo->prepare($sql_insert);
        $stmt_insert->execute([
            ':nom'       => $nom_defaut,
            ':date_rdv'  => $date_defaut,
            ':heure_rdv' => $heure_defaut,
            ':tel'       => $tel_defaut
        ]);

        // Une fois inséré, on recharge la page proprement pour afficher la nouvelle ligne
        header("Location: dashboard.php");
        exit;

    } catch (PDOException $e) {
        die("Erreur lors de la création automatique : " . $e->getMessage());
    }
}

// --- LE RESTE DE VOTRE CODE DE RECHERCHE EXISTANT ---
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
if (!empty($search)) {
    // ... votre code de filtrage existant ...
} else {
    // ... votre code d'affichage global existant ...
}
?>

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
    <link rel="stylesheet" href="CSS/style.css" >
    
    <style>
        .form-actions-container {
            display: flex;
            justify-content: space-between; /* Pousse les éléments aux deux opposés */
            align-items: center; /* Aligne verticalement les deux boutons */
            width: 100%;
        }

        .btn--success-github {
            background-color: #2da44e; /* Le vert officiel de GitHub */
            color: #ffffff;
            border: 1px solid rgba(27, 31, 36, 0.15);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn--success-github:hover {
            background-color: #2c974b; /* Vert un peu plus foncé au survol */
        }
    </style>
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
                
                <div class="form-actions-container">
                    <button type="submit" class="btn btn--primary btn--lg">Rechercher</button>
                    
                    <a href="services.php" class="btn btn--success-github btn--lg">New</a>
                </div>
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