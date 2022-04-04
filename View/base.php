<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Ados en Avesnois</title>
</head>
<body>
<header>
    <?php

    use Model\Entity\User;

    if (isset($_SESSION['error'])) {
    ?>
        <div class="error">
    <?php
        foreach ($_SESSION['error'] as $value) {
        ?>
            <p><?= $value ?></p>
        <?php
        }
    ?>
            <button id="close">x</button>
        </div>
    <?php
        unset($_SESSION['error']);
    }
    ?>
    <div>
        <a href="/index.php">
            <img src="/assets/img/logo.png" alt="logo de La 3CA">
        </a>
        <span>Communauté de Commune du Coeur de l'Avesnois</span>
        <?php
        if (isset($_SESSION['user'])) {?>
        <a href="/index.php?c=profile" id="logoUser">
            <img src="/assets/img/avatar/<?= $_SESSION['user']->getAvatar() ?>" alt="avatar">
        </a>
            <a class="menu" href="/index.php?c=connection&a=logout" id="logout"><i class="fas fa-sign-out-alt"></i></a>
        <?php } else{?>
            <a href="/index.php?c=connection" id="logoUser"><img src="/assets/img/blueUser.png" alt=""></a>
        <?php }?>

    </div>
    <nav>
        <span class="menu"><i class="fas fa-bars"></i></span>
        <div class="menu">
            <ul>
                <li><a href="/index.php">ACCUEIL</a></li>
                <li><a href="/index.php?c=category&a=get-category&name=sport&type">ACTIVITES SPORTIVES</a></li>
                <li><a href="/index.php?c=category&a=get-category&name=cultural&type">SORTIES CULTURELLES</a></li>
                <li><a href="/index.php?c=category&a=get-category&name=numerical&type">LE NUMERIQUE</a></li>
                <li><a href="/index.php?c=toolbox">UTILE</a></li>
            </ul>
        </div>
    </nav>
</header>

<main><?= $page ?></main>

<?php
if(!isset($color)) {
    $color = 'gray';
}
?>
<footer style="background-color: <?= $color ?>">
    <div class="flex">
        <div>
            <h3>Nous contacter</h3>
            <address>tel : 03.27.56.11.80</address>
        </div>

        <div>
            <h3>Nous trouver</h3>
            <address>43 rue Cambrésienne</address>
            <address>59440 Avesnes sur Helpe</address>
        </div>

        <div>
            <h3>Les horaires</h3>
            <p>Lundi au jeudi de 9h à 12h et de 13h30 à 17h30</p>
            <p>Vendredi de 9h à 12h et de 13h30 à 16h30</p>
        </div>
    </div>

    <p>&copy</p>
</footer>

<script src="https://kit.fontawesome.com/25d98733ec.js" crossorigin="anonymous"></script>
<script src="/assets/js/app.js"></script>
</body>
</html>
