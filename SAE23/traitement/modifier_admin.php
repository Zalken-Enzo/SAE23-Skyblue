<?php
session_start();
include '../include/database.php';

// Vérifie si les données ont bien été envoyées
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_login'], $_POST['current_admin'])) {

    $id_login = intval($_POST['id_login']);
    $current_admin = intval($_POST['current_admin']);

    // Bascule le statut admin (1 → 0 ou 0 → 1)
    $new_admin = ($current_admin === 1) ? 0 : 1;

    try {
        $sql = "UPDATE login SET admin = :new_admin WHERE id_login = :id_login";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([
            ':new_admin' => $new_admin,
            ':id_login' => $id_login
        ]);

        // Redirige après succès
        header("Location: ../pages/admin_users.php");
        exit;

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

} else {
    echo "Requête invalide.";
}
