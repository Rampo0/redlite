<?php

namespace Redlite\Modules\Post\Requests;

class CreatePostRequest
{
    private $user_id;
    private $title;
    private $description;
    private $files;

    public function __construct($user_id , $title , $description)
    {
        $this->title = $title;
        $this->user_id = $user_id;
        $this->description = $description;
        $this->files = null;
    }

    public function setFiles($files){
        $this->files = $files;
    }


    public function title(){
        return $this->title;
    }

    public function user_id(){
        return $this->user_id;
    }

    public function description(){
        return $this->description;
    }

    public function filename(){
        $filename = "";
        if($this->files){
            foreach ($this->files as $file) {
                $file->moveTo('files/' . $file->getName());
                $filename = $file->getName();   
            }
        }
        return $filename;
    }

    public function saveFile(){
        if($this->files){
            foreach ($this->files as $file) {
                $file->moveTo('files/' . $file->getName());
            }
        }
    }

}

?>