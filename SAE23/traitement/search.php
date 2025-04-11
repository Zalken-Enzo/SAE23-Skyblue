<?php
include '../include/database.php';

$query = $_GET['query'] ?? '';

if ($query) {
    // recherche dans les titres
    $stmt = $connexion->prepare('SELECT * FROM article WHERE titre LIKE :query');
    $stmt->execute(['query' => '%' . $query . '%']);
    $results = $stmt->fetchAll();
} else {
    $results = [];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Résultat de recherche</title>
    <link rel="stylesheet" href="/SAE23/style.css" />
</head>
<body>
<h1>Résultats pour "<?php echo htmlspecialchars($query); ?>"</h1>

<?php if (count($results) > 0): ?>
    <ul>
        <?php foreach ($results as $result): ?>
            <li><?php echo htmlspecialchars($result['titre']); ?> - <?php echo $result['categorie']; ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun résultat trouvé.</p>
<?php endif; ?>
</body>
</html>
