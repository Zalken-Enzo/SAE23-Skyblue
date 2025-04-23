<?php
if (isset($_POST['id_login'])){

    $x = $_POST['id_login'];

    include "../include/database.php";

    $sql = "DELETE FROM login WHERE id_login=$x";

    if($connexion -> query($sql)){
        header("location:../pages/admin_users.php");
    } else {
        echo "Erreur lors de la suppression de l'utilisateur.";

    }
} else {
    echo "non";
}
?>