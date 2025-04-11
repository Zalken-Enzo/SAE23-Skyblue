<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier | SkyBlue</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body> 
    <?php include "../include/entete.html"; ?>

        <?php
        // Inclusion des fichiers nécessaires
        include '../traitement/function_panier.php';
        
        // Création du panier si non existant
        creationPanier();
        
        // Gestion des actions utilisateur
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'modifier' && isset($_POST['nomProduit'], $_POST['qteProduit'])) {
                modifierQteArticle($_POST['nomProduit'], $_POST['qteProduit']);
            }
            if ($_POST['action'] == 'supprimer' && isset($_POST['nomProduit'])) {
                supprimerArticle($_POST['nomProduit']);
            }
        }
        
        // Récupération des produits du panier
        $produits = $_SESSION['panier'];
        ?>

        <section>
            <div class="panier">
            <h2>MON PANIER</h2>
            <div class="article-container">
            <!-- Articles -->
                <div class="article">
                <?php if (!empty($produits['nomProduit'])): ?>
                    <?php for ($i = 0; $i < count($produits['nomProduit']); $i++): ?>
                                
                            <form method="post">
                            	<span>
                                    <?= htmlspecialchars($produits['nomProduit'][$i]) ?>
                                    <?= number_format($produits['prixProduit'][$i], 2) ?> €
                                </span><br>
                                <img src="<?= htmlspecialchars($produits['imageProduit'][$i] ?? 'default.jpg') ?>" alt="" class="img_panier"><br>
                                <!-- Sélection de la quantité avec un menu déroulant -->
                                <input type="hidden" name="nomProduit" value="<?= htmlspecialchars($produits['nomProduit'][$i]) ?>">
                                <select name="qteProduit">
                                <?php for ($j = 1; $j <= 100; $j++): ?>
                                <option value="<?= $j ?>" <?= ($produits['qteProduit'][$i] == $j) ? 'selected' : '' ?>>
                                <?= $j ?>
                                </option>
                                <?php endfor; ?>
                                </select>
                                    <button type="submit" name="action" value="modifier">Modifier</button>
                                    <button type="submit" name="action" value="supprimer">Supprimer</button>
                                </form>
                    
                    <?php endfor; ?>
                </div>
                <?php else: ?>
                    <p>Votre panier est vide.</p>
                <?php endif; ?>

                <p>Sous-Total : <?= number_format(montantTotal(), 2) ?> €</p>

                
                <div class="carousel-container">
                    <div class="carousel" id="carousel">
                        <img src="<?= htmlspecialchars($produits['imageProduit'][$i] ?? 'default.jpg') ?>" alt="" class="img_menu_active">
                        <img src="<?= htmlspecialchars($produits['imageProduit'][$i] ?? 'default.jpg') ?>" alt="" class="img_menu_active">
                        <img src="<?= htmlspecialchars($produits['imageProduit'][$i] ?? 'default.jpg') ?>" alt="" class="img_menu_active">
                        <img src="<?= htmlspecialchars($produits['imageProduit'][$i] ?? 'default.jpg') ?>" alt="" class="img_menu_active">
                        <img src="<?= htmlspecialchars($produits['imageProduit'][$i] ?? 'default.jpg') ?>" alt="" class="img_menu_active">
                        <img src="<?= htmlspecialchars($produits['imageProduit'][$i] ?? 'default.jpg') ?>" alt="" class="img_menu_active">
                        <img src="<?= htmlspecialchars($produits['imageProduit'][$i] ?? 'default.jpg') ?>" alt="" class="img_menu">
                        <img src="<?= htmlspecialchars($produits['imageProduit'][$i] ?? 'default.jpg') ?>" alt="" class="img_menu">
                        <img src="<?= htmlspecialchars($produits['imageProduit'][$i] ?? 'default.jpg') ?>" alt="" class="img_menu">
                        <img src="<?= htmlspecialchars($produits['imageProduit'][$i] ?? 'default.jpg') ?>" alt="" class="img_menu">
                        <img src="<?= htmlspecialchars($produits['imageProduit'][$i] ?? 'default.jpg') ?>" alt="" class="img_menu">
                        <img src="<?= htmlspecialchars($produits['imageProduit'][$i] ?? 'default.jpg') ?>" alt="" class="img_menu">
                        <img src="<?= htmlspecialchars($produits['imageProduit'][$i] ?? 'default.jpg') ?>" alt="" class="img_menu">
                        <img src="<?= htmlspecialchars($produits['imageProduit'][$i] ?? 'default.jpg') ?>" alt="" class="img_menu">
                        <img src="<?= htmlspecialchars($produits['imageProduit'][$i] ?? 'default.jpg') ?>" alt="" class="img_menu">
                        <img src="<?= htmlspecialchars($produits['imageProduit'][$i] ?? 'default.jpg') ?>" alt="" class="img_menu">
                    </div>
                </div>

                <script>
                    let index = 0;
                    function scrollLeft() {
                        if (index > 0) {
                            index--;
                            updateCarousel();
                        }
                    }
                    function scrollRight() {
                        if (index < document.querySelectorAll('.carousel img').length - 3) {
                            index++;
                            updateCarousel();
                        }
                    }
                    function updateCarousel() {
                        document.getElementById('carousel').style.transform = `translateX(-${index * 220}px)`;
                    }

                    document.querySelector('.carousel-container').addEventListener('wheel', (event) => {
                        if (event.deltaY > 0) {
                            scrollRight();
                        } else {
                            scrollLeft();
                        }
                        event.preventDefault();
                    });
                </script>
                </div>
                </div>
            <div class="paiement">
                <h2>Total</h2>
            <!-- Total et paiement -->
                
                <p>Sous-Total : <?= number_format(montantTotal(), 2) ?> €</p>
                <p>Frais de port : 5.00 €</p>
                <p>Total : <?= number_format(montantTotal() + 5.00, 2) ?> €</p>
                <button type="submit" name="action" value="supprimer" class="button_paiement">PAIEMENT</button>
                
            </div>
        </section>
        <?php include "../include/pieds.html"; ?>
        
    </body>
</html>