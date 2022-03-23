<?php

namespace Model\Manager;

use Model\Entity\Activity;
use Model\Entity\Sticker;
use Model\Manager\Traits\ManagerTrait;

class ActivityManager {

    use ManagerTrait;

    /**
     * Return all items.
     */
    public function getAll(): array {
        $activity = [];
        $request = $this->db->prepare("SELECT * FROM activity");
        $result = $request->execute();
        if($result) {
            $data = $request->fetchAll();
            foreach ($data as $activity) {
                $activity[] = new Activity($activity['type'], $activity['name'], $activity['description'],
                $activity['location'], $activity['email'], $activity['phone'], $activity['schedules'],
                $activity['link'], $activity['image'], $activity['id']
                );
            }
        }
        return $activity;
    }

    /**
     * Add an article into the database.
     * @param Activity $activity
     * @return bool
     */
    public function add(Activity $activity): bool
    {
        $request = $this->db->prepare("INSERT INTO activity (id, type, name, descirption, location, mail, phone, schedules, link, image) 
            VALUES (:type, :name, :description, :location, :email, :phone, :schedules, :link, :image, :id)
            "
        );

        $request->bindValue(':type', $activity->getType());
        $request->bindValue(':name', $activity->getName());
        $request->bindValue(":description", $activity->getDescription());
        $request->bindValue(":location", $activity->getLocation());
        $request->bindValue(":email", $activity->getEmail());
        $request->bindValue(":phone", $activity->getPhone());
        $request->bindValue(":schedules", $activity->getSchedules());
        $request->bindValue(":link", $activity->getLink());
        $request->bindValue(":image", $activity->getImage());

        return $request->execute();
    }

    /**
     * Modify an activity
     * @param $id
     * @param $type
     * @param $name
     * @param $description
     * @param $locattion
     * @param $email
     * @param $phone
     * @param $schedules
     * @param $link
     * @param $image
     */
    public function modifActivity($id, $type, $name, $description, $locattion, $email, $phone, $schedules, $link, $image){
        $request = $this->db->prepare("UPDATE activity SET type = :type, name = :name, descirption = :description,
                    location = :location, mail = :email, phone = :phone, schedules = :schedules, link = :link,
                    image = :image 
                    WHERE id = :id"
        );
        $request->bindValue(":type", $type);
        $request->bindValue(":name", $name);
        $request->bindValue(":description", $description);
        $request->bindValue(":location", $locattion);
        $request->bindValue(":email", $email);
        $request->bindValue(":phone", $phone);
        $request->bindValue(":schedules", $schedules);
        $request->bindValue(":link", $link);
        $request->bindValue(":image", $image);
        $request->bindValue(":id", $id);
        $request->execute();
    }

    /**
     * Delete activity
     * @param $id
     */
    public function deletActivity($id){
        $request = $this->db->prepare("DELETE FROM activity WHERE id = :id");
        $request->bindValue(":id", $id);
        $request->execute();
    }

    /**
     * Get article by id
     * @param $id
     * @return Activity|null
     */
    public function getById($id): ?Activity
    {
        $request = $this->db->prepare("SELECT * FROM activity WHERE id = :id");
        $request->bindValue(":id", $id);
        if($request->execute()){
            if($selected = $request->fetch()){
                return new Activity($selected["id"], $selected["type"], $selected['name'], $selected['location'],
                $selected["email"], $selected["phone"], $selected["schedules"], $selected['link'], $selected['image']);
            }
        }

        return null;
    }

    /**
     * Get sticker by activity id
     * @param $id
     * @return array
     */

    public function getSicker($id): array
    {
        $request = $this->db->prepare("SELECT sodavesnois.sticker.id, sodavesnois.sticker.type FROM
                                     sticker_activity as a
                                     INNER JOIN sticker s ON a.sticker_id = s.id
                                     WHERE a.activity_id = :id"
        )
        ;
        $request->bindValue(":id", $id);
        if ($request->execute()){
            $stickers = [];
            $activityManager = new ActivityManager();
            $userManager = new UserManager();
            foreach ($request->fetchAll() as $selected){
                $sticker = new Sticker();
                $sticker
                    ->setId($selected["id"])
                    ->setType($selected["type"])
                    ->setActivity($activityManager->getById("activity_id"))
                    ->setUser($userManager->getById("user_id"));
                $stickers[] = $sticker;
            }
            return $stickers;
        }
    }

    /**
     * Add a sticker to a selected activity
     * @param int $idUser
     * @param int $idActivity
     * @param string $type
     */
    public function addSticker(int $idUser, int $idActivity, string $type){
        $request = $this->db->prepare("INSERT INTO sticker (type) VALUES (:type)");
        $request->bindValue(":content", $type);
        $request->execute();
        $id = $this->db->lastInsertId();

        $request = $this->db->prepare("INSERT INTO sticker_activity (activity_id, sticker_id, user_id) 
                                VALUES (:activity_id, :sticker_id, :user_id)"
        )
        ;
        $request->bindValue(":activity_id", $idActivity);
        $request->bindValue(":sticker_id", $id);
        $request->bindValue(":user_id", $idUser);
        $request->execute();
    }
}

