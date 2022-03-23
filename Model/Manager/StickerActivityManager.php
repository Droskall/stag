<?php

namespace Model\Manager;

use Model\Entity\Sticker;
use Model\Manager\Traits\ManagerTrait;

class StickerActivityManager
{
    use ManagerTrait;

    public const TABLE = 'sticker_activity';

    /**
     * @param array $data
     * @param ActivityManager $activityManager
     * @param UserManager $userManager
     * @param StickerManager $stickerManager
     * @return Sticker
     */
    private function createSticker(array $data, ActivityManager $activityManager, UserManager $userManager, StickerManager $stickerManager): Sticker {
        return new Sticker(
            $data['sticker_id'],
            $stickerManager->getTypeById($data['sticker_id']),
            $activityManager->getById($data['activity_id']),
            $userManager->getById($data['user_id'])
        );
    }

    /**
     * get a sticker by an id following the given $filed
     * @param string $filed
     * @param int $id
     * @return array
     */
    public function getStickersByAnId(string $filed, int $id): array
    {
        $query = $this->db->query("SELECT * FROM " . self::TABLE . " WHERE $filed = $id");

        $array = [];

        if ($query && $data = $query->fetchAll()) {
            $activityManager = new ActivityManager();
            $userManager = new UserManager();
            $stickerManager = new StickerManager();

            foreach ($data as $value) {
               $array[] = self::createSticker($value, $activityManager, $userManager, $stickerManager);
            }
        }
        return $array;
    }
}