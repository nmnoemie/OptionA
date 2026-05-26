<?php
require_once '../OptionA/data.php';
//première requete
$sql= "SELECT * FROM services";
$result = $pdo->query($sql);
$services = $result->fetchAll();

$sql2 = "SELECT * FROM reservation";
$result2 = $pdo->query($sql2);
$reservations = $result2->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chichats - Réservation de table</title>
    <link rel="stylesheet" href="../style.css">
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
        <section id="a-propos" class="content-section">
            <h2>Bienvenue chez Chichats</h2>
            <p>Venez vous détendre en fumant une bonne chicha tout en profitant de la compagnie apaisante de nos adorables chats. Réservez votre table dès maintenant !</p>
        </section>
        
        <section id="menu" class="content-section">
            <h2>Notre Menu</h2>
            



            <?php foreach ($services as $service) : ?>
                <div class="product-container">

                <!-- IMAGE DU PRODUIT -->
                <div class="product-images">
                    <!-- Tu pourras remplacer src par l'URL de ton image si tu l'ajoutes en BDD -->
                    <img src="../img/placeholder.jpg" alt="<?= htmlspecialchars($service['nom']) ?>" style="max-width: 100%; border-radius: var(--radius);">
                    <img src="img/placeholder.jpg" alt="<?= htmlspecialchars($service['nom']) ?>" style="max-width: 100%; border-radius: var(--radius);">
                </div>

                <!-- INFORMATIONS DU PRODUIT -->
                <div class="product-details">

                    <div>
                        <h2><?= htmlspecialchars($service['nom']) ?></h2>


                        <div class="price">
                            <?= htmlspecialchars($service['prix_euro']) ?> €
                        </div>

                        <div class="shop-name">
                            Durée : <?= htmlspecialchars($service['durree_minutes']) ?> min
                        </div>

                        <div class="description">
                            <?= htmlspecialchars($service['description']) ?>
                        </div>
                    </div>

                    
                </div>
            </div>
            <?php endforeach; ?>
        </section>
        <h1>Liste de reservation</h1>
        <section id="tableau" class="content-section">
            <?php if (isset($_GET['success'])) : ?>
    <p style="color: rgb(255, 77, 166);">✅ Modification effectuée avec succès !</p>
        <?php endif; ?>
           <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>id_reservation</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Dates de reservation</th>
                        <th>Heure de reservation</th>
                        <th>Actions</th>
                
                    </tr>
                </thead>
                <tbody>
    <tr>
        <td>1</td>
        <td>Dupont</td>
        <td>Jean</td>
        <td>2024-06-01</td>
        <td>14:00</td>
        <td>
            <button onclick="ouvrirModale(
                <?= $reservation['id_reservation'] ?>,
                '<?= htmlspecialchars($reservation['nom']) ?>',
                '<?= htmlspecialchars($reservation['prenom']) ?>',
                '<?= $reservation['date_reservation'] ?>',
                '<?= $reservation['heure_reservation'] ?>'
            )" title="Modifier" style="background:none; border:none; cursor:pointer;">
                <i class="fa-solid fa-pen" style="color: rgb(255, 77, 166);"></i>
            </button>
        </td>
    </tr>
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

            <input type="hidden" name="id" id="input-id">

            <label>Nom :<br>
                <input type="text" name="nom" id="input-nom">
            </label><br><br>

            <label>Prénom :<br>
                <input type="text" name="prenom" id="input-prenom">
            </label><br><br>

            <label>Date :<br>
                <input type="date" name="date_reservation" id="input-date">
            </label><br><br>

            <label>Heure :<br>
                <input type="time" name="heure_reservation" id="input-heure">
            </label><br><br>

            <button type="submit">💾 Enregistrer</button> 
            <button type="button" onclick="fermerModale()">✖ Annuler</button>

        </form>
    </div>
<script src="js/update.js"></script>
</body>
</html>