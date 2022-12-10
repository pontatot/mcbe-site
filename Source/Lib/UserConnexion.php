<?php

namespace App\Site\Lib;
use App\Site\Controller\ChannelManager;
use App\Site\Config\Conf;
use App\Site\HTTP\Session;
use App\Site\Model\Channel;

class UserConnexion
{

    private static ?UserConnexion $instance = null;

    private static string $connexionKey = "_utilisateurConnecte";

    private ?Channel $currentUser = null;

    private function __construct()
    {
        if (Session::getInstance()->exists(self::$connexionKey)) {
            $this->currentUser = ChannelManager::getChannel(Session::getInstance()->read(self::$connexionKey));
            if (!$this->currentUser) $this->disconnect();
        }
    }

    public static function getInstance(): UserConnexion
    {
        if (is_null(static::$instance))
            static::$instance = new UserConnexion();
        return static::$instance;
    }

    public static function paswdHash(string $pswd): string
    {
        return password_hash(hash_hmac("sha256", $pswd, Conf::getPepper()), PASSWORD_DEFAULT);
    }

    public static function paswdCheck(string $pswd, string $hash): bool
    {
        return password_verify(hash_hmac("sha256", $pswd, Conf::getPepper()), $hash);
    }

    public function connect(string $channelId): void
    {
        Session::getInstance()->save(self::$connexionKey, $channelId);
        static::$instance = new UserConnexion();
    }

    public function isConnected(): bool
    {
        return Session::getInstance()->exists(self::$connexionKey) && $this->currentUser;
    }

    public function disconnect(): bool
    {
        $this->currentUser = null;
        return Session::getInstance()->delete(self::$connexionKey);
    }

    public function getConnectedUserChannel(): ?Channel
    {
        return $this->currentUser ?? null;
    }

    public function isUser($channelId) : bool {
        return $this->isConnected() && $channelId == $this->getConnectedUserChannel()->getId();
    }
}