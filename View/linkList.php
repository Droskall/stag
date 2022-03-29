<div class="flex linkContainer">
<?php
foreach ($data as $value) {
?>
    <div class="white">
        <a href="<?= $value->getUrl() ?>" target="_blank">
            <div class="frame">
                <span><?= $value->getTitle() ?></span>
            </div>
        </a>
    </div>
<?php
}
?>
</div>
