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
            <h3>Chichas Classiques & Premium</h3>
            <ul>
                <li>Double Pomme - 15€</li>
                <li>Menthe Glaciale - 15€</li>
                <li>Mélange "Ronronnement" (Fruits Rouges & Vanille) - 18€</li>
            </ul>
            <h3>Boissons & Snacks</h3>
            <ul>
                <li>Thé à la menthe traditionnel - 5€</li>
                <li>Cocktail Félidé (Sans alcool) - 8€</li>
            </ul>
            <h3>Nos chats</h3>
            <ul>
                <li>Simba Le Maine Coon</li>
                <li>Suzanne la RH(Le Sacré de Birmanie)</li>
                <li>Kérubim (British Shorthair)</li>
                <li>Gaston (Chartreux)</li>
                <li>Atcham (Sphynx)</li>
                <li>Garfield (Persan)</li>
                <li>Nala (Siamois)</li>
                <li>O'Malley (Chat Européen)</li>
                <li>Duchesse (Angora Turc)</li>
                <li>Salem (Bombay)</li>

            </ul>
            <h3>Les Combos "Chichat" Parfaits</h3>
            <p>Associez la personnalité de nos félins à nos meilleures saveurs pour une expérience inoubliable !</p>
            <?php foreach ($services as $service) : ?>
                <div>
                    <ul>
                        <li><?= htmlspecialchars($service['nom']) ?></li>
                        <li><?= htmlspecialchars($service['description']) ?></li>
                        <li><?= htmlspecialchars($service['durree_minutes']) ?> min</li>
                        <li><?= htmlspecialchars($service['prix_euro']) ?> €</li>

                    </ul>
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