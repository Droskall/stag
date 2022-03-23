<?php

namespace App\Controller;

abstract class AbstractController
{

    abstract public function default();

    public function render(string $directoryFile, array $data = null) {
        ob_start();
        require __DIR__ . "/../View/" . $directoryFile . ".php";
        $page = ob_get_clean();
        require __DIR__ . "/../View/base.php";
    }

    //Basic security function
    public function sanitize($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return addslashes($data);
    }
}