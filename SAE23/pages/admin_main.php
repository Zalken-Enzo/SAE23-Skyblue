<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Ajouter un Article</title>
    <link rel="stylesheet" href="../style.css">
    <?php include '../include/entete.html'; ?>
</head>

<body>
    <div class="centrer">
        <input type="text" class="search-bar" id="searchBarAdmin" placeholder="Rechercher un article par ID ou NOM" />
    </div>
    <!-- Début du conteneur central -->
    <div class="colonneCentraleAdmin">

        <?php
    $sql_article = "SELECT * FROM article";
    include '../include/database.php';
    $response = $connexion ->query($sql_article);?>


        <?php foreach($response AS $r): ?>
        <!-- Début de la boite standardisé -->
        <div class="boiteStandardAdmin">
            <div class="colonneAdminMain">
                <div class="itemAdmin" id="photoAdminMain">
                    photo
                </div>
            </div>

            <div class="colonneAdminMain">
                <div class="itemAdmin" id="nomAdminMain">
                    <?php echo $r['titre']; ?>
                </div>

                <div class="itemAdmin" id="idAdminMain">
                    <?php echo $r['id_article']; ?>
                </div>

                <div class="itemAdmin" id="anneeAdminMain">
                    <?php echo $r['sortie']; ?>
                </div>

                <div class="itemAdmin" id="dureeAdminMain">
                    <?php echo $r['duree']; ?> min
                </div>

                <div class="itemAdmin" id="prixAdminMain">
                    <?php echo $r['prix']; ?>
                </div>

                <div class="itemAdmin" id="promoAdminMain">
                    promo
                </div>

                <div class="itemAdmin" id="qteAdminMain">
                    <?php echo $r['quantite']; ?>
                </div>

                <div class="itemAdmin" id="typeAdminMain">
                    <?php echo $r['type']; ?>
                </div>
                <div class="itemAdmin" id="genreAdminMain">
                    <?php echo $r['categorie']; ?>
                </div>

                <div class="itemAdmin" id="modifierAdminMainDiv">
                    <button id="modifierAdminMain"> Modifier </button>

                    <form action="/SAE23/traitphp/supprimer_media.php" method="POST" class="delete-form">
                        <input type="hidden" name="id_article" value="<?php echo $r['id_article']; ?>">
                        <button type="submit" class="modifierAdminMain"><i class="fas fa-trash"></i></button>
                    </form>
                </div>

            </div>

            <div class="itemAdmin" id="descriptionAdminMain">
                <?php echo $r['description']; ?>
            </div>


        </div>
        <?php endforeach; ?>



    </div>
    <!-- Fin du conteneur central -->
    <?php include '../include/pieds.html'; ?>

</body>

</html>