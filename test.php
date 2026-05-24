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

                    <!-- BOUTONS -->
                    <div class="actions">
                        
                    
                            
                        <button  class="buy-btn">Reserver</button>
                        
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
        
        <section id="call-to-action" class="cta">
            <div class="cta__glow"></div>
            <div class="cta__content">
                <h2 class="section-title">Qu'est-ce que tu attends ?</h2>
                <p>Réserve tout de suite !</p>
                <button type="button" class="btn btn--primary btn--lg">Réserver</button>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy;Chichats Since 1908. Tous droits réservés. | 123 Rue des Félins,Chauteau Rouge, Paris</p>
    </footer>
</body>
</html>