<?php
// Inclure le fichier de connexion
include('../include/database.php'); // Adapte le chemin en fonction de l'emplacement de ton fichier

// Vérifie que le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $titre = $_POST['nomAdmin'];
    $description = $_POST['descriptionAdmin'];
    $type = $_POST['typeAdmin'];
    $duree = $_POST['dureeAdmin'];
    $annee = $_POST['anneeSortieAdmin'];
    $prix = $_POST['prixAdmin'];
    $categorie = $_POST['genreAdmin'];
    $quantite = $_POST['qteAdmin'];
    $id_article = $_POST['id_article'];
    $Notre_avis = $_POST['Notre_avis'];

    // Gestion de l'image
    $image_nom = null;
    if (isset($_FILES['photoAdmin']) && $_FILES['photoAdmin']['error'] == 0) {
        // Dossier où on va stocker l'image
        $dossierUpload = '../images/';
        // Nom du fichier image
        $image_nom = basename($_FILES['photoAdmin']['name']);
        // Déplacer l'image dans le dossier
        move_uploaded_file($_FILES['photoAdmin']['tmp_name'], $dossierUpload . $image_nom);
    }

    // Préparer la requête SQL pour insérer les données dans la base
    if ($image_nom != null){
        $sql = "UPDATE Article SET 
            titre = :titre,
            description = :description,
            type = :type,
            duree = :duree,
            annee = :annee,
            prix = :prix,
            categorie = :categorie,
            quantite = :quantite,
            image = :image,
            avis = :Notre_avis
        WHERE id_article = :id_article";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([
            ':titre' => $titre,
            ':description' => $description,
            ':type' => $type,
            ':duree' => $duree,
            ':annee' => $annee,
            ':prix' => $prix,
            ':categorie' => $categorie,
            ':quantite' => $quantite,
            ':image' => $image_nom, // Enregistre juste le nom de l'image
            ':id_article' => $id_article,
            ':Notre_avis' => $Notre_avis
        ]);
    } else {
        $sql = "UPDATE Article SET 
            titre = :titre,
            description = :description,
            type = :type,
            duree = :duree,
            annee = :annee,
            prix = :prix,
            categorie = :categorie,
            quantite = :quantite,
            avis = :Notre_avis
        WHERE id_article = :id_article";

        $stmt = $connexion->prepare($sql);
        $stmt->execute([
            ':titre' => $titre,
            ':description' => $description,
            ':type' => $type,
            ':duree' => $duree,
            ':annee' => $annee,
            ':prix' => $prix,
            ':categorie' => $categorie,
            ':quantite' => $quantite,
            ':id_article' => $id_article,
            ':Notre_avis' => $Notre_avis
        ]);
    }
    
    

    // Redirection ou message de succès
    header("Location: ../admin.php?ajout=success");
    exit();
} else {
    echo "Formulaire non soumis correctement.";
}
?>
