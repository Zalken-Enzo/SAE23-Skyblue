<?php
if (isset($_POST['id_article'])){

    $x = $_POST['id_article'];

    include "../include/database.php";

    $sql = "DELETE FROM article WHERE id_article=$x";

    if($connexion -> query($sql)){
        header("location:../pages/admin_main.php");
    } else {
        echo "Erreur lors de la suppression de l'article.";

    }
} else {
    echo "non";
}
?>