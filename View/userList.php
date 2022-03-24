<section id="userList" class="flex white">
    <div>
        <h2>Liste des utilisateurs</h2>
        <div class="content">
            <ul>
                <?php
                foreach ($data as $item){?>
                    <li>
                        <?= $item->getUsername() ?>
                    </li>
                <?php
                }
                ?>
            </ul>

        </div>
    </div>
</section>