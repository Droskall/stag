<div class="flex linkContainer">
<?php
foreach ($data as $value) {
?>
    <div class="white">
        <a href="/index.php?c=activity&a=show-activity&id=<?= $value->getActivity()->getId() ?>">
            <div class="frame">
                <?= $value->getActivity()->getName() ?>
            </div>
        </a>
    </div>
<?php
}
?>
</div>
