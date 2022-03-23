<section id="profile" class="white flex">
    <div class="flex">
        <h2>PROFIL UTILISATEUR</h2>
        <div id="profile-content" class="flex">
            <div>
                <div id="user-data">
                    <h3>Vos informations personnelles</h3>
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
                        <img src="/assets/img/emojis/bad_colored.png" alt="dislike">
                        <span>Pas intérressé</span>
                    </a>
                </div>
            </div>
            <section id="admin" class="flex">
                <div id="add-activity">
                    <h3>Ajouter un article</h3>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div>
                            <label for="title">Titre :</label>
                            <input type="text" id="title" name="title">
                        </div>
                        <div>
                            <label for="activity-type">Type :</label>
                            <select name="activity-type" id="activity-type">
                                <option value="sport">Activité sportive</option>
                                <option value="cultural">Activité culturelle</option>
                                <option value="numerical">Numérique</option>
                            </select>
                        </div>
                        <div>
                            <label for="picture"></label>
                            <input type="file" id="picture" name="picture" accept=".image/jpeg, .jpg, .png">&nbsp;(Max : 2Mo)
                        </div>
                        <textarea name="content" id="content" cols="30" rows="15"></textarea>
                        <div>
                            <input type="submit" name="addAct">
                        </div>
                    </form>
                </div>
                <div id="add-link">
                    <h3>Ajouter un lien dans la boîte à outils</h3>
                    <div>
                        <label for="link-type">Type</label>
                        <select name="link-type" id="link-type">
                            <option value="club">Club et Association</option>
                            <option value="event">Evênement</option>
                            <option value="place">Lieu</option>
                            <option value="useful">Utile</option>
                        </select>
                    </div>
                    <div>
                        <label for="newUrl"></label>
                        <input type="url" id="newUrl" name="new-url" placeholder="lien">
                    </div>
                    <div>
                        <input type="submit" name="addLink">
                    </div>
                </div>
            </section>

    </div>
</section>
