<?php
session_start();
include '../traitement/function_panier.php';
creationPanier();

// Gestion des actions
if (isset($_POST['action'])) {
    if ($_POST['action'] === 'modifier' && isset($_POST['titre'], $_POST['quantity'])) {
        modifierQteArticle($_POST['titre'], (int)$_POST['quantity']);
    }
    if ($_POST['action'] === 'supprimer' && isset($_POST['titre'])) {
        supprimerArticle($_POST['titre']);
    }
}

// Gestion de l'ajout au panier
if (isset($_POST['ajouter'])) {
    ajouterArticle($_POST['titre'], 1, $_POST['prix'], $_POST['image'], $_POST['stock']); 
}

$produits = $_SESSION['panier'];

include '../include/database.php';

// Requêtes pour les derniers articles
$sql_film = 'SELECT * FROM article WHERE type = "film" ORDER BY annee';
$response_film = $connexion->query($sql_film);

$sql_series = 'SELECT * FROM article WHERE type = "série" ORDER BY annee';
$response_series = $connexion->query($sql_series);

// Requête pour les quantités disponibles dans le panier
$titresPanier = array_map(function($t) use ($connexion) {
    return $connexion->quote($t);
}, $produits['titre'] ?? []);
$titresListe = implode(',', $titresPanier);
$quantitesDispo = [];
if (!empty($titresListe)) {
    $sql = "SELECT titre, quantite FROM article WHERE titre IN ($titresListe)";
    $resultats = $connexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    foreach ($resultats as $row) {
        $quantitesDispo[$row['titre']] = (int)$row['quantite'];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier | SkyBlue</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="icon" type="image/png" href="../main/images/CD.png">
</head>
<body>
<?php include "../include/entete.php"; ?>

<section class="container_panier">
    <aside class="panier">
        <h2>MON PANIER</h2>
        <?php if (!empty($produits['titre'])): ?>
            <?php for ($i = 0; $i < count($produits['titre']); $i++): ?>
                <?php 
                $titre = $produits['titre'][$i];
                $quantiteDisponible = $quantitesDispo[$titre] ?? 1;
                ?>
                <form method="post" class="form_panier">
                    <span>
                        <?= htmlspecialchars($titre) ?> - 
                        <?= number_format((float)$produits['prix'][$i], 2) ?> €
                    </span><br>
                    <img src="<?= htmlspecialchars($produits['image'][$i]) ?>" alt="Image de l'article" class="img_panier"><br>
                    <input type="hidden" name="titre" value="<?= htmlspecialchars($titre) ?>">
                    <select name="quantity" class="select_panier">
                        <?php for ($j = 1; $j <= $quantiteDisponible; $j++): ?>
                            <option value="<?= $j ?>" <?= ($produits['quantity'][$i] == $j) ? 'selected' : '' ?> class="option_panier">
                                <?= $j ?>
                            </option>
                        <?php endfor; ?>
                    </select>

                    <button type="submit" name="action" value="modifier" class="button_panier">Modifier</button>
                    <button type="submit" name="action" value="supprimer" class="button_panier">Supprimer</button>
                </form>
            <?php endfor; ?>
        <?php else: ?>
            <p>Votre panier est vide.</p>
        <?php endif; ?>

        <p>Sous-Total : <?= number_format(montantTotal(), 2) ?> €</p>

        <div class="center">
            <div class="wrapper scrollable">
                <div class="inner">
                <?php foreach($response_film as $rf): ?>
                    <div class="card">
                        <img src="<?= $rf['imageURL'] ?>" alt="">
                        <div class="content">
                            <form method="post">
                                <input type="hidden" name="titre" value="<?= $rf['titre'] ?>">
                                <input type="hidden" name="prix" value="<?= $rf['prix'] ?>">
                                <input type="hidden" name="stock" value="<?= $rf['quantite'] ?>">
                                <input type="hidden" name="image" value="<?= $rf['imageURL'] ?>">
                                <button type="submit" name="ajouter" class="add-to-cart"><i class="fa-solid fa-cart-shopping"></i></button>
                                <p><?= $rf['titre'] ?> <br> <?= $rf['prix'] ?> €</p>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>     
            </div>
        </div>

        <script>
        const inner = document.querySelector('.inner');
        inner.addEventListener('wheel', (e) => {
            e.preventDefault();
            inner.scrollLeft += e.deltaY;
        });
        </script>

    </aside>

    <aside class="paiement_panier">
        <h2>TOTAL</h2>
        <p>Sous-Total : <?= number_format(montantTotal(), 2) ?> €</p>
        <p>Frais de port : 5.00 €</p>
        <p>Total : <?= number_format(montantTotal() + 5.00, 2) ?> €</p>
        <form action="/SAE23/pages/paiement.php" method="post">
            <button type="submit" class="button_paiement">PAIEMENT</button>
        </form>
    </aside>
</section>

<?php include "../include/pieds.html"; ?>
</body>
</html>
