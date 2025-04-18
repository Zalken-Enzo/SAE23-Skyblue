<?php
session_start();
if (!isset($_SESSION['id_login'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mon Compte</title>
  <link rel="stylesheet" href="../style.css" />
</head>
<body>
  <?php include '../include/entete.php'; ?>

  <div class="login-box">
    <div class="login-header">
      <h1>Bonjour <?php echo htmlspecialchars($_SESSION['prenom']); ?> 👋</h1>
      <p>Bienvenue sur votre espace personnel</p>

      <?php if (!empty($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
        <a href="../admin/admin.php"><button>Gérer le site</button></a>
      <?php else: ?>
        <a href="mes_commandes.php"><button>Voir mes commandes</button></a>
      <?php endif; ?>
    </div>
  </div>

  <?php include '../include/pieds.html'; ?>
</body>
</html>