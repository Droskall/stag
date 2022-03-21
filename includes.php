<?php

require __DIR__ . "/Model/Entity/Activity.php";
require __DIR__ . "/Model/Entity/User.php";

require __DIR__ . "/Model/DB.php";

require __DIR__ . "/Model/Manager/Traits/ManagerTrait.php";
require __DIR__ . "/Model/Manager/ActivityManager.php";
require __DIR__ . "/Model/Manager/UserManager.php";

require __DIR__ . "/Controller/AbstractController.php";
require __DIR__ . "/Controller/ErrorController.php";
require __DIR__ . "/Controller/HomeController.php";

require __DIR__ . "/Routeur.php";