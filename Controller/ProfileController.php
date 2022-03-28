<?php


namespace App\Controller;


use App\Config;
use Model\Manager\StickerManager;
use Model\Manager\UserManager;

class ProfileController extends AbstractController
{
    public function default()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php');
            exit();
        }

        $this->render('profile');
    }


    public function stickerList(string $type) {

        if (!isset($_SESSION['user'])) {
            header('Location: index.php');
            exit();
        }

        $type = strip_tags($type);

        if (!in_array($type, Config::STICKER_TYPE)) {
            self::default();
            exit();
        }

        $stickerManager = new StickerManager();
        $data = $stickerManager->getStickersByAnId('user_id', $_SESSION['user']->getId(), $type);

        self::render('stickerList', $data);
    }
}