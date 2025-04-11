
<?php


// récupère l'ID de l'article depuis l'url

$id_article =2;
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

// permet d'executer la requête préparé

session_start();
include '../traitement/function_panier.php';
creationPanier();
if (isset($_POST['ajouter'])) {
    ajouterArticle($_POST['nomProduit'], 1, $_POST['prixProduit'], $_POST['imageProduit']);
}

$note = 4 //$article['note']; // note temporaire pour les testes, à imorté en SQL 
?>
<!DOCTYPE html>
    <html lang="fr">
    <head>        
        <meta charset='UTF-8'>
        <title> Skyblue - <?php echo $article['titre'] ?> </title>
        <!-- tire en aute de page, à imorté en SQL -->
        <link rel='stylesheet' type='text/css' href='../style.css'>
        <!-- style de la page  -->
        <script src="note.js" defer></script>
        <!-- scripte pour le système de note     -->
    </head>

    <body>
        <?php
            include_once('../include/entete.html');
        ?>
            
        <!-- inclusion de l'entête commune  -->
        <h1 id='titre_haut'> <?php echo $article["titre"]; ?> </h1>
        <!-- titre de l'article, à imorté en SQL -->
        <div class='container_article'>
            <div>
                <!-- premier colone  -->
                <img src='img_article/leparin.jpg' alt='Article' class='img_article'>  <br><br>
                <!-- affiche de l'article, à imorté en SQL ?php echo $article["chemain_image"]; ? -->
                <h2 style='color:white;'> Bande d'annonce </h2>
                <iframe width="770" height="433" class='video_extrai' src="https://www.youtube.com/embed/UaVTIH8mujA?si=rgO7gNgI9onR6U4g" title="YouTube video player" frameborder="0" ></iframe>
                <!-- intégrayion youtube pour l'extrai, avec un lien, à imorté en SQL -->
            </div>

            <div class = 'container_article_texet'>
                <!-- deuxime colone  -->
                <h2>  <?php echo $article["categorie"]; ?> - <?php echo $article["duree"]; ?> minutes </h2>
                <!-- genre et durée de l'article, à imorté en SQL -->
                <h3> Alo ciné  : </h3>           
                <div class="stars" id="stars"></div> 
                <!-- systeme d'étoile -->
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const note = <?php echo htmlspecialchars($note); ?>;
                        generateStars(note);
                    });
                </script>
                <p id='description_article'> 
                <!-- description de l'article, à imorté en SQL -->
                    <?php echo $article["description"]; ?>
                </p>
                <h3> <?php
                 if ($article["quantite"] > 0){
                    echo 'Disponible';
                    echo '<br>';
                    echo 'Prix : ';
                    echo $article["prix"];
                    echo ' €';
                 } else { echo 'Indisponible';}?>
                <!-- affiche la disponibilité -->
                <!-- prix, à imorté en SQL -->
                <form method="post">
                    <input type="hidden" name="nomProduit" value=<?php echo $article["titre"]; ?>>
                    <input type="hidden" name="prixProduit" value=<?php echo $article["prix"]; ?>>
                    <input type="hidden" name="imageProduit" value="filmA.jpg">
                    <div class="sgn" > <button id="add_pagnier" type="submit" name="ajouter"> Ajouté Film a - prix </button> </div>
                </form>
                <!-- bouton ajouté au panier, avec un lien, à imorté en SQL -->
            </div>
        </div>
    </body>

<footer>
    <?php include_once('pieds.html'); ?>
    <!-- inclusion du footer commun  -->
</footer>
</html>