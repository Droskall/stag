<div class="flex linkContainer">
<?php
foreach ($data as $value) {
?>
    <div class="white">
        <a href="/index.php?c=activity&a=show-activity&id=<?= $value->getActivity()->getId() ?>">
            <div class="frame">
                <span><?= $value->getActivity()->getName() ?></span>
            </div>
        </a>
    </div>
<?php
}
?>
</div>
