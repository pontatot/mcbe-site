<?php
spl_autoload_register(function ($className) {
    $path = __DIR__ . "/../Model/Repository/$className.php";
    if (is_file($path)) include_once $path;
    $path = __DIR__ . "/../Model/DataObject/$className.php";
    if (is_file($path)) include_once $path;
});
class ChannelController extends Controller
{
    public static function login(string $username, string $password) : ?Channel {
        $channel = ChannelRepository::getChannel($username);
        if (!$channel) return null;
        return static::compare_password($password, $channel->getPassword()) ? $channel : null;
    }

    public static function signup(string $username, $mail, $description, string $password) : ?Channel {
        $channel = new Channel(null, $username, $description, $mail, static::psw_hash($password));
        if(!ChannelRepository::insert($channel)) return null;
        return ChannelRepository::getChannel($username)??null;
    }

    public static function psw_hash(string $password): string
    {
        return password_hash(hash_hmac("sha256", $password, Conf::getPepper()), PASSWORD_DEFAULT);
    }

    private static function compare_password(string $password, string $hashed) : bool {
        return password_verify(hash_hmac("sha256", $password, Conf::getPepper()), $hashed);
    }

    public static function getChannel(int $id) : ?Channel {
        $channel = ChannelRepository::select($id);
        return ($channel and get_class($channel) == "Channel") ? $channel : null;
    }

}