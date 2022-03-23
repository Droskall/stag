<?php

namespace Model\Manager;

use Model\Manager\Traits\ManagerTrait;

class StickerManager
{
    use ManagerTrait;

    public const TABLE = 'sticker';

    public function getTypeById($id) {
        $query = $this->db->query("SELECT type FROM " . self::TABLE . " WHERE id = $id");

        if ($query && $data = $query->fetch()) {
            return $data['type'];
        }
        return null;
    }
}