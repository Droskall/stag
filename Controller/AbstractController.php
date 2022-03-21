<?php

namespace App\Controller;

abstract class AbstractController
{

    abstract public function default();

    public function render(string $directoryFile) {
        ob_start();
        require __DIR__ . "/../View/" . $directoryFile . ".php";
        $page = ob_get_clean();
        require __DIR__ . "/../View/base.php";
    }

}