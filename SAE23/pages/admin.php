<?php
session_start();

// Vérifie si l'utilisateur est connecté et admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
    // Redirige vers la page d'accueil ou de connexion
    header('Location: /SAE23/accueil.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - SkyBlue</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <?php include '../include/entete.php'; ?>
    </header>
    <main style="height: 100vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <h1 class="titreAdmin">Bienvenue Administrateur de SkyBlue</h1>
        
        <div class="button-container" style="margin-top: 50px; flex-direction: column; align-items: center; gap: 20px;">
            <button onclick="window.location.href='admin_main.php'">Gestions articles</button>
            <button onclick="window.location.href='admin_ajouter.php'">Créations articles</button>
            <button onclick="window.location.href='admin_users.php'">Gestions utilisateurs</button>
            <button onclick="window.location.href='logout.php'">Déconnexion</button>
        </div>
    </main>
        <?php include '../include/pieds.html'; ?>
</body>
</html>
