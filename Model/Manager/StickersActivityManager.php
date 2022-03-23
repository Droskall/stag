<?php

namespace Model\Manager;

use Model\Entity\Activity;
use Model\Entity\Sticker;
use Model\Manager\Traits\ManagerTrait;

class StickersActivityManager
{
    use ManagerTrait;

    public const TABLE = 'sticker_activity';

    /**
     * @param array $data
     * @param $activityManager
     * @param $userManager
     */
    private function createSticker(array $data, $activityManager, $userManager) {
        $sticker = new Sticker(
            $data['id'],
            $data['type'],
            $activityManager->getById($data['activity_id']),
            $userManager->getById($data['user_id'])
        );
    }

    /**
     * get a sticker by an id following the given $filed
     * @param $filed
     * @param $id
     * @return null
     */
    public function getStickersByAnId($filed, $id) {
        $query = $this->db->query("SELECT * FROM " . self::TABLE . " WHERE $filed = $id");

        if ($query && $data = $query->fetchAll()) {
            $activityManager = new ActivityManager();
            $userManager = new UserManager();

            foreach ($data as $value) {
                self::createSticker($value, $activityManager, $userManager);
            }
        }

        return null;
    }
}