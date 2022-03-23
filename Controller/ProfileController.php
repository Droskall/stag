<?php


namespace App\Controller;


use Model\Manager\UserManager;

class ProfileController extends AbstractController
{
    public function default()
    {
        $this->render('profile');
    }

}