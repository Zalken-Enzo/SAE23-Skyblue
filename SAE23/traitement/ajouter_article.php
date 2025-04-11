<!-- Page php pour gérer les champs de donnés remplits dans 
 la page d'ajout des articles pour l'administrateur 
 j'ai ajouté un affichage simpliste pour être sur de ce qui est ajouté dans
 la base de donnée -->
 <?php
$servername = "localhost";
$username = "root";
$password = "";  // pas de mot de passe actuellement
$dbname = "mydb";  // nom de la db

// Create the database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and escape inputs to prevent SQL injection
    $nomAdmin = $conn->real_escape_string($_POST['nomAdmin']);
    $prixAdmin = $conn->real_escape_string($_POST['prixAdmin']);
    $qteAdmin = $conn->real_escape_string($_POST['qteAdmin']);
    $genreAdmin = $conn->real_escape_string($_POST['genreAdmin']);
    $promotionAdmin = $conn->real_escape_string($_POST['promotionAdmin']);
    $descriptionAdmin = $conn->real_escape_string($_POST['descriptionAdmin']);
    $typeAdmin = $conn->real_escape_string($_POST['typeAdmin']);
    $anneeSortieAdmin = $conn->real_escape_string($_POST['anneeSortieAdmin']);
    $dureeAdmin = $conn->real_escape_string($_POST['dureeAdmin']);
    
    // Handle file upload
    if (isset($_FILES['photoAdmin']) && $_FILES['photoAdmin']['error'] == 0) {
        $photoAdmin = $_FILES['photoAdmin']['name'];
        $uploadDir = "uploads/";  // Specify the directory to store the uploaded files
        $uploadFilePath = $uploadDir . basename($photoAdmin);

        // Move the uploaded file to the server
        if (move_uploaded_file($_FILES['photoAdmin']['tmp_name'], $uploadFilePath)) {
            echo "Photo uploaded successfully.<br>";
        } else {
            echo "Error uploading the photo.<br>";
            $photoAdmin = 'No photo uploaded';  // Default if upload failed
        }
    } else {
        $photoAdmin = 'No photo uploaded';  // Default if no file uploaded
    }

    // Inserting data into the database (make sure your table schema matches these columns)
    $sql = "INSERT INTO article (titre, imageURL, prix, quantite, categorie, description, type, annee,duree) 
            VALUES ('$nomAdmin', '$photoAdmin', '$prixAdmin', '$qteAdmin', '$genreAdmin', '$descriptionAdmin', '$typeAdmin', '$anneeSortieAdmin','$dureeAdmin')";

    if ($conn->query($sql) === TRUE) {
        echo "L'article a bien été ajouté à la base de données avec comme attributs : <br>";
        echo "Titre: " . $nomAdmin . "<br>";
        echo "Affiche: " . $photoAdmin . "<br>";
        echo "Prix: " . $prixAdmin . "€ <br>";
        echo "Quantité: " . $qteAdmin . "<br>";
        echo "Genre: " . $genreAdmin . "<br>";
        echo "Promotion: " . $promotionAdmin . "%<br>";
        echo "Description: " . $descriptionAdmin . "<br>";
        echo "Type: " . $typeAdmin . "<br>";
        echo "Année de sortie: " . $anneeSortieAdmin . "<br>";
        echo"Durée du film : ".$dureeAdmin ." minutes <br> ";
        echo "<button><a href='ajouter_article.php'>Revenir à la page d'ajout</a></button>";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
