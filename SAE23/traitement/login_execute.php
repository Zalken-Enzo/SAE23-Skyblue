<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sécurité : nettoyage des données
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];

    include '../include/database.php';

    // Vérifie que l'email est valide
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['login_error'] = "L'adresse email n'est pas valide.";
        header("Location: ../pages/login.php");
        exit();
    }

    // Requête préparée avec jointure pour récupérer le prénom de la table client
    $query = $connexion->prepare("SELECT login.password, login.id_login, login.admin, login.id_client, client.prenom 
                                  FROM login
                                  JOIN client ON client.id_client = login.id_client
                                  WHERE login.email = :email");
    $query->bindParam(':email', $email);
    $success = $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    // Si email inconnu
    if (!$success || !$result) {
        $_SESSION['login_error'] = "Email ou mot de passe incorrect.";
        header("Location: ../pages/login.php");
        exit();
    }

    // Vérification du mot de passe
    if (!password_verify($password, $result['password'])) {
        $_SESSION['login_error'] = "Email ou mot de passe incorrect.";
        header("Location: ../pages/login.php");
        exit();
    }

    // Connexion réussie, on stocke les infos en session
    $_SESSION['id_client'] = $result['id_client'];
    $_SESSION['id_login'] = $result['id_login'];
    $_SESSION['admin'] = $result['admin'];
    $_SESSION['prenom'] = $result['prenom'];

    // Redirection selon le rôle
    if ($result['admin'] == 1) {
        header("Location: ../pages/admin.php");
    } else {
        header("Location: ../accueil.php");
    }
    exit();
} else {
    // Accès direct sans POST
    header("Location: ../pages/login.php");
    exit();
}
?>
