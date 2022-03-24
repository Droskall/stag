<?php


namespace App\Controller;


use Model\Manager\ActivityManager;
use Model\Manager\UserManager;

class CategoryController extends AbstractController
{
    public function default()
    {
        $this->render('category');
    }

    public function getCategory(string $name) {

        $category = filter_var($name, FILTER_SANITIZE_STRING);

        $activityManager = new ActivityManager();

        var_dump($activityManager->getByCategoryAndType('sport', 'cl'));

        //self::render('category');
    }
}