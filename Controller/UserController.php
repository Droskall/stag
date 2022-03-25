<?php


namespace App\Controller;

use Model\Manager\UserManager;

class UserController extends AbstractController
{
    /**
     * user list
     */
    public function default()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php');
        }
        if ($_SESSION['user']->getRole() !== 'admin') {
            header('Location: index.php');
        }

        $data = [];
        $userManager = new UserManager();
        $users = $userManager->getAll();
        foreach ($users as $user){
            $data[] = $user;
        }
        self::render('userList', $data);
    }

    public function updateRole(){

        $userManager = new UserManager();

        $userManager->modifUserRole($_POST["userRole"], $_SESSION['user']->getId());

        $data = [];
        $userManager = new UserManager();
        $users = $userManager->getAll();
        foreach ($users as $user){
            $data[] = $user;
        }

        self::render('userList', $data);
    }

}