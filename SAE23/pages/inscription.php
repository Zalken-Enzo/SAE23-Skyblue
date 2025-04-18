<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <title>Inscription</title>
  <link rel="stylesheet" href="../style.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  <header>
    <?php include '../include/entete.php';?>
  </header>

  <?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}


if (isset($_SESSION["id_login"])) {
  echo '<div class="login-box" style="text-align: center;">
          <div class="login-header">
              <header>Inscription</header>
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
      <header>Sign Up</header>
    </div>
    <form action="../traitement/inscription_execute.php" method="POST">
      <div class="input-box">
        <input type="text" class="input-field" placeholder="Nom" name="nom" required>
      </div>
      <div class="input-box">
        <input type="text" class="input-field" placeholder="Prénom" name="prenom" required>
      </div>
      <div class="input-box">
        <input type="text" class="input-field" placeholder="Ville" name="ville" required>
      </div>
      <div class="input-box">
        <input type="text" class="input-field" placeholder="Adresse" name="adresse" required>
      </div>
      <div class="input-box">
        <input type="email" class="input-field" placeholder="Email" name="email" required>
      </div>
      <div class="input-box">
        <input type="password" class="input-field" placeholder="Mot de passe" name="password" required>
      </div>
      <div class="input-box">
        <input type="password" class="input-field" placeholder="Confirmer mot de passe" name="confirm_password" required>
      </div>

      <div class="forgot">
        <section>
          <input type="checkbox" id="terms" required name="terms">
          <label for="terms">J'accepte les <a href="#">conditions</a></label>
        </section>
      </div>

      <div class="input-submit">
    <button class="submit-btn" type="submit">S'inscrire</button>
</div>

      <div class="sign-up-link">
        <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
      </div>
    </form>
  </div>

  <?php include '../include/pieds.html'; ?>
</body>

</html>