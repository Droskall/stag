<?php

namespace Model\Manager;

use Model\Entity\User;
use Model\Manager\Traits\ManagerTrait;

class UserManager {

    use ManagerTrait;

    /**
     * Returns a user via their id.
     * @param int $id
     * @return User
     */
    public function getById(int $id): User {
        $user = new User();
        $request = $this->db->prepare("SELECT id, username FROM user WHERE id = 'id'");
        $request->bindValue('id', $id);
        $result = $request->execute();
        if ($result) {
            $user_data = $request->fetch();
            if ($user_data) {
                $user->setId($user_data['id']);
                $user->setUsername($user_data['username']);
            }
        }
        return $user;
    }


    /**
     * Add a user in bdd
     * @param $email
     * @param $name
     * @param $pass
     * @param $role
     * @return User|string
     */
    public function insertUser($email ,$name, $pass, $role){
        $request = $this->db->prepare("SELECT username FROM user WHERE username = :name");
        $request->bindValue(':name', $name);
        if($request->execute() && $request->fetch()){
            return "Un utilisateur existe déjà avec le pseudo " . $name;
        }else{
            $user = new User();
            $user
                ->setId($this->db->lastInsertId())
                ->setEmail($email)
                ->setUsername($name)
                ->setPassword($pass)
                ->setRole('admin');

            $request = $this->db->prepare("INSERT INTO user (email, username, password, role) VALUES ( :mail ,:name, :pass, 'admin')");
            $request->bindValue(":mail", $email);
            $request->bindValue(":name", $name);
            $request->bindValue(":pass", $pass);
            $request->execute();

            return $user;
        }
    }

    /**
     * Function that selects a user if he exists in database
     * @param $name
     * @param $pass
     * @return User|string
     */
    public function getUser($name, $pass){
        $request = $this->db->prepare("SELECT * FROM user WHERE username = :name");
        $request->bindValue(":name", $name);
        if ($request->execute() && $select = $request->fetch()){
            if (password_verify($pass, $select["password"])){
                $user = new User();
                $user
                    ->setId($select["id"])
                    ->setUsername($select["username"])
                    ->setRole($select["admin"]);
                return $user;
            }
            return "Mauvais mot de passe !";
        }
        return "Mauvais pseudo !";
    }
}