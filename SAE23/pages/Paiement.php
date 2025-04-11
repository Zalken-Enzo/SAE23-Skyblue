<?php
session_start();

// Vérifier si le panier est vide
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    header("Location: panier.php");
    exit;
}

// Calcul du total du panier
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Si le formulaire de paiement est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Traitement des informations de paiement (envoi à une API, validation, etc.)
    // Pour cet exemple, on simule un paiement réussi

    // Rediriger vers une page de confirmation
    header("Location: confirmation.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Page de Paiement</h1>

    <div>
        <h2>Résumé de votre panier</h2>
        <table>
            <thead>
                <tr>
                    <th>Article</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= htmlspecialchars($item['quantity']) ?></td>
                    <td><?= number_format($item['price'], 2, ',', ' ') ?> €</td>
                    <td><?= number_format($item['price'] * $item['quantity'], 2, ',', ' ') ?> €</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Total à payer : <?= number_format($total, 2, ',', ' ') ?> €</h3>
    </div>

    <form action="" method="POST">
        <h2>Informations de Paiement</h2>

        <label for="name">Nom sur la carte :</label>
        <input type="text" id="name" name="name" required><br>

        <label for="card_number">Numéro de carte :</label>
        <input type="text" id="card_number" name="card_number" required><br>

        <label for="expiration">Date d'expiration :</label>
        <input type="month" id="expiration" name="expiration" required><br>

        <label for="cvv">Code CVV :</label>
        <input type="text" id="cvv" name="cvv" required><br>

        <input type="submit" value="Payer maintenant">
    </form>

</body>
</html>
