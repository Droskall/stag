<?php


namespace App\Controller;


use App\Color;
use Model\Entity\Activity;
use Model\Manager\ActivityManager;
use Model\Manager\StickerManager;

class ActivityController extends AbstractController
{

    public function default()
    {
        self::render('home');
    }

    /**
     * Add a new activity.
     */
    public function add(){
        if(isset($_POST["title"]) && strlen($_POST["title"]) > 45){
            echo "<div id='error'>Merci de respecter la limite du titre (45 caractères)</div>";
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
     * @param int $id
     */
    public function showActivity(int $id){
        $activityManager = new ActivityManager();

        $activity = $activityManager->getById($id);

        if ($activity === null) {
            self::default();
            exit();
        }

        $stickerManager = new StickerManager();
        $interaction = [
            'bad' => $stickerManager->countInteractionsByType('activity_id', $id, 'bad'),
            'fun' => $stickerManager->countInteractionsByType('activity_id', $id, 'fun'),
            'good' => $stickerManager->countInteractionsByType('activity_id', $id, 'good'),
            'happy' => $stickerManager->countInteractionsByType('activity_id', $id, 'happy'),
            'heart' => $stickerManager->countInteractionsByType('activity_id', $id, 'heart'),
        ];

        $userChoice = null;

        if (isset($_SESSION['user'])) {
            $userChoice = $stickerManager->hasAlreadyReacted($id, $_SESSION['user']->getId());
            $userChoice = $userChoice ? $userChoice['type'] : null;
        }

        $color = Color::getColor($activity->getCategory());

        self::render('activity', $data = [
            'activity' => $activity,
            'interaction' => $interaction,
            'userChoice' => $userChoice,
        ], $color);
    }
}