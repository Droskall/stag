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
     * @param string $field
     * @param int $id
     * @param string|null $type
     * @return array
     */
    public function getStickersByAnId(string $field, int $id, string $type = null): array {
        $query = $this->db->query("SELECT * FROM " . self::TABLE . " WHERE $field = $id");

        $sortedArray = [];

        if ($query && $data = $query->fetchAll()) {
            $activityManager = new ActivityManager();
            $userManager = new UserManager();
            $stickerManager = new StickerManager();

            $array = [];

            foreach ($data as $value) {
               $array[] = self::createSticker($value, $activityManager, $userManager, $stickerManager);
            }

            foreach ($array as $value) {
                if ($value->getType() === $type) {
                    $sortedArray[] = $value;
                }
            }
        }
        return $sortedArray;
    }

    /**
     * Count every interaction on an activity
     * @param $id
     * @return mixed|null
     */
    public function countActivityInteractions($id) {
        $query = $this->db->query("SELECT count(*) FROM " . self::TABLE . " WHERE activity_id = $id");

        if ($query) {
            return $query->fetch()['count(*)'];
        }

        return null;
    }

    public function countInteractionByType() {

    }


}