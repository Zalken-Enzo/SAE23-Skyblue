<?php
// connecte à la page de connextion 
include 'connect.php';
include_once('include/entete.php');

// récupère l'ID de l'article depuis l'url
$article_id = $_GET['id'];

// Requête pour otenir les détails de l'article
$sql = 'SELECT * FROM articles WHERE id = $article_id';
$result = $conn->query($sql);

if ($result->num_rows > 0 ){
    $article = $result ->fetch_acco();

    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset='UTF-8'>
        <title> Skyblue - <?php echo $article['titre']; ?> </title> <!-- récupère le titre de la l'article pour le mettre dans la page -->
        <link rel='stylesheet' type='text/css' href='style.css'>

    </head>

    <body>    
    </body>

    </html>
    <?php
}
?>