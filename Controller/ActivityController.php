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
            if($activity = $this->checkData($_POST['category-type'], $_POST['activity-type'], $_POST['title'],
                $_POST['content'], $_POST['location'], $_POST['email'], $_POST['phone'],
                $_POST['schedules'], $_POST['url'], 'profile')){

                $activityManager = new ActivityManager();

                if(isset($_FILES['picture']) && $_FILES['picture']['error'] === 0){
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

        return self::randomChars() . '.' . $infos['extension'];
    }

    /**
     * delete activity
     * @param int $id
     * @param $pg
     */
    public function delAct (int $id, string $pg){
        $activityManager = new ActivityManager();
        $activityManager->deleteActivity($id);
        header('Location: /index.php?c=category&a=get-category&name=' . $pg . '&type');
    }

    /**
     * update activity with new data
     * @param int $id
     */
    public function upAct (int $id){
        if(isset($_POST["title"]) && strlen($_POST["title"]) > 45){
            echo "<div id='error'>Merci de respecter la limite du titre (45 caractères)</div>";
        }
        else {
            if($activity = $this->checkData($_POST['category-type'], $_POST['activity-type'], $_POST['title'],
                $_POST['content'], $_POST['location'], $_POST['email'], $_POST['phone'],
                $_POST['schedules'], $_POST['url'], 'activity&a=actToUpdate&id=' . $id)){

                $activityManager = new ActivityManager();

                if(isset($_FILES['picture']) && $_FILES['picture']['error'] === 0){
                    if((int)$_FILES['picture']['size'] <= (3 * 1024 * 1024)){ // maximum size = 3 mo
                        $tmp_name = $_FILES['picture']['tmp_name'];
                        $activity->setImage($img);
                        move_uploaded_file($tmp_name, 'uploads/' . $img);
                    }
                    else{
                        $_SESSION['error'] = ["L'image sélectionnée est trop grande"];
                        header("Location: index.php?c=activity&a=actToUpdate&id=" . $id);
                        exit();
                    }
                }

                $id = $activityManager->updateActivity($activity, $id);
                header("Location: index.php?c=activity&a=show-activity&id=" . $id);
            }
        }
    }

    /**
     * @param $category
     * @param $activity
     * @param $title
     * @param $content
     * @param $location
     * @param $email
     * @param $phone
     * @param $schedules
     * @param $url
     * @param $redirect
     * @return Activity|null
     */
    private function checkData($category, $activity, $title, $content, $location, $email, $phone, $schedules, $url, $redirect){
        if(isset($category, $activity, $title, $content, $location, $email, $schedules, $url)){

            if (strlen($title) < 1 || strlen($content) < 1 || strlen($location) < 1 || strlen($schedules) < 1) {
                $_SESSION['error'] = ["Veuillez renseigner tous les champs requis"];
                header('Location: /index.php?c=' . $redirect);
                exit();
            }

            $category = htmlentities($category);
            $type = htmlentities($activity);
            $title = htmlentities($title);
            $content = htmlentities($content);
            $location = htmlentities($location);

            $email = empty($email) ? null : htmlentities($email);
            $phone = empty($phone) ? null : htmlentities($phone);
            $link = empty($url) ? null : htmlentities($url);

            return new Activity(null,$category, $type , $title, $content, $location, $email,
                $phone, $schedules, $link, 'activity-placeholder.png');
        }
        return null;
    }

    /**
     * display form of activity to update
     * @param int $id
     */
    public function actToUpdate (int $id) {
        $activityManager = new ActivityManager();
        $this->render('updateActivity', $data =
            ['activity' => $activityManager->getById($id)]
        );
    }

}