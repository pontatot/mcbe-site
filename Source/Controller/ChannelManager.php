<?php

namespace App\Site\Controller;

use App\Site\Lib\UserConnexion;
use App\Site\Model\Channel;
use App\Site\Model\Subscription;
use App\Site\Repository\ChannelDetailedRepository;
use App\Site\Repository\ChannelRepository;
use App\Site\Repository\SubscriptionRepository;
use App\Site\Repository\VideoDetailedRepository;

class ChannelManager
{
    public static function createChannel(string $name, ?string $description, string $email, string $password) : bool {
        return ChannelRepository::insert(new Channel(null, $name, $description, $email, $password));
    }

    public static function updateChannel(Channel $channel) : bool {
        return ChannelRepository::update($channel);
    }

    public static function login(string $name, string $password) : bool {
        $channel = ChannelRepository::selectAll(['name'=>$name]);
        if(count($channel) == 1 && UserConnexion::paswdCheck($password, $channel[0]->getPassword())) {
            UserConnexion::getInstance()->connect($channel[0]->getId());
            return true;
        }
        return false;
    }

    public static function deleteChannel(int $id) : bool {
        return ChannelRepository::delete($id);
    }

    public static function getChannel(int|string $id) : ?Channel {
        return ChannelDetailedRepository::select($id);
    }

    public static function getChannels() : array {
        return ChannelRepository::selectAll();
    }

    public static function search(string $name) : array {
        return ChannelRepository::search(['name'=>$name]);
    }

    public static function getChannelVideos(int $id) : array {
        return VideoDetailedRepository::selectAll(['channelId'=>$id]);
    }

    public static function searchChannelVideos(int $id, string $title) : array {
        return VideoDetailedRepository::search(['channelId'=>$id, 'title'=>$title]);
    }

    public static function isSubbed(int $id) : bool {
        return !empty(SubscriptionRepository::selectAll(['channelId'=>Controller::getChannelLogged()->getId(), 'subscribeId'=>$id]));
    }

    public static function subscribe(int $id) : bool {
        return $id != Controller::getChannelLogged()->getId() && SubscriptionRepository::insert(new Subscription(Controller::getChannelLogged()->getId(), $id));
    }

    public static function unsubscribe(int $id) : bool {
        return SubscriptionRepository::deleteElement(new Subscription(Controller::getChannelLogged()->getId(), $id));
    }
}