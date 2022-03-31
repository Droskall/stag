<?php


namespace App\Controller;


use App\Color;
use App\Config;
use Model\Entity\link;
use Model\Manager\LinkManager;

class ToolboxController extends AbstractController
{
    public function default()
    {
        $this->render('toolbox', null, $color = Color::getColor('utile'));
    }

    /**
     * add a new link
     */
    public function addLink() {
        // connected ?
        if (!isset($_SESSION['user'])) {
            self::default();
            exit();
        }
        if ($_SESSION['user']->getRole() !== 'admin') {
            self::default();
            exit();
        }

        // isset ?
        if (!isset($_POST['add-link'])) {
            self::default();
            exit();
        }
        if (!isset($_POST['link-type']) ||!isset($_POST['title']) || !isset($_POST['new-url'])) {
            self::default();
            exit();
        }

        // empty ?
        if (empty($_POST['link-type']) || empty($_POST['title']) || empty($_POST['new-url'])) {
            $_SESSION['error'] = ["Tout les champs doivent être renseignés"];
            self::render('profile');
            exit();
        }

        $url = filter_var($_POST['new-url'], FILTER_SANITIZE_URL);
        $url = filter_var($url, FILTER_VALIDATE_URL);

        $title = strip_tags($_POST['title']);

        $type = $_POST['link-type'];

        // allowed link type ?
        if (!in_array($type, Config::LINK_TYPE)) {
            self::default();
            exit();
        }

        $linkManager = new LinkManager();
        $linkManager->addLink($url, $type, $title);

        $links = $linkManager->getLinkByType($type);

        $color = Color::getColor('utile');

        self::render('linkList', $data = $links, $color);
    }

    /**
     * get links by type
     * @param string $type
     */
    public function list(string $type) {

        // allowed link type ?
        if (!in_array($type, Config::LINK_TYPE)) {
            self::default();
            exit();
        }

        $color = Color::getColor('utile');

        $linkManager = new LinkManager();
        $links = $linkManager->getLinkByType($type);
        self::render('linkList', $data = $links, $color);
    }
}
