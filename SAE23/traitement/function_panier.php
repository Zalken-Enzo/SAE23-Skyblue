<?php
function creationPanier() {
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [
            'titre' => [],
            'quantity' => [],
            'prix' => [],
            'image' => [],
            'stock' => []
        ];
    }
}

function ajouterArticle($titre, $quantite, $prix, $image, $stock) {

    creationPanier();
    $positionProduit = array_search($titre, $_SESSION['panier']['titre']);

    if ($positionProduit !== false) {
        // Le produit existe déjà, on incrémente la quantité
        $_SESSION['panier']['quantity'][$positionProduit] += $quantite;
    } else {
        // Nouveau produit, on l'ajoute
        $_SESSION['panier']['titre'][] = $titre;
        $_SESSION['panier']['quantity'][] = $quantite;
        $_SESSION['panier']['prix'][] = $prix;
        $_SESSION['panier']['image'][] = $image;
        $_SESSION['panier']['stock'][] = $stock;
    }
}

function supprimerArticle($titre) {
    creationPanier();
    $positionProduit = array_search($titre, $_SESSION['panier']['titre']);

    if ($positionProduit !== false) {
        // Suppression de toutes les infos liées à ce produit
        array_splice($_SESSION['panier']['titre'], $positionProduit, 1);
        array_splice($_SESSION['panier']['quantity'], $positionProduit, 1);
        array_splice($_SESSION['panier']['prix'], $positionProduit, 1);
        array_splice($_SESSION['panier']['image'], $positionProduit, 1);
    }
}

function modifierQteArticle($titre, $quantite) {
    creationPanier();
    $positionProduit = array_search($titre, $_SESSION['panier']['titre']);

    if ($positionProduit !== false) {
        if ($quantite > 0) {
            $_SESSION['panier']['quantity'][$positionProduit] = $quantite;
        } else {
            // Quantité 0 ou négative = suppression
            supprimerArticle($titre);
        }
    }
}

function montantTotal() {
    creationPanier();
    $total = 0;

    for ($i = 0; $i < count($_SESSION['panier']['titre']); $i++) {
        $total += $_SESSION['panier']['prix'][$i] * $_SESSION['panier']['quantity'][$i];
    }

    return $total;
}?>
