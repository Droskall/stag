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


    /**
     * sanitize post values and change the mail and the username
     */
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

        $data = self::checkMailUsernamePassword();

        if (count($data['error']) > 0) {
            $_SESSION['error'] = $data['error'];
            self::userInfo();
            exit();
        }

        $mail = $data['mail'];
        $username = $data['username'];
        $password = $data['password'];

        $userManager = new UserManager();

        if ($userManager->getUser($mail) !== null && $mail !== $_SESSION['user']->getEmail()) {
            $_SESSION['error'] = ['adresse mail déjà enregistré'];
            self::userInfo();
            exit();
        }

        $user = $userManager->getUser($_SESSION['user']->getEmail());

        if (password_verify($password, $user->getPassword())) {

           $userManager->updateMailName($mail, $username, $user->getId());

            $user->setPassword('');
            $_SESSION['user'] = $user;

            self::default();

        } else {

            $_SESSION['error'] = ['Mot de passe incorrect'];
            self::default();
            exit();
        }
    }

    /**
     * sanitize post values and change the password
     */
    public function changePassword() {

        if (!isset($_SESSION['user'])) {
            header('Location: index.php');
            exit();
        }

        if (!isset($_POST['submit'])) {
            self::default();
            exit();
        }

        if (!isset($_POST['password']) || !isset($_POST['passwordRepeat']) || !isset($_POST['oldPassword'])) {
            self::default();
            exit();
        }

        $password = $_POST['password'];
        $passwordRepeat = $_POST['passwordRepeat'];
        $oldPassword = $_POST['oldPassword'];

        if (strlen($password) < 8 || strlen($password) >= 255 ) {
            $_SESSION['error'] = ["le mot de passe doit faire au moins 8 caractères"];
            self::userInfo();
            exit();
        }

        if(!preg_match('/^(?=.*[!@#$%^&*-\])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $password)) {
            $_SESSION['error'] = ["Le mot de passe n'est pas assez sécurisé"];
            self::userInfo();
            exit();
        }

        if ($password === $passwordRepeat) {

            $userManager = new UserManager();

            $user = $userManager->getUser($_SESSION['user']->getEmail());

            if (password_verify($oldPassword, $user->getPassword())) {

                $password = password_hash($password, PASSWORD_BCRYPT);

                $user = $userManager->updatePassword($password, $_SESSION['user']->getId());
                self::default();

            } else {

                $_SESSION['error'] = ['Mot de passe incorrect'];
                self::userInfo();
                exit();
            }

        } else {

            $_SESSION['error'] = ["Les mots de passe ne corespondent pas"];
            self::userInfo();
            exit();
        }
    }
}