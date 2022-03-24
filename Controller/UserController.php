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
        $data = [];
        $userManager = new UserManager();
        $users = $userManager->getAll();
        foreach ($users as $user){
            $data[] = $user;
        }
        self::render('userList', $data);
    }

}