<?php


namespace App\Controller;


use Model\Manager\UserManager;

class ProfileController extends AbstractController
{
    public function default()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php');
        }

        $this->render('profile');
    }

}