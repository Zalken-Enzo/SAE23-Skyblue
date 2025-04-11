<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Accueil</title>
    <link rel="stylesheet" href="../style.css"/>
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
        </div>
        <div class="input-box">
            <input type="text" class="input-field" placeholder="Email" autocomplete="off" required>
        </div>
        <div class="input-box">
            <input type="password" class="input-field" placeholder="Password" autocomplete="off" required>
        </div>
        <div class="forgot">
            <section>
                <input type="checkbox" id="check">
                <label for="check">Remember me</label>
            </section>
            <section>
                <a href="#">Forgot password</a>
            </section>
        </div>
        <div class="input-submit">
    <button class="submit-btn" type="submit">Sign In</button>
</div>
        <div class="sign-up-link">
            <p>Don't have account? <a href="inscription.php">Sign Up</a></p>
        </div>
    </div>

</body>



<?php include '../include/pieds.html'; ?>
</body>

</html>