<?php

// récupère l'ID de l'article depuis l'url

$id_article = $_GET['id_article'];

include '../include/database.php';
// Préparer la requête pour obtenir les détails de l'article
$sql = 'SELECT * FROM article WHERE id_article = :id_article';
$stmt = $connexion->prepare($sql);
$stmt->bindParam(':id_article', $id_article, PDO::PARAM_INT);
$stmt->execute();

// Récupérer l'article
$article = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$article) {
    die('Article non trouvé');
}

$note =  $article['avis']; // note temporaire pour les testes, à imorté en SQL 
?>

<!DOCTYPE html>
    <html lang="fr">
    <head>        
        <meta charset='UTF-8'>
        <title> Skyblue - <?php echo $article['titre'] ?> </title>
        <!-- tire en aute de page, à imorté en SQL -->
        <link rel='stylesheet' type='text/css' href='../style.css'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <!-- style de la page  -->
        <script src="../note.js" defer></script>
        <!-- scripte pour le système de note     -->
    </head>

    <body>
        <?php
            include_once('../include/entete.php');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        ?>
            
        <!-- inclusion de l'entête commune  -->
        <h1 class='titre_article'> <?php echo $article["titre"]; ?> </h1>
        <!-- titre de l'article, à imorté en SQL -->
        <div class='container_article'>
            <div class = 'container_article_texet'>
                <!-- deuxime colone  -->
                <h2><?php echo $article["type"]; ?> -  <?php echo $article["categorie"]; ?> - <?php echo $article["duree"]; ?> minutes </h2>
                <!-- genre et durée de l'article, à imorté en SQL -->
                <h3> Notre avie  : </h3>           
                <div class="stars" id="stars"></div> 
                <!-- systeme d'étoile -->
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const note = <?php echo htmlspecialchars($note); ?>;
                        generateStars(note);
                    });
                </script>
                <p id='description_article'> 
                <!-- description de l'article, imorté en SQL -->
                    <?php echo $article["description"]; ?>
                </p>
                <h3> <?php
                if ($article["quantite"] > 0){
                   echo 'Disponible  : ';
                   echo $article["quantite"];
                   echo '<br>';
                   echo 'Prix : ';
                   echo $article["prix"];
                   echo ' €';
                } else { echo 'Indisponible';}?> 
                <br><br>
                Image d'affiche : 
                <img src='../images/<?php echo $article['image']; ?>' alt='Article' class='img_article'>  <br><br>
                Bande d'annonce :
                </h3>
                <iframe width="770" height="433" class='video_extrai' src=<?php echo $article['lienYT__extrai']; ?> title="YouTube video player" frameborder="0" ></iframe>      
            </div>

            <div>
                <div class='titreAdmin'>
                    Modification
                </div>

                <form class="colonneCentraleAdmin" method="POST" action="/SAE23/traitement/modifier_article_traitement.php" enctype="multipart/form-data">
                    <div class='conteneurObjetsAdmin'>
                        <!-- Nom de l'article  --> 
                        <div class='objetsAdmin'>
                            Titre :
                            <input class='search-bar' type="text" id="nomAdmin" name="nomAdmin" value="<?php echo $article["titre"]; ?>">
                        </div>
                        <div class='objetsAdmin'>
                            Id article : <?php echo $article["id_article"]; ?> 
                            <input type='hidden' name='id_article' value='<?php echo $article["id_article"]; ?>'>                          
                        </div>
                        <!-- Notre avis -->
                        <div class='objetsAdmin'>
                            Notre Avis /5 :
                            <input class='search-bar' type="text" id="Notre_avis" name="Notre_avis" value="<?php echo $article["avis"]; ?>">
                        </div>
                        <!-- Photo de l'article  -->
                        <div class='objetsAdmin'>
                            Image :
                            <input type="file" id="photoAdmin" name="photoAdmin" >
                        </div>
                        <!-- lienYT__extrai -->
                        <div class='objetsAdmin'>
                            LienYT__extrai :
                            <input class='search-bar' type="text" id="Notre_avis" name="Notre__avis" value="<?php echo $article["lienYT__extrai"]; ?>">
                        </div>
                        <!-- Prix de l'article  -->
                        <div class='objetsAdmin'>
                            Prix :
                            <input class='search-bar' type="text" id="prixAdmin" name="prixAdmin" value="<?php echo $article["prix"]; ?>">
                        </div>
                        <!-- Quantité -->
                        <div class='objetsAdmin'>
                            Quantité :
                            <input class='search-bar' type="text" id="qteAdmin" name="qteAdmin" value="<?php echo $article["quantite"]; ?>">
                        </div>
                        <!-- Genre de l'article -->
                        <div class='objetsAdmin'>
                            Genre : 
                            <select class='search-bar' name="genreAdmin" id="genreAdmin" placeholder="<?php echo $article["categorie"]; ?>">
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
                        <!-- Promotion de l'article
                        <div class='objetsAdmin'>
                            <input class='search-bar' type="text" id="promotionAdmin" name="promotionAdmin" placeholder="Promotion">
                        </div> -->

                        <!-- Description de l'article -->
                        <div class='objetsAdmin'>
                            Description
                            <input class='search-bar' type="text" id="descriptionAdmin" name="descriptionAdmin" value="<?php echo $article["description"]; ?>">
                        </div>
                        <!-- Type : Film / Série-->
                        <div class='objetsAdmin'>
                            <select class='search-bar' name="typeAdmin" id="typeAdmin" value="Type">
                                <option value="Film">Film</option>
                                <option value="Série">Série</option>
                            </select>
                        </div>
                        <!-- Année de Sortie -->
                        <div class='objetsAdmin'>
                           Année de Sortie
                            <input class='search-bar' type="text" id="anneeSortieAdmin" name="anneeSortieAdmin" value="<?php echo $article["annee"]; ?>">
                        </div>
                        <!-- durée du film -->
                        <div class='objetsAdmin'>
                            Durée (en minutes)
                            <input class='search-bar' type="text" id="dureeAdmin" name="dureeAdmin" value="<?php echo $article["duree"]; ?>">
                        </div>
                        <!-- Bouton de validation du formulaire d'ajout d'articles -->
                        <button type='submit' id="validerAdmin">Valider</button>
                        <!-- Bouton de retour à la page d'administration -->
                        <button type='button' id="validerAdmin" onclick="window.location.href='admin.php'">Retour</button>
                    </div>
                </form>
            </div>
            
        </div>
    </body>

<footer>
    <?php include_once('../include/pieds.html'); ?>
    <!-- inclusion du footer commun  -->
</footer>
</html>