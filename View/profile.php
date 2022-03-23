<section id="profile" class="white flex">
    <h2>PROFIL UTILISATEUR</h2>
    <div>
        <div>
            <h3>Vos information personnelles</h3>
            <img src="/assets/img/avatar.png" alt="user logo">

            <p>Nom / Pseudo : Ché-mi</p>
            <p>Email : chéninmi@tiot.fr</p>
            <p>Role : Utilisateur</p>
        </div>
        <div>
            <h3>Vos interractions</h3>
            <a href="">
                <img src="/assets/img/emojis/heart.png" alt="heart">
                <span>Coup de coeur</span>

            </a>
            <a href="">
                <img src="/assets/img/emojis/like.png" alt="love">
                <span>Sympa</span>

            </a>
            <a href="">
                <img src="/assets/img/emojis/lol.png" alt="fun">
                <span>Drole</span>

            </a>
            <a href="">
                <img src="/assets/img/emojis/smiley.png" alt="happy">
                <span>Heureux</span>

            </a>
            <a href="">
                <img src="/assets/img/emojis/dislike.png" alt="dislike">
                <span>Pas intérressé</span>

            </a>
        </div>

        <div>
            <h3>Les articles</h3>
            <div>
                <img src="/assets/img/emojis/heart.png" alt="heart">
                <ul>
                    <li>// liste des articles "aimés"</li>
                </ul>
            </div>

        </div>

        <?php if($_SESSION["user"]->getRole() === "admin"){?>
            <section id="admin">
                <h2>Ajouter un article</h2>
                <form action="" method="post">
                    <input type="text" name="title" placeholder="titre de l'activité">
                    <select name="type" id="activity-type">
                        <option value="sport">Activité sportive</option>
                        <option value="cultural">Activité culturelle</option>
                        <option value="numerical">Numérique</option>
                    </select>
                </form>
                <h2>Ajouter un lien utile</h2>
            </section>
        <?php } ?>

    </div>
</section>
