<?php

namespace Model\Manager;

use Model\Entity\Activity;
use Model\Entity\Sticker;
use Model\Manager\Traits\ManagerTrait;

class ActivityManager {

    use ManagerTrait;

    public const TABLE = 'activity';

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
     * get Activities by a type
     * @param string $type
     * @return array
     */
    public function getActivitiesByType(string $type): array {
        $query = $this->db->query("SELECT * FROM " . self::TABLE . " WHERE type = '$type'");

        $array = [];

        if ($query && $data = $query->fetchAll()) {

            foreach ($data as $value) {
                $array[] = new Activity($value["id"], $value["type"], $value['name'], $value['description'], $value['location'],
                    $value["email"], $value["phone"], $value["schedules"], $value['link'], $value['image']);
            }
        }

        return $array;
    }

    /**
     * Add an article into the database.
     * @param Activity $activity
     * @return bool
     */
    public function add(Activity $activity): bool
    {
        $request = $this->db->prepare("INSERT INTO activity (category, type, name, description, location, email, phone, schedules, link, image) 
            VALUES (:category, :type, :name, :description, :location, :email, :phone, :schedules, :link, :image)
            "
        );

        $request->bindValue(':category', $activity->getCategory());
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
     * @param $category
     * @param $type
     * @param $name
     * @param $description
     * @param $location
     * @param $email
     * @param $phone
     * @param $schedules
     * @param $link
     * @param $image
     */
    public function modifActivity($id, $category, $type, $name, $description, $location, $email, $phone, $schedules, $link, $image){
        $request = $this->db->prepare("UPDATE activity SET category = :category, type = :type, name = :name, description = :description,
                    location = :location, email = :email, phone = :phone, schedules = :schedules, link = :link,
                    image = :image 
                    WHERE id = :id"
        );
        $request->bindValue(":category", $category);
        $request->bindValue(":type", $type);
        $request->bindValue(":name", $name);
        $request->bindValue(":description", $description);
        $request->bindValue(":location", $location);
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
    public function deleteActivity($id){
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
                return new Activity($selected["id"], $selected['category'], $selected["type"], $selected['name'],
                    $selected['description'], $selected['location'], $selected["email"], $selected["phone"],
                    $selected["schedules"], $selected['link'], $selected['image']);
            }
        }

        return null;
    }
}

