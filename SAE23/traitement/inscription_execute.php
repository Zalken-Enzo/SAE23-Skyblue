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
      <header>Inscription</header>
    
  <?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

  $nom = htmlspecialchars($_POST["nom"]);
  $prenom = htmlspecialchars($_POST["prenom"]);
  $ville = htmlspecialchars($_POST["ville"]);
  $adresse = htmlspecialchars($_POST["adresse"]);
  $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm_password"];
  $termsAccepted = false;

 include '../include/database.php';

 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
 {
     echo "<h1> L'adresse email n'est pas valide. </h1>";
     exit();
 }

 $query = $connexion->prepare("SELECT email FROM login WHERE email = :email");
$query->bindParam(':email', $email);
$query->execute();

if ($query->rowCount() > 0) {
    echo "<h1> Cet email est déja utilisé. </h1>";
    exit();
}

  if (isset($_POST["terms"]))
      $termsAccepted = true;

  if ($password !== $confirm_password) 
  {
      echo "<h1> Les mots de passe ne correspondent pas. </h1>";
      exit();
  }
      
  if (!$termsAccepted)
  {
      echo "<h1> Vous devez accepter les conditions. </h1>";
      exit();
  }

      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $query = $connexion->prepare("INSERT INTO client (nom, prenom, adresse, ville, mail, age) VALUES (:nom, :prenom, :adresse, :ville, :mail, :age)");

$query->bindParam(':nom', $nom);
$query->bindParam(':prenom', $prenom);
$query->bindParam(':adresse', $adresse);
$query->bindParam(':ville', $ville);
$query->bindParam(':mail', $email);
$age = 0; // age is forced to be NOT NULL?
$query->bindParam(':age', $age);

$success = $query->execute();

if (!$success){
    echo "<h1>Erreur lors de l'inscription.</h1>";
    exit();
}
$id_client = $connexion->lastInsertId();
$admin = 0;
$query = $connexion->prepare("INSERT INTO login (email,password,id_client,admin) VALUES (:email, :password, :id_client, :admin)");

$query->bindParam(':email', $email);
$query->bindParam(':password', $hashedPassword);
$query->bindParam(':id_client', $id_client);
$query->bindParam(':admin', $admin);


$success = $query->execute();

if (!$success){
    echo "<h1>Erreur lors de l'inscription.</h1>";
    exit();
}

$id_login = $connexion->lastInsertId();
$_SESSION['id_client'] = $id_client;
$_SESSION['id_login'] = $id_login;
$_SESSION['admin'] = 0;

echo "<h1> Inscription Réussie! <h1>";
header("Refresh: 2; url=../accueil.php");

}

  ?>
    </div>
    </div>
  <?php include '../include/pieds.html'; ?>
</body>

</html>