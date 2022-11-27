<?php
namespace App\Site\Controller;
use App\Site\Lib\UserConnexion;
use App\Site\Model\Channel;

class Controller {
    public static function getChannelLogged() : ?Channel {
        return UserConnexion::getInstance()->getConnectedUserChannel();
    }

    public static function loadView(string $viewPath, string $pagetitle, array $args = []) : void {
        $bodyViewPath = __DIR__ . "/../view/" . $viewPath;
        $bodyPagetitle = $pagetitle;
        extract($args);
        require __DIR__ . "/../view/view.php";
    }

    public static function redirect(string $url) {
        header("Location: $url");
        exit();
    }
}
