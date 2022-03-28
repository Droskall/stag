<section id="userList" class="flex">
    <div class="white">
        <h2>Liste des utilisateurs</h2>
        <div class="list flex">
            <?php
            foreach ($data as $item){?>
                <div class="frame flex">
                    <!--   TODO replace by avatar   -->
                    <img src="/assets/img/avatar.png" width="50px" alt="user logo">
                    <div>
                        <p class="userList">Nom : <?= $item->getUsername() ?></p>
                        <p class="userList">Email : <?= $item->getEmail() ?></p>
                        <div class="flex">
                            Role : <p><?= $item->getRole() ?></p>
                            <form action="/index.php?c=user&a=update" method="post">
                                <input type="hidden" name="id" value="<?= $item->getId() ?>">
                                <select name="userRole" id="userRole">
                                    <option value="admin">admin</option>
                                    <option value="user">user</option>
                                </select>
                                <input type="submit" name="update">
                            </form>
                            <input type="submit" name="suppr" value="Supprimer">
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>