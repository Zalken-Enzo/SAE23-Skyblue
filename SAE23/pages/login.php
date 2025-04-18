<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>login</title>
    <link rel="stylesheet" href="../style.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
<header>
    <?php include '../include/entete.php'; ?>
</header>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (isset($_SESSION["id_login"])) {
    echo '<div class="login-box" style="text-align: center;">
            <div class="login-header">
                <header>Connexion</header>
                <h1>Vous êtes déjà connecté !</h1>
            
                 <form action="../traitement/logout_execute.php">
                  <br>
                <br>
                 <button class="submit-btn" type="submit">Déconnexion</button>
                 </form>
            </div>
          </div>';
    exit();
  }
  
?>
<div class="login-box">
    <div class="login-header">
        <header>Login</header>
    </div>

    <form action="../traitement/login_execute.php" method="POST">
        <div class="input-box">
            <input type="text" name="email" class="input-field" placeholder="Email" autocomplete="off" required>
        </div>
        <div class="input-box">
            <input type="password" name="password" class="input-field" placeholder="Password" autocomplete="off" required>
        </div>
        <div class="forgot">
            <section>
                <a href="#">Mot de passe oublié ?</a>
            </section>
        </div>
        <div class="input-submit">
            <button class="submit-btn" type="submit">Sign In</button>
        </div>
    </form>

    <div class="sign-up-link">
    <a href="inscription.php">Inscris-toi</a>
    </div>
</div>

<?php include '../include/pieds.html'; ?>
</body>

</html>
