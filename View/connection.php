<h1>Connexion / Inscription</h1>

<div class="flex connection_register">
    <form id="connection" action="/index.php?c=connection&a=connect" method="post">
        <h2>Connexion</h2>
        <input type="email" placeholder="Votre email" name="email">
        <input type="password" placeholder="Votre mot de passe" name="password">

        <input type="submit" name="submit" value="connexion">
    </form>

    <form id="register" action="/index.php?c=connection&a=register" method="post">
        <h2>Inscription</h2>
        <input type="email" placeholder="Votre email" name="email">
        <input type="text" placeholder="Votre pseudo" name="username">

        <input type="password" placeholder="Votre mot de passe" name="password">
        <input type="password" placeholder="Répéter votre mot de passe" name="passwordRepeat">

        <input type="submit" name="submit" value="inscription">
    </form>
</div>