<?php


namespace App\Controller;


use Model\Manager\ActivityManager;
use Model\Manager\StickerManager;
use Model\Manager\UserManager;

class CategoryController extends AbstractController
{
    public function default()
    {
        $this->render('category');
    }

    /**
     * get the activities by category name
     * @param string $name
     */
    public function getCategory(string $name) {

        $category = filter_var($name, FILTER_SANITIZE_STRING);

        $activityManager = new ActivityManager();
        $stickerManager = new StickerManager();

        $activities =  $activityManager->getActivitiesByCategory($name);
        $data =  [];

        foreach ($activities as $value) {
            $data[] = [
                'activity' => $value,
               'interactions' => $stickerManager->countActivityInteractions($value->getId()),
            ];
        }

        self::render('category', $data);
    }
}