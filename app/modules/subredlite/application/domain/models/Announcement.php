<?php

namespace Redlite\Modules\Subredlite\Models;

use Redlite\Modules\Post\Models\PostId;

class Announcement
{

    private $id;
    private $title;
    private $description;
    private $file;
    private $user_id;
    private $totalRating = 0;
    private $rating = [];
    private $created_at;
    private $isRatedByYou = false;
    private $able_to_comment = 1;
    private $is_announcement = 1;

    public function __construct(PostId $id, $user_id, $title, $description , $file)
    {
        $this->title = $title;
        $this->description = $description;
        $this->file = $file;
        $this->user_id = $user_id;
        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }

    public function totalRating()
    {
        return $totalRating;
    }

    public function averageRating()
    {
        $total = 0;
        foreach ($this->rating as $rate) {
            $total+=$rate->rating;
        }
        
        if(count($this->rating) > 0){
            return $total/count($this->rating);
        }
        
        return 0;
    }

    public function description()
    {
        return $this->description;
    }

    public function title()
    {
        return $this->title;
    }

    public function user_id()
    {
        return $this->user_id;
    }

    public function created_at()
    {
        return $this->created_at;
    }

    public function file()
    {
        return $this->file;
    }

    public function appendRating($rate)
    {
        array_push($this->rating , $rate);
    } 

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function setIsRated($isRated)
    {
        $this->isRatedByYou = $isRated;
    }

    public function is_rated()
    {
        return $this->isRatedByYou;
    }

    public function isAbleToComment()
    {
        return $this->able_to_comment;
    }

    public function setCommentLocked($status)
    {
        $this->able_to_comment = $status;
    }

    public static function createAnnouncement($user_id , $title , $description , $file){
        return new Announcement(new PostId(), $user_id, $title , $description , $file);
    }
}


?>