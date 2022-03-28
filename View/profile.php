<section id="profile" class="white flex">
    <div class="flex">
        <h2>PROFIL</h2>
        <div id="profile-content" class="flex">
            <div class="flex">
                <h2>Utilisateur</h2>
                <div id="user-data">
                    <h3>Vos informations personnelles</h3>
                    <img src="/assets/img/avatar.png" alt="user logo">
                    <p>Nom / Pseudo : <?= $_SESSION['user']->getUsername() ?></p>
                    <p>Email : <?= $_SESSION['user']->getEmail() ?></p>
                    <p>Role : <?= $_SESSION['user']->getRole() ?></p>
                </div>
                <div id="user-reaction" class="flex">
                    <h3>Vos interractions</h3>
                    <div class="flex">
                        <a href="/index.php?c=profile&a=sticker-list&type=heart">
                            <img src="/assets/img/emojis/heart_colored.png" alt="heart">
                            <span>Coup de coeur</span>
                        </a>
                        <a href="/index.php?c=profile&a=sticker-list&type=good">
                            <img src="/assets/img/emojis/good_colored.png" alt="love">
                            <span>Sympa</span>
                        </a>
                        <a href="/index.php?c=profile&a=sticker-list&type=fun">
                            <img src="/assets/img/emojis/fun_colored.png" alt="fun">
                            <span>Drole</span>
                        </a>
                        <a href="/index.php?c=profile&a=sticker-list&type=happy">
                            <img src="/assets/img/emojis/happy_colored.png" alt="happy">
                            <span>Heureux</span>
                        </a>
                        <a href="/index.php?c=profile&a=sticker-list&type=bad">
                            <img src="/assets/img/emojis/bad_colored.png" alt="dislike">
                            <span>Pas intérressé</span>
                        </a>
                    </div>
                    <?php if($_SESSION["user"]->getRole() === "admin"){?>
                        <div class="button">
                            <a href="/index.php?c=user" id="listUser">Liste Utilisateurs</a>
                        </div>
                    <?php }?>
                </div>
            </div>

            <?php if($_SESSION["user"]->getRole() === "admin"){?>
                <div id="admin" class="flex">
                    <h2>Administrateur</h2>
                    <div>
                        <div id="add-activity">
                            <h3>Ajouter un article</h3>
                            <span>* = champ obligatoire</span>
                            <form action="/index.php?c=activity&a=add" method="post" enctype="multipart/form-data">
                                <div>
                                    <label for="title">Titre * :</label>
                                    <input type="text" id="title" name="title">
                                </div>
                                <div>
                                    <label for="category-type">Categorie * :</label>
                                    <select name="category-type" id="category-type">
                                        <option value="sport">Activité sportive</option>
                                        <option value="cultural">Activité culturelle</option>
                                        <option value="numerical">Numérique</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="activity-type">Type * :</label>
                                    <select name="activity-type" id="activity-type">
                                        <option value="club">Club</option>
                                        <option value="event">Evenement</option>
                                        <option value="place">Lieux</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="picture">image : </label>
                            <!--        todo gerer la taille max de l'image     -->
                                    <input type="file" id="picture" name="picture" accept=".image/jpeg, .jpg, .png">
                                </div>
                                <textarea name="content" id="content" cols="40" rows="10"></textarea>*
                                <div>
                                    <label for="location">Localisation * :</label>
                                    <input type="text" id="location" name="location">
                                </div>
                                <div>
                                    <label for="email">Email :</label>
                                    <input type="email" id="email" name="email">
                                </div>
                                <div>
                                    <label for="phone">Téléphone :</label>
                                    <input type="text" id="phone" name="phone">
                                </div>
                                <div>
                                    <label for="schedules">Date & Horaires * :</label>
                                    <input type="text" id="schedules" name="schedules">
                                </div>
                                <div>
                                    <label for="url">Lien :</label>
                                    <input type="url" id="url" name="url">
                                </div>
                                <div>
                                    <input type="submit" name="addAct">
                                </div>
                            </form>
                        </div>
                        <div id="add-link">
                            <h3>Ajouter un lien utile</h3>
                            <div>
                                <label for="link-type">Type</label>
                                <select name="link-type" id="link-type">
                                    <option value="mealth">Sante</option>
                                    <option value="mobility">Mobilité</option>
                                    <option value="help">Aide</option>
                                    <option value="other">Autre</option>
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
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
</section>
