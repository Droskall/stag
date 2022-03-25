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

    public function update(){

        $data = [];
        $userManager = new UserManager();
        $users = $userManager->getAll();
        foreach ($users as $user){
            $data[] = $user;
        }

        $userManager->modifUserRole($_POST["userRole"], $_POST["id"]);

        self::render('userList', $data);
    }
}