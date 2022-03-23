<?php


namespace App\Controller;


use Model\Manager\UserManager;

class CategoryController extends AbstractController
{
    public function default()
    {
        $this->render('category');
    }
}