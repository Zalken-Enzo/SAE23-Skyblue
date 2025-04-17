<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <title>Inscription</title>
  <link rel="stylesheet" href="style.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  <header>
    <?php include '../include/entete.html'; ?>
  </header>
  <div class="login-box">
    <div class="login-header">
      <header>Login</header>
    
  <?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
  $password = $_POST["password"];

 include '../include/database.php';

 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
 {
     echo "<h1> L'adresse email n'est pas valide. </h1>";
     exit();
 }

$query = $connexion->prepare("SELECT password, id_login, admin, id_client FROM login WHERE email = :email");
$query->bindParam(':email', $email);
$success = $query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);

if (!$success){
    echo "<h1>Erreur lors de la connexion.</h1>";
    exit();
}

if (!password_verify($password,$result['password']))
{
  echo "<h1> Email ou mot de passe ne correspondent pas <h1>";
  exit();
}

$_SESSION['id_client'] = $result['id_client'];
$_SESSION['id_login'] = $result['id_login'];
$_SESSION['admin'] = $result['admin'];

echo "<h1> Connexion Réussie! <h1>";
header("Refresh: 2; url=../accueil.php");

}

  ?>
    </div>
    </div>
  <?php include '../include/pieds.html'; ?>
</body>

</html>