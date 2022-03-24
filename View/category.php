<?php
$category = array_pop($data);
?>
<div>
    <button><a href="/index.php?c=category&a=get-category&name=<?= $category ?>&type=club">Clubs</a></button>
    <button><a href="/index.php?c=category&a=get-category&name=<?= $category ?>&type=event">Événements</a></button>
    <button><a href="/index.php?c=category&a=get-category&name=<?= $category ?>&type=place">Lieux</a></button>
</div>

<div class="flex content">
<?php
foreach ($data as $value) {
    $image = '/assets/img/activity-placeholder.png';

    if ($value['activity']->getImage() === null) {
        $image = $value['activity']->getImage();
    }

    ?>
    <div class="preview_container">
        <a href="/index.php?c=activity&id=<?= $value['activity']->getId() ?>">
            <div class="activity_preview white">
                <div class="flex">
                    <h2><?= $value['activity']->getName() ?></h2>
                    <span class="circle"><?= $value['interactions'] ?></span>
                </div>
                <div class="small-image" style="background-image: url(<?= $image ?>);"></div>
            </div>
        </a>
    </div>
<?php
}
?>
</div>



