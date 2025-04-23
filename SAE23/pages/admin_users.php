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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Gérer les Utilisateurs</title>
    <link rel="stylesheet" href="../style.css">
    <?php include '../include/entete.php'; ?>
</head>

<body>
    <!-- Liste des médias -->
    <div class="media-list">
        <h2 style="text-align:center; margin: 30px 0;">Utilisateurs</h2>

        <?php
    $sql_login = "SELECT * FROM login";
    include '../include/database.php';
    $response = $connexion ->query($sql_login);
    ?>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>ID - Client</th>
                    <th>Admin</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($response AS $r): ?>
                <tr>
                    <td><?php echo $r['id_login']; ?></td>
                    <td><?php echo $r['email']; ?></td>
                    <td><?php echo $r['id_client']; ?></td>
                    <td><?php echo $r['admin']; ?> </td>
                    <td class="action-buttons">
                        <!-- Bouton modifier -->
                        <form method="post" action="/SAE23/traitement/modifier_admin.php">
                            <input type="hidden" name="id_login" value="<?php echo $r['id_login']; ?>" />
                            <input type="hidden" name="current_admin" value="<?php echo $r['admin']; ?>" />

                            <button type="submit" class="btn-modifier"
                                onclick="return confirm('Êtes-vous sûr de vouloir <?php echo $r['admin'] ? 'retirer' : 'donner'; ?> les droits admin à cet utilisateur ?');">
                                <?php echo $r['admin'] ? "Retirer Admin" : "Donner Admin"; ?>
                            </button>
                        </form>
                        <!-- Formulaire pour supprimer -->
                        <form action="../traitement/supprimer_login.php" method="POST" class="delete-form"
                            style="display:inline;">
                            <input type="hidden" name="id_login" value="<?php echo $r['id_login']; ?>">
                            <button type="submit" class="btn-supprimer"><i class="fas fa-trash"></i> Supprimer</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <?php include '../include/pieds.html'; ?>
</body>

</html>