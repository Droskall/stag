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

        $this->render('profile', $data = ['avatar' => $_SESSION['user']->getAvatar()]);
    }

    /**
     * go to the sticker list
     * @param string $type
     */
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

    /**
     * go to avatar list
     */
    public function avatarList() {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php');
            exit();
        }
        self::render('avatarList', $data = Config::AVATAR_LIST);
    }

    /**
     * Change avatar
     * @param int $key
     */
    public function changeAvatar(int $key) {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php');
            exit();
        }

        if (!key_exists($key, Config::AVATAR_LIST)) {
            header('Location: index.php');
            exit();
        }

        $userManager = new UserManager();
        $userManager->updateAvatar(Config::AVATAR_LIST[$key], $_SESSION['user']->getId());

        $_SESSION['user']->setAvatar(Config::AVATAR_LIST[$key]);

        self::default();
    }
}