<?php


namespace App\Controller;


use App\Config;
use Model\Manager\UserManager;

class ConnectionController extends AbstractController
{
    public function default()
    {
        $this->render('connection');
    }

    /**
     * register a new user
     */
    public function register()
    {
        if (!isset($_POST['submit'])) {
            self::default();
            exit();
        }

        if (!isset($_POST['email']) || !isset($_POST['username']) || !isset($_POST['password'])) {
            self::default();
            exit();
        }

        $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $password = $_POST['password'];
        $error = [];

        if (strlen($mail) < 8 || strlen($mail) >= 100) {
            $error[] = "l'adresse email doit faire entre 8 et 150 caractères";
        }

        if (strlen($username) < 5 || strlen($username) >= 100) {
            $error[] = "le pseudo doit faire entre 8 et 100 caractères";
        }

        if (strlen($password) < 8 || strlen($password) >= 255) {
            $error[] = "le mot de passe doit faire au moins 8 caractères";
        }

        if (count($error) > 0) {
            $_SESSION['error'] = $error;
            self::default();
            exit();
        }

        $userManager = new UserManager();

        if ($userManager->getUser($mail) !== null) {
            $_SESSION['error'] = ['adresse mail déjà enregistré'];
            self::default();
            exit();
        }

        if (!preg_match('/^(?=.*[!@#$%^&*-\])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $password)) {
            $_SESSION['error'] = ["Le mot de passe n'est pas assez sécurisé"];
            self::default();
            exit();
        }

        if ($password === $_POST['passwordRepeat']) {

            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $token = self::randomChars();

            $user = $userManager->insertUser($mail, $username, $password, password_hash($token, PASSWORD_BCRYPT));

            if (self::registerMail($mail, $token, $username, $user->getId())) {
                self::render('connection', $data = ["Un email à été envoyé a l'adresse email renseignée,
                veuillez confirmer cette adresse afin de vous connecter à votre compte"]);
            } else {
                self::render('connection', $data = ["Une erreur c'est produite"]);
            }

        } else {
            $_SESSION['error'] = ["Les mot de passe ne corespondent pas"];
            self::default();
            exit();
        }
    }

    /**
     * Connect a user
     */
    public function connect()
    {
        if (!isset($_POST['submit'])) {
            self::default();
            exit();
        }

        if (!isset($_POST['email'], $_POST['password'])) {
            self::default();
            exit();
        }

        $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $error = [];

        if (strlen($mail) < 8 || strlen($mail) >= 100) {
            $error[] = "l'adresse email doit faire entre 8 et 150 caractères";
        }

        $userManager = new UserManager();
        $user = $userManager->getUser($mail);

        if ($user === null) {
            $error[] = "L'utilisateur demandé n'est pas enregistré";
        }

        if ($user->getRole() === 'none') {
            $error[] = "Cette adresse mail n'a pas été vérifiée";
        }

        if (count($error) > 0) {
            $_SESSION['error'] = $error;
            self::default();
            exit();
        }

        if (password_verify($_POST['password'], $user->getPassword())) {

            $user->setPassword('');
            $_SESSION['user'] = $user;

            self::render('home');

        } else {

            $_SESSION['error'] = ['Adresse mail ou mot de passe incorrect'];
            self::default();
            exit();
        }
    }

    public function logout()
    {

        // We destroy the variables of our session.
        session_unset();
        // We destroy our session.
        session_destroy();

        self::render('home');
    }

    private function registerMail(string $userMail, $token, $username, $id)
    {

        $url = Config::APP_URL . '/index.php?c=connection&a=activate&id=' . $id . '&token=' . $token;

        $message = "
        <html lang='fr'>
            <head>
                <title>Vérification de votre compte So D'Avesnois</title>
            </head>
            <body>
                <span>Bonjour $username,</span>
                <p>
                    Afin de finaliser votre inscription sur le site So D'Avesnois, 
                    <br>
                    merci de cliquer <a href=\"$url\">sur ce lien</a> pour vérifier votre adresse email.
                </p>
            </body>
        </html>
        ";

        $to = $userMail;
        $subject = 'Vérification de votre adresse email';
        $headers = [
            'Reply-to' => "no-reply@email.com",
            'X-Mailer' => 'PHP/' . phpversion(),
            'Mime-version' => '1.0',
            'Content-type' => 'text/html; charset=utf-8'
        ];

        return mail($to, $subject, $message, $headers, "-f no-reply@email.com");
    }

    /**
     * go to activate-account
     */
    public function activate(int $id)
    {
        $userManager = new UserManager();
        $user = $userManager->getById($id);

        if ($user->getRole() !== 'none'){
            self::render('home');
        }

        $userManager->modifUserRole('user', $id);
        self::render('activate');
    }

}

// if (user_id = role !== none){
//          redirect index : avec message votre compte à déjà été validé
//}
//
// elseif{ (check $token_url = $token_db)
//          compte actif (role = user) ? => $data = User
//          $data->setPassword = ""
//          $_SESSION['user] = User
//          redirect active-account
//        est-ce qu'on modifie le token ?
//}
//
// else {
//    $data = une erreur est survenue
//    redirect active-account
//}

