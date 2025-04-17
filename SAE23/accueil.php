<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
    <header>
        <?php include 'include/entete.html'; ?>
    </header>

    <!-- Section swiper -->
    <section class="home swiper" id="home">
        <div class="swiper-wrapper">

            <div class="swiper-slide container">
                <div class="home-text">
                    <span></span>
                    <h1>Your Name</h1>
                    <a href="#" class="swbutton">Achetez le !</a>
                </div>
                <img src="images/yourname.png" alt="Your Name" />
            </div>

            <div class="swiper-slide container">
                <div class="home-text">
                    <span></span>
                    <h1>Parasite</h1>
                    <a href="#" class="swbutton">Achetez le !</a>
                </div>
                <img src="images/parasite.jpg" alt="Parasite" />
            </div>

            <div class="swiper-slide container">
                <div class="home-text">
                    <span></span>
                    <h1>Oppenheimer</h1>
                    <a href="#" class="swbutton">Achetez le !</a>
                </div>
                <img src="images/Oppenheime.jpg" alt="Oppenheimer" />
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </section>

    <!-- Section des films -->
    <section class="categories" id="categories">
        <div class="heading">
            <h1>Films</h1>
            <span>Dernière sortie</span>
            <a href="pages/films.php" class="swbutton">Voir plus !</a>
        </div>

        <!-- SQL -->
        <?php
        $sql_film = 'SELECT * FROM article WHERE type = "film" ORDER BY "sortie" DESC LIMIT 5';
        include 'include/database.php';
        $response_film = $connexion ->query($sql_film);?>

        <?php
        $sql_series = 'SELECT * FROM article WHERE type = "série" ORDER BY "sortie" DESC LIMIT 5';
        $response_series = $connexion ->query($sql_series);?>

        <!-- Conteneur principal -->

        <div class="categories-container">
            <?php foreach($response_film AS $rf): ?>
            <a href="./pages/article.php?id=<?php echo $rf['id_article']; ?>">
                <div class="box">
                    <img class="boximg" src="images/chihiro.webp" alt="Le Voyage de Chihiro" />
                    <div class="box-content">
                        <h2><?php echo $rf['titre']; ?></h2>
                        <span><?php echo $rf['prix']; ?>€</span>
                        <span class="duration">Durée: <?php echo $rf['duree']; ?> min</span> <!-- Durée -->
                        <span class="genre">Genre: <?php echo $rf['categorie']; ?></span> <!-- Genre -->

                        <!-- Champ de quantité -->
                        <div class="quantity">
                            <label for="quantity">Quantité:</label>
                            <input type="number" id="quantity" name="quantity" min="1" value="1">
                        </div>
                        <br>
                        <br>
                        <button class="add-to-cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>

                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

    </section>

    <!-- Section des séries -->
    <section class="categories" id="categories">
        <div class="heading">
            <h1>Séries</h1>
            <span>Dernière sortie</span>
            <a href="#" class="swbutton">Voir plus !</a>
        </div>

        <!-- Conteneur principal -->

        <div class="categories-container">
            <?php foreach($response_series AS $rs): ?>
            <div class="box">
                <img class="boximg" src="images/chihiro.webp" alt="Le Voyage de Chihiro" />
                <div class="box-content">
                    <h2><?php echo $rs['titre']; ?></h2>
                    <span><?php echo $rs['prix']; ?>€</span>
                    <span class="duration">Durée: <?php echo $rs['duree']; ?> min</span> <!-- Durée -->
                    <span class="genre">Genre: <?php echo $rs['categorie']; ?></span> <!-- Genre -->

                    <!-- Champ de quantité -->
                    <div class="quantity">
                        <label for="quantity">Quantité:</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1">
                    </div>
                    <br>
                    <br>
                    <button class="add-to-cart">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </button>

                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </section>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="main.js"></script>

    <?php include 'include/pieds.html'; ?>


</body>

</html>