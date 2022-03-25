<?php


namespace App\Controller;


use Model\Entity\Activity;
use Model\Manager\ActivityManager;

class ActivityController extends AbstractController
{

    public function default()
    {
        self::render('activity');
    }

    /**
     * Add a new activity.
     */
    public function add(){
        if(isset($_POST["title"]) && strlen($_POST["title"]) > 45){
            echo "<div id='error'>Merci de respecter la limite du titre</div>";
        }
        else{
            if(isset($_POST['category-type'], $_POST['activity-type'], $_POST['title'],
            $_POST['content'], $_POST['location'], $_POST['email'], $_POST['phone'],
            $_POST['schedules'], $_POST['url'])) {

                $activityManager = new ActivityManager();

                $category = htmlentities($_POST['category-type']);
                $type = htmlentities($_POST['activity-type']);
                $title = htmlentities($_POST['title']);
                $content = htmlentities($_POST['content']);
                $location = htmlentities($_POST['location']);
                $email = htmlentities($_POST['email']);
                $phone = htmlentities($_POST['phone']);
                $schedules = htmlentities($_POST['schedules']);
                $link = htmlentities($_POST['url']);

                $activity = new Activity(null,$category, $type , $title, $content, $location, $email,
                    $phone, $schedules, $link, null);

                if(isset($_FILES['picture'])){
                    $tmp_name = $_FILES['picture']['tmp_name'];
                    $image = $_FILES['picture']['name'];
                    $activity->setImage($image);
                    move_uploaded_file($tmp_name, 'uploads/' . $image);
                }

                $activityManager->addActivity($activity);
                header("Location: index.php?c=activity");

            }
        }

        $this->render('profile');
    }

    /**
     * Displays the activity that has a certain id
     * @param $id
     */
    public function showActivity($id){
        $activityManager = new ActivityManager();

        $activity = $this->$activityManager->getById($id);
        $this->render('activity');
    }

}