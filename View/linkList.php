<div class="flex linkContainer">
<?php
foreach ($data as $value) {
?>
    <div class="frame white" style="border-color: <?= $color ?>">
        <a href="<?= $value->getUrl() ?>" target="_blank">
            <div class="">
                <span><?= $value->getTitle() ?></span>
            </div>
        </a>
        <div>
            <?php if($_SESSION["user"]->getRole() === "admin"){ ?>
                <a href="/index.php?c=toolbox&a=del-url&id=<?=$value->getId()?>">
                    <i class="fas fa-trash-alt"></i>
                </a>
                <a href="/index.php?c=toolbox&a=linkToUpdate&id=<?=$value->getId()?>">
                    <i class="fas fa-edit"></i>
                </a>
            <?php
            }
            ?>
        </div>
    </div>
<?php
}
?>
</div>
