<?php

namespace App\Controller;

use Exception;

abstract class AbstractController
{

    abstract public function default();

    public function render(string $directoryFile, array $data = null, string $color = null) {
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

    public function randomChars() {
        try {
            $bytes = random_bytes(15);
        } catch (Exception $e) {
            $bytes = openssl_random_pseudo_bytes(15);
        }
        return bin2hex($bytes);
    }
}