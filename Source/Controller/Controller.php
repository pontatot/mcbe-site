<?php
namespace App\Site\Controller;
use App\Site\Lib\UserConnexion;
use App\Site\Model\Channel;

class Controller {
    public static function getChannelLogged() : ?Channel {
        return UserConnexion::getInstance()->getConnectedUserChannel();
    }

    public static function loadView(string $viewPath, ?string $pagetitle = null, array $args = []) : void {
        $pagetitle = $pagetitle ?? 'TuTeube';
        $bodyViewPath = __DIR__ . "/../view/" . $viewPath;
        $bodyPagetitle = $pagetitle;
        extract($args);
        require __DIR__ . "/../view/view.php";
    }

    public static function redirect(string $url) : void {
        header("Location: $url");
        exit();
    }

    public static function error(string $error, int $code = 400, string $redirect = null) : void {
        if ($redirect) header("refresh:5; url=" . $redirect);
        Controller::loadView('error.php', 'Error', ['error'=>$error, 'code'=>$code, 'redirect'=>$redirect]);
        exit();
    }
}
