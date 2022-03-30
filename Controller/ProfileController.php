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

    /**
     * go to user-info
     */
    public function userInfo() {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php');
            exit();
        }
        self::render('user-info', $data = ['user' => $_SESSION['user']]);
    }


    public function changeMailName() {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php');
            exit();
        }

        if (!isset($_POST['submit'])) {
            self::default();
            exit();
        }

        if (!isset($_POST['email']) || !isset($_POST['username']) || !isset($_POST['password'])) {
            self::default();
            exit();
        }

        $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $error = [];

        if (strlen($mail) < 8 || strlen($mail) >= 100) {
            $error[] = "l'adresse email doit faire entre 8 et 150 caractères";
        }

        if (strlen($username) < 5 || strlen($username) >= 100) {
            $error[] = "le pseudo doit faire entre 8 et 100 caractères";
        }

        if (count($error) > 0) {
            $_SESSION['error'] = $error;
            self::default();
            exit();
        }

        $userManager = new UserManager();

        if ($userManager->getUser($mail) !== null && $mail !== $_SESSION['user']->getEmail()) {
            $_SESSION['error'] = ['adresse mail déjà enregistré'];
            self::default();
            exit();
        }

        $user = $userManager->getUser($_SESSION['user']->getEmail());

        if (password_verify($_POST['password'], $user->getPassword())) {

           $userManager->updateMailName($mail, $username, $user->getId());

            $user->setPassword('');
            $_SESSION['user'] = $user;

            self::render('home');

        } else {

            $_SESSION['error'] = ['Mot de passe incorrect'];
            self::default();
            exit();
        }
    }
}