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
<<<<<<< HEAD
    
    <link rel="stylesheet" href="CSS/style.css">
=======
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
>>>>>>> 25d65379ede50b06bbcd673a1df673a8ee537fba
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

                

                <!-- INFORMATIONS DU PRODUIT -->
                <div class="product-details">

                    <div>
                        <h2><?= htmlspecialchars($service['nom']) ?></h2>


                        <div class="price">
                            <?= htmlspecialchars($service['prix_euro']) ?> €
                        </div>

                        <div class="shop-name">
                            Durée : <?= htmlspecialchars($service['duree_minutes']) ?> min
                        </div>

                        <div class="description">
                            <?= htmlspecialchars($service['description']) ?>
                        </div>
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
                
                <a href="tel:+33123456789" class="btn btn--primary btn--lg">Reserver</a>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy;Chichats Since 1908. Tous droits réservés. | 123 Rue des Félins,Chauteau Rouge, Paris</p>
    </footer>
</body>
</html>