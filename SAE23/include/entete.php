<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="/SAE23/style.css" />
    <title>Title</title>
</head>

<body>
    <?php
// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

    <header>
            <img class="logo" src="/SAE23/images/logo.png" alt="logo" />
        <nav>
            <ul class="nav">
                <li><a href="/SAE23/accueil.php">Accueil</a></li>
                <li><a href="/SAE23/pages/films.php">Films</a></li>
                <li><a href="/SAE23/pages/series.php">Séries</a></li>
            </ul>
        </nav>

        <form class="search" method="get" action="/SAE23/traitement/search.php">
            <input type="text" class="search-bar" placeholder="Rechercher..." name="query" />
        </form>

        <div class="button-container">
            <?php if (isset($_SESSION['prenom'])): ?>
            <!-- Si l'utilisateur est connecté -->
            <div class="user-menu">
                <button class="user-button"><?= $_SESSION['prenom'] ?></button>
                <div class="dropdown-menu">
                    <ul>
                        <li><a href="/SAE23/pages/moncompte.php">Mon compte</a></li>
                        <li><a href="/SAE23/traitement/logout_execute.php">Déconnexion</a></li>
                        <?php if ($_SESSION['admin'] == 1): ?>
                        <li><a href="/SAE23/pages/admin.php">Admin</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <a class="sgn" href="/SAE23/pages/panier.php">
                <button>Panier</button>
            </a>
            <?php else: ?>
            <!-- Si l'utilisateur n'est pas connecté -->
            <a class="sgn" href="/SAE23/pages/login.php">
                <button>Connexion</button>
            </a>
            <a class="sgn" href="/SAE23/pages/panier.php">
                <button>Panier</button>
            </a>
            <?php endif; ?>
        </div>
    </header>
    <!-- Ajouter du style pour la gestion du menu déroulant -->
    <style>

    </style>

</body>

</html>