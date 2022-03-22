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
     * @return User
     */
    public function insertUser($email ,$name, $pass): User {

        $request = $this->db->prepare("INSERT INTO user (email, username, password, role) VALUES ( :mail ,:name, :pass ,'user')");
        $request->bindValue(":mail", $email);
        $request->bindValue(":name", $name);
        $request->bindValue(":pass", $pass);
        $request->execute();

        $user = new User();
        return $user
            ->setId($this->db->lastInsertId())
            ->setEmail($email)
            ->setUsername($name)
            ->setPassword($pass)
            ->setRole('user');
    }

    /**
     * Function that selects a user if he exists in database
     * @param $email
     * @return User
     */
    public function getUser($email): ?User{
        $request = $this->db->prepare("SELECT * FROM user WHERE email = :email");
        $request->bindValue(":email", $email);

        if ($request->execute() && $select = $request->fetch()){
                $user = new User();
            return $user
                    ->setId($select["id"])
                    ->setEmail($select["email"])
                    ->setUsername($select["username"])
                    ->setPassword($select['password'])
                    ->setAvatar($select["avatar"])
                    ->setRole($select["role"]);
        }
        return null;
    }

    /**
     * Return all available users.
     * @return array
     */
    public function getAll(): array
    {
        $users = [];
        $result = $this->db->query("SELECT * FROM user");

        if($result) {
            foreach ($result->fetchAll() as $data) {
                $users[] = (new UserManager)->getUser($data, $data);
            }
        }
        return $users;
    }

}