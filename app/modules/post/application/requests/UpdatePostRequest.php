<?php

namespace Redlite\Modules\Post\Requests;

class UpdatePostRequest
{

    private $post_id;
    private $title;
    private $description;
    private $files;

    public function __construct($post_id, $title , $description)
    {
        $this->post_id = $post_id;
        $this->title = $title;
        $this->description = $description;
        $this->files = null;
    }

    public function setFiles($files){
        $this->files = $files;
    }

    public function title(){
        return $this->title;
    }

    public function post_id(){
        return $this->post_id;
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