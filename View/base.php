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
        <img src="/assets/img/logo.png" alt="logo de La 3CA">
        <span>Communauté de Commune du Coeur de l'Avesnois</span>
        <?php
        if (isset($_SESSION['user'])) {?>
        <a href="/index.php?c=profile" id="logoUser"><img src="/assets/img/blueUser.png" alt=""></a>
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
                <li><a href="/index.php?c=category&a=get-category&name=sport">ACTIVITES SPORTIVES</a></li>
                <li><a href="/index.php?c=category&a=get-category&name=cultural">SORTIES CULTURELLES</a></li>
                <li><a href="/index.php?c=category&a=get-category&name=numerical">LE NUMERIQUE</a></li>
                <li><a href="/index.php?c=toolbox">UTILE</a></li>
            </ul>
        </div>
    </nav>
</header>

<main><?= $page ?></main>

<script src="https://kit.fontawesome.com/25d98733ec.js" crossorigin="anonymous"></script>
<script src="/assets/js/app.js"></script>
</body>
</html>
