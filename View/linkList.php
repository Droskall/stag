<div class="flex linkContainer">
<?php
foreach ($data as $value) {
?>
    <a href="<?= $value->getUrl() ?>" target="_blank">
        <div class="frame white" style="border-color: <?= $color ?>">
            <span><?= $value->getTitle() ?></span>
        </div>
    </a>
<?php
}
?>
</div>
