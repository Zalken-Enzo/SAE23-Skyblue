<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Ajouter un Article</title>
    <link rel="stylesheet" href="style.css">
    <?php include('entete.html'); ?>
</head>

<body>

    <!-- <div id="barreDeRechercheAdmin">
        <input type="text" class="search-bar" placeholder="Rechercher un article par ID ou NOM" />
    </div>
	Navbar, je garde la template mais faut la virer 
	-->
    
	<div class='titreAdmin'>
	➕ Ajouter un article 
	</div>
	<form class="colonneCentraleAdmin" method="POST" action="ajouter_article.php" enctype="multipart/form-data">
        <div class='conteneurObjetsAdmin'>
            <!-- Nom de l'article  --> 
            <div class='objetsAdmin'>
                <label for="nomAdmin">Nom de l'article</label>
                <input class='search-bar' type="text" id="nomAdmin" name="nomAdmin">
            </div>
            <!-- Photo de l'article  -->
            <div class='objetsAdmin'>
                <label for="photoAdmin">Photo:</label>
                <input type="file" id="photoAdmin" name="photoAdmin">
            </div>
            <!-- Prix de l'article  -->
            <div class='objetsAdmin'>
                <label for="prixAdmin">Prix de l'article</label>
                <input class='search-bar' type="text" id="prixAdmin" name="prixAdmin">
            </div>
            <!-- Quantité -->
            <div class='objetsAdmin'>
                <label for="qteAdmin">Quantité</label>
                <input class='search-bar' type="text" id="qteAdmin" name="qteAdmin">
            </div>
            <!-- Genre de l'article -->
            <div class='objetsAdmin'>
                <label for="genreAdmin">Choisir le Genre :</label>
                <select class='search-bar' name="genreAdmin" id="genreAdmin">
                    <option value="Action">Action</option>
                    <option value="Aventure">Aventure</option>
                    <option value="Comédie">Comédie</option>
                    <option value="Drame">Drame</option>
                    <option value="Horreur">Horreur</option>
                    <option value="Romance">Romance</option>
                    <option value="Sci-Fi">Sci-Fi</option>
                    <option value="Fantaisie">Fantaisie</option>
                    <option value="Thriller">Thriller</option>
                    <option value="Documentaire">Documentaire</option>
                    <option value="Animation">Animation</option>
                    <option value="Famille">Famille</option>
                </select>
            </div>
            <!-- Promotion de l'article -->
            <div class='objetsAdmin'>
                <label for="promotionAdmin">Promotion en %</label>
                <input class='search-bar' type="text" id="promotionAdmin" name="promotionAdmin">
            </div>
            <!-- Description de l'article -->
            <div class='objetsAdmin'>
                <label for="descriptionAdmin">Description article</label>
                <input class='search-bar' type="text" id="descriptionAdmin" name="descriptionAdmin">
            </div>
            <!-- Type : Film / Série-->
            <div class='objetsAdmin'>
                <label for="typeAdmin">Choisir un type :</label>
                <select class='search-bar' name="typeAdmin" id="typeAdmin">
                    <option value="Film">Film</option>
                    <option value="Série">Série</option>
                </select>
            </div>
            <!-- Année de Sortie -->
            <div class='objetsAdmin'>
                <label for="anneeSortieAdmin">Année de sortie :</label>
                <input class='search-bar' type="text" id="anneeSortieAdmin" name="anneeSortieAdmin">
            </div>
			<!-- durée du film -->
            <div class='objetsAdmin'>
                <label for="dureeAdmin">durée du film :</label>
                <input class='search-bar' type="text" id="dureeAdmin" name="dureeAdmin">
            </div>
            <!-- Bouton de validation du formulaire d'ajout d'articles -->
            <button type='submit' id="validerAdmin">Valider</button>
        </div>
    </form>

    <?php include('pieds.html'); ?>

</body>

</html>
