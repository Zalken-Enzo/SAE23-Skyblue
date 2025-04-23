<?php
include '../include/database.php';

$query = isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '';

if (!$query) {
    echo "<h2>Veuillez entrer un terme de recherche.</h2>";
    exit;
}

// Requête SQL
$sql = "SELECT * FROM article WHERE titre LIKE :query OR categorie LIKE :query ORDER BY annee DESC";
$stmt = $connexion->prepare($sql);
$stmt->execute(['query' => "%$query%"]);
$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Résultats pour "<?php echo $query; ?>"</title>
    <link rel="stylesheet" href="/SAE23/style.css">
</head>

<body>
    <?php include '../include/entete.php'; ?>

    <h1>Résultats de recherche pour "<?php echo $query; ?>"</h1>
    <div class="categories-container">
        <?php if (count($resultats) > 0): ?>
        <?php foreach($resultats as $r): ?>
        <div class="box">
            <img class="boximg" src="/SAE23/images/<?php echo $r['image']; ?>"
                alt="Image de <?php echo htmlspecialchars($r['titre']); ?>" />
            <div class="box-content">
                <a href="/SAE23/article.php?id=<?php echo $r['id_article']; ?>" class="link-wrapper">
                    <h2><?php echo htmlspecialchars($r['titre']); ?></h2>
                    <span><?php echo $r['prix']; ?>€</span>
                    <span class="duration">Durée: <?php echo $r['duree']; ?> min</span>
                    <span class="genre">Genre: <?php echo htmlspecialchars($r['categorie']); ?></span>
                </a>

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
        <?php else: ?>
        <p>Aucun article trouvé pour "<?php echo $query; ?>"</p>
        <?php endif; ?>
    </div>

    <?php include '../include/pieds.html'; ?>
</body>

</html>