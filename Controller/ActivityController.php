<?php


namespace App\Controller;


use App\Color;
use Exception;
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
                if (empty($email)) {
                    $email = null;
                }
                $phone = htmlentities($_POST['phone']);
                if (empty($phone)) {
                    $phone = null;
                }
                $schedules = htmlentities($_POST['schedules']);
                $link = htmlentities($_POST['url']);
                if (empty($link)) {
                    $link = null;
                }

                $activity = new Activity(null,$category, $type , $title, $content, $location, $email,
                    $phone, $schedules, $link, 'activity-placeholder.png');

                if(isset($_FILES['picture']) && $_FILES['picture']['error'] === 0){
                    echo '<pre>';
                    var_dump($_FILES);
                    echo '</pre>';
                    if((int)$_FILES['picture']['size'] <= (3 * 1024 * 1024)){ // maximum size = 3 mo
                        $tmp_name = $_FILES['picture']['tmp_name'];
                        $name = $this->randomName($_FILES['picture']['name']);
                        $activity->setImage($name);
                        move_uploaded_file($tmp_name, 'uploads/' . $name);
                    }
                    else{
                        $_SESSION['error'] = ["L'image sélectionnée est trop grande"];
                        header("Location: index.php?c=profile");
                        exit();
                    }
                }
                $id = $activityManager->addActivity($activity);
                header("Location: index.php?c=activity&a=show-activity&id=" . $id);
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

    /**
     * @param string $currentName
     * @return string
     */
    function randomName (string $currentName): string {
        $infos = pathinfo($currentName);
        try {
            $bytes = random_bytes(15);
        } catch (Exception $e) {
            $bytes = openssl_random_pseudo_bytes(15);
        }
        return bin2hex($bytes) . '.' . $infos['extension'];
    }
}