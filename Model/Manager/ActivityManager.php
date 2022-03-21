<?php

namespace Model\Manager;

use Model\Entity\Activity;
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
        $request = $this->db->prepare("INSERT INTO activity (id, type, name, description, location, email, phone, schedules, link, image) 
            VALUES (:type, :name, :description, :location, :email, :phone, :schedules, :link, :image, :id)
            "
        );

        $request->bindValue(':type', $activity->getType());
        $request->bindValue(':name', $activity->getName());
        $request->bindValue(":description", $activity->getDescription());
        $request->bindValue(":location", $activity->getLocattion());
        $request->bindValue(":email", $activity->getEmail());
        $request->bindValue(":phone", $activity->getPhone());
        $request->bindValue(":schedules", $activity->getSchedules());
        $request->bindValue(":link", $activity->getLink());
        $request->bindValue(":image", $activity->getImage());

        return $request->execute();
    }

    /**
     * Delete activity
     * @param $id
     */
    public function supprActivity($id){
        $request = $this->db->prepare("DELETE FROM activity WHERE id = :id");
        $request->bindValue(":id", $id);
        $request->execute();
    }
}

