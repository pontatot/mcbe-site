<?php

namespace App\Site\Controller;

use App\Site\Lib\UserConnexion;
use App\Site\Model\Comment;
use App\Site\Model\Video;
use App\Site\Model\VideoView;
use App\Site\Repository\CommentDetailedRepository;
use App\Site\Repository\CommentRepository;
use App\Site\Repository\VideoDetailedRepository;
use App\Site\Repository\VideoRepository;
use App\Site\Repository\VideoViewRepository;

/**
 *
 */
class VideoManager
{
    /**
     * @param string $title
     * @param string|null $description
     * @param int $channel
     * @param string $ext
     * @return ?Video
     */
    public static function createVideo(string $title, ?string $description, int $channel, string $ext) : ?Video {
        return UserConnexion::getInstance()->isConnected() && VideoRepository::insert(new Video(null, $title, $description, $channel, null, $ext)) ? VideoRepository::selectAll(['title'=>$title])[0] ?? null : null;
    }

    /**
     * @param int $id
     * @param string $title
     * @param string|null $description
     * @return bool
     */
    public static function updateVideo(int $id, string $title, ?string $description) : bool {
        $video = VideoRepository::select($id);
        return $video && VideoRepository::update($video->setTitle($title)->setDescription($description));
    }

    /**
     * @param int $id
     * @return bool
     */
    public static function deleteVideo(int $id) : bool {
        return VideoRepository::delete($id);
    }

    /**
     * @param int $id
     * @return Video|null
     */
    public static function getVideo(int $id) : ?Video {
        if (UserConnexion::getInstance()->isConnected()) VideoViewRepository::insert(new VideoView($id, Controller::getChannelLogged()->getId()));
        return VideoDetailedRepository::select($id);
    }

    /**
     * @return array<int, Video>
     */
    public static function getVideos() : array {
        return VideoDetailedRepository::selectAll();
    }

    public static function search(string $title) : array {
        return VideoDetailedRepository::search(['title'=>$title]);
    }

    /**
     * @param int $id
     * @return bool
     */
    public static function thumbsUp(int $id) : bool {
        return UserConnexion::getInstance()->isConnected() && VideoViewRepository::updateThumb(new VideoView($id, Controller::getChannelLogged()->getId(), true));
    }

    /**
     * @param int $id
     * @return bool
     */
    public static function thumbsDown(int $id) : bool {
        return UserConnexion::getInstance()->isConnected() && VideoViewRepository::updateThumb(new VideoView($id, Controller::getChannelLogged()->getId(), false));
    }

    /**
     * @param int $id
     * @return bool
     */
    public static function thumbsRemove(int $id) : bool {
        return UserConnexion::getInstance()->isConnected() && VideoViewRepository::updateThumb(new VideoView($id, Controller::getChannelLogged()->getId()));
    }

    /**
     * @return array<int, Comment>
     */
    public static function getComments(int $videoId) : array {
        return CommentDetailedRepository::selectAll(['videoId'=>$videoId]);
    }

    /**
     * @param int $videoId
     * @param string $content
     * @return bool
     */
    public static function comment(int $videoId, string $content) : bool {
        return UserConnexion::getInstance()->isConnected() && CommentRepository::insert(new Comment(null, $content, $videoId, Controller::getChannelLogged()->getId()));
    }

    /**
     * @param int $comment
     * @param string $content
     * @return bool
     */
    public static function editComment(int $comment, string $content) : bool {
        return CommentRepository::update(CommentRepository::select($comment)->setContent($content));
    }

    /**
     * @param int $comment
     * @return bool
     */
    public static function deleteComment(int $comment) : bool {
        return CommentRepository::delete($comment);
    }
}