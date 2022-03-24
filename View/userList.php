<section id="userList" class="flex white">
    <div>
        <h2>Liste des utilisateurs</h2>
        <div class="list flex">
            <?php
            foreach ($data as $item){?>
                <div class="frame flex">
                    <img src="/assets/img/avatar.png" width="50px" alt="user logo">
                    <div>
                        <p>Nom : <?= $item->getUsername() ?></p>
                        <p>Email : <?= $item->getEmail() ?></p>
                        <div class="flex">
                            Role : <p><?= $item->getRole() ?></p>

                            <select name="userRole" id="userRole">
                                <option value="">admin</option>
                                <option value="user">user</option>
                            </select>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>