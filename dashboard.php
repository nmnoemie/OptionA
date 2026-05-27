<?php
require_once 'data.php';

// Suppression si demandée
if (isset($_GET['supprimer'])) {
    $id = $_GET['supprimer'];
    $stmt = $pdo->prepare("DELETE FROM reservation WHERE Id_reservation = ?");
    $stmt->execute([$id]);
    header('Location: dashboard.php');
    exit();
}

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
            <h1>Liste des reservations</h1> <br>
            <form method="GET" action="dashboard.php">
                <input type="text" name="search" placeholder="Rechercher un nom ou une date (AAAA-MM-JJ)..." value="<?= htmlspecialchars($search) ?>"> <br><br>
                <button type="submit" class="btn btn--primary btn--lg">Rechercher</button>
            </form>
            
            <hr>
            <?php if (isset($_GET['success'])) : ?>
                <p style="color: rgb(255, 77, 166);">✅ Modification effectuée avec succès !</p>
            <?php endif; ?>
            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>id_reservation</th>
                        <th>Nom</th>
                        <th>Dates de reservation</th>
                        <th>Heure de reservation</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
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
                                </button>
                            </td>
                            <td>
                                <button onclick="confirmerSuppression(<?= $reservation['Id_reservation'] ?>)" title="Supprimer" style="background:none; border:none; cursor:pointer;">
                                    <i class="fa-solid fa-xmark" style="color: rgb(255, 77, 166);"></i>
                                </button>
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
                
                <a href="services.php" class="btn btn--primary btn--lg"> reserver</a>
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
                <select name="heure_rdv" id="input-heure">
                    <option value="" selected disabled >Sélectionnez une heure</option>
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

            <button type="submit">💾 Enregistrer</button> 
            <button type="button" onclick="fermerModale()">✖ Annuler</button>

        </form>
    </div>

<script>
function confirmerSuppression(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')) {
        window.location.href = 'dashboard.php?supprimer=' + id;
    }
}
</script>
<script src="js/update.js"></script>
</body>
</html>