<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Gérer les Articles</title>
    <link rel="stylesheet" href="../style.css">
    <?php include '../include/entete.html'; ?>
</head>

<body>
  <!-- Liste des médias -->
  <div class="media-list">
    <h2 style="text-align:center; margin: 30px 0;">Catalogue actuel</h2>

    <?php
    $sql_article = "SELECT * FROM article";
    include '../include/database.php';
    $response = $connexion ->query($sql_article);
    ?>

    <table class="admin-table">
      <thead>
        <tr>
          <th>Titre</th>
          <th>Type</th>
          <th>Genre</th>
          <th>Prix</th>
          <th>Durée</th>
          <th>Quantité</th>
          <th>Action</th>
        </tr>
      </thead>
      
      <tbody>
      <?php foreach($response AS $r): ?>
        <tr>
          <td><?php echo $r['titre']; ?></td>
          <td><?php echo $r['type']; ?></td>
          <td><?php echo $r['categorie']; ?></td>
          <td><?php echo $r['prix']; ?> €</td>
          <td><?php echo $r['duree']; ?> min</td>
          <td><?php echo $r['quantite']; ?></td>
          <td class="action-buttons">
            <!-- Bouton modifier -->
            <a href="modifier_article.php?id_article=<?php echo $r['id_article']; ?>" class="btn-modifier">Modifier</a>
            
            <!-- Formulaire pour supprimer -->
            <form action="../traitement/supprimer_media.php" method="POST" class="delete-form" style="display:inline;">
              <input type="hidden" name="id_article" value="<?php echo $r['id_article']; ?>">
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
