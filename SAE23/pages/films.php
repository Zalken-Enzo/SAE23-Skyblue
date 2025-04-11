<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
<header>
    <?php include 'include/entete.html'; ?>
</header>

<?php
include 'include/database.php';

// Récupération des filtres
$genre = $_GET['category'] ?? 'all';
$prix = $_GET['price'] ?? 'all';
$duree = $_GET['duration'] ?? 'all';
$tri = $_GET['sort'] ?? 'default';

// Requête de base
$sql_article = 'SELECT * FROM article WHERE type = "film"';
$conditions = [];

if ($genre != 'all') {
    $conditions[] = 'categorie = ' . $connexion->quote($genre);
}

if ($prix != 'all') {
    if ($prix == 'low') $conditions[] = 'prix < 10';
    elseif ($prix == 'medium') $conditions[] = 'prix BETWEEN 10 AND 20';
    elseif ($prix == 'high') $conditions[] = 'prix > 20';
}

if ($duree != 'all') {
    if ($duree == 'short') $conditions[] = 'duree < 90';
    elseif ($duree == 'medium') $conditions[] = 'duree BETWEEN 90 AND 150';
    elseif ($duree == 'long') $conditions[] = 'duree > 150';
}

if (!empty($conditions)) {
    $sql_article .= ' AND ' . implode(' AND ', $conditions);
}

// Tri
if ($tri == 'price_asc') {
    $sql_article .= ' ORDER BY prix ASC';
} elseif ($tri == 'price_desc') {
    $sql_article .= ' ORDER BY prix DESC';
} elseif ($tri == 'recent') {
    $sql_article .= ' ORDER BY sortie DESC';
}

$response = $connexion->query($sql_article);
?>

<div class="filter-container">
    <h2>Filtres</h2>
    <form id="filter-form" method="get">
        <div class="filter">
            <label for="category">Genre</label>
            <select id="category" name="category">
                <option value="all" <?= $genre == 'all' ? 'selected' : '' ?>>Tous</option>
                <option value="action" <?= $genre == 'action' ? 'selected' : '' ?>>Action</option>
                <option value="comedy" <?= $genre == 'comedy' ? 'selected' : '' ?>>Comédie</option>
                <option value="drame" <?= $genre == 'drame' ? 'selected' : '' ?>>Drame</option>
                <option value="science-fiction" <?= $genre == 'science-fiction' ? 'selected' : '' ?>>Science-fiction</option>
                <option value="fantaisie" <?= $genre == 'fantaisie' ? 'selected' : '' ?>>Fantaisie</option>
                <option value="horreur" <?= $genre == 'horreur' ? 'selected' : '' ?>>Horreur</option>
            </select>
        </div>

        <div class="filter">
            <label for="price">Prix</label>
            <select id="price" name="price">
                <option value="all" <?= $prix == 'all' ? 'selected' : '' ?>>Tous</option>
                <option value="low" <?= $prix == 'low' ? 'selected' : '' ?>>Moins de 10€</option>
                <option value="medium" <?= $prix == 'medium' ? 'selected' : '' ?>>10€ à 20€</option>
                <option value="high" <?= $prix == 'high' ? 'selected' : '' ?>>Plus de 20€</option>
            </select>
        </div>

        <div class="filter">
            <label for="duration">Durée</label>
            <select id="duration" name="duration">
                <option value="all" <?= $duree == 'all' ? 'selected' : '' ?>>Toutes</option>
                <option value="short" <?= $duree == 'short' ? 'selected' : '' ?>>Moins de 90 min</option>
                <option value="medium" <?= $duree == 'medium' ? 'selected' : '' ?>>90 à 150 min</option>
                <option value="long" <?= $duree == 'long' ? 'selected' : '' ?>>Plus de 150 min</option>
            </select>
        </div>

        <div class="filter">
            <label for="sort">Trier par</label>
            <select id="sort" name="sort">
                <option value="default" <?= $tri == 'default' ? 'selected' : '' ?>>Par défaut</option>
                <option value="price_asc" <?= $tri == 'price_asc' ? 'selected' : '' ?>>Prix croissant</option>
                <option value="price_desc" <?= $tri == 'price_desc' ? 'selected' : '' ?>>Prix décroissant</option>
                <option value="recent" <?= $tri == 'recent' ? 'selected' : '' ?>>Plus récents</option>
            </select>
        </div>

        <button type="submit" class="apply-filters">Appliquer les filtres </button>
        <a href="films.php" class="reset-filters" style="margin-top: 30px">Réinitialiser</a>
    </form>
</div>

<div class="categories-container">
    <?php foreach($response as $r): ?>
        <div class="box">
            <img class="boximg" src="images/chihiro.webp" alt="Image de <?php echo htmlspecialchars($r['titre']); ?>" />
            <div class="box-content">
                <h2><?php echo htmlspecialchars($r['titre']); ?></h2>
                <span><?php echo $r['prix']; ?>€</span>
                <span class="duration">Durée: <?php echo $r['duree']; ?> min</span>
                <span class="genre">Genre: <?php echo htmlspecialchars($r['categorie']); ?></span>

                <div class="quantity">
                    <label for="quantity">Quantité:</label>
                    <input type="number" id="quantity" name="quantity" min="1" value="1">
                </div>

                <br><br>

                <button class="add-to-cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                </button>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'include/pieds.html'; ?>
</body>

</html>
