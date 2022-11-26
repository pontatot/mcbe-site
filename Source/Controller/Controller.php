<?php
namespace App\Site\Controller;
use App\Site\Model\Channel;

class Controller {
    public static function getLang() : string {
        return 'EN';
    }
    public static function getChannelLogged() : Channel {
        return ChannelManager::getChannel(1);
    }
}
