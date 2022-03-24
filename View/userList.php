<section id="userList" class="flex white">
    <div>
        <h2>Liste des utilisateurs</h2>
        <div class="list flex">
            <?php
            foreach ($data as $item){?>
                <div class="frame flex">
                    <img src="/assets/img/avatar.png" width="50px" alt="user logo">
                    <div>
                        <p><?= $item->getUsername() ?></p>
                        <p><?= $item->getEmail() ?></p>
                        <div class="flex">
                            <p><?= $item->getRole() ?></p>

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