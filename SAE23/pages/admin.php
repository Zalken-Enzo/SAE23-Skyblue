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
            <button onclick="window.location.href='gestion_utilisateurs.php'">Gestions utilisateurs</button>
            <button onclick="window.location.href='logout.php'">Déconnexion</button>
        </div>
    </main>
        <?php include '../include/pieds.html'; ?>
</body>
</html>
