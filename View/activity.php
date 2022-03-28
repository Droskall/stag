<?php
$activity = $data['activity'];
$interaction = $data['interaction'];
$userChoice = $data['userChoice'];
$emojis = array_keys($interaction);
?>

<div id="activity" class="white">
    <article class="flex" style="border-color: <?= $color ?>;">
            <!--    activity image    -->
        <div class="big-image" style="background-image: url('/uploads/<?= $activity->getImage() ?>')"></div>
        <div id="description" class="flex">
            <div id="top-activity">
                <!--   activity title    -->
                <h2><?= $activity->getName() ?></h2>
                <div id="all-reaction" class="flex">
                    <?php
                        foreach ($interaction as $key => $value) {
                            if ($value !== '0') {
                        ?>
                            <div>
                                <span><?= $value ?></span>
                                <img src="/assets/img/emojis/<?= $key ?>_colored.PNG" alt="<?= $key ?>">
                            </div>
                        <?php
                            }
                        }
                    ?>
                </div>
            </div>
            <div id="content-activity" class="flex">
                <p>lieu : <?= $activity->getLocation() ?></p>
                <p>horaires : <?= $activity->getSchedules() ?></p>
                <p><?= $activity->getDescription() ?></p>
                <?php
                // may be null
                if ($activity->getLink() !== null) {
                    ?>
                    <a href="<?= $activity->getLink() ?>"><?= $activity->getLink() ?></a>
                    <?php
                }
                if ($activity->getEmail() !== null) {
                    ?>
                    <address>Email : <?= $activity->getEmail() ?></address>
                    <?php
                }
                if ($activity->getPhone() !== null) {
                    ?>
                    <address>Téléphone : <?= $activity->getPhone() ?></address>
                    <?php
                }
                ?>
            </div>

            <div class="user-reaction flex"><!--   user choice    -->
                <?php
                if (isset($_SESSION['user'])) {
                    foreach ($emojis as $value) {
                        if ($userChoice === null) {
                        ?>
                            <a href="/index.php?c=sticker&a=add&id=<?= $activity->getId() ?>&type=<?= $value ?>">
                                <img src="/assets/img/emojis/<?= $value ?>_white.PNG" alt="<?= $value ?>">
                            </a>

                        <?php
                        } else {
                            if ($value === $userChoice) {
                            ?>
                                <a href="/index.php?c=sticker&a=delete&id=<?= $activity->getId() ?>">
                                    <img src="/assets/img/emojis/<?= $value ?>_colored.PNG" alt="<?= $value ?>">
                                </a>
                            <?php
                            } else {
                            ?>
                                <a href="/index.php?c=sticker&a=update&id=<?= $activity->getId() ?>&type=<?= $value ?>">
                                    <img src="/assets/img/emojis/<?= $value ?>_white.PNG" alt="<?= $value ?>">
                                </a>
                            <?php
                            }
                        }
                    }
                }
                ?>
            </div>
        </div>
    </article>
</div>
