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
     * @param string $type
     */
    public function getCategory(string $name, string $type = '') {

        $category = filter_var($name, FILTER_SANITIZE_STRING);

        $activityManager = new ActivityManager();
        $stickerManager = new StickerManager();

        if ($type === '') {
            $activities =  $activityManager->getActivitiesByCategory($name);
        } else {
            $activities =  $activityManager->getByCategoryAndType($name, $type);
        }

        $data = [];

        foreach ($activities as $value) {
            $data[] = [
                'activity' => $value,
                'interactions' => $stickerManager->countActivityInteractions($value->getId()),
            ];
        }
        $data += ['category' => $name];

        self::render('category', $data);
    }
}