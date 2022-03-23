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
    public function addActivity($form){
        if(isset($form["title"]) && strlen($form["title"]) > 45){
            echo "<div id='error'>Merci de respecter la limite du titre</div>";
        }else{
            if(isset($form['content'], $form['user'])) {

                $activityManager = new ActivityManager();

                $content = htmlentities($form['content']);
                $title = htmlentities($form['title']);

                $activity = new Activity($content, $title);
                $this->$activityManager->add($activity);
                header("Location: index.php?controller=articles");

            }
        }

        $this->render('profile');
    }


    /**
     * Displays the article that has a certain id
     * @param $id
     */
    public function showArticle($id){
        $activityManager = new ActivityManager();

        $activity = $this->$activityManager->getById($id);
        $this->render('article');
    }

}