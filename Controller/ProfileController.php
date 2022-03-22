<?php


namespace App\Controller;


class ProfileController extends AbstractController
{
    public function default()
    {
        $this->render('profile');
    }
}