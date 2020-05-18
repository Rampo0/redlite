<?php
declare(strict_types=1);

namespace Redlite\Modules\Post\Controllers;

use Redlite\Modules\Post\Models\Posts;
use Redlite\Modules\Post\Models\Ratings;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $posts = $this->getAllPostService->execute();
        $this->view->posts = $posts;
    }

    public function ratingAction(){
        if(!$this->security->checkToken()){
            echo "invalid csrf !!";
        }

        // $user_id = $this->getDI()->getShared("session")->get('user_id');
        $user_id = 1;

        $rating = new Ratings();
        $rating->post_id =  $this->request->getPost('post_id');
        $rating->user_id = $user_id;
        $rating->rating =  $this->request->getPost('rating');
        $rating->save();

        return $this->response->redirect('/post');
    }

    public function editAction(){
        if(!$this->security->checkToken()){
            echo "invalid csrf !!";
        }

        $post_id = $this->request->getPost('post_id');
        $post = Posts::findFirst([
            'conditions' => 'id = :post_id:',
            'bind'       => [
                'post_id' => $post_id,
            ],
        ]);

        
        if ($this->request->hasFiles() == true) {
            $file_name = "";
            foreach ($this->request->getUploadedFiles() as $file) {
                $file->moveTo('files/' . $file->getName());
                $file_name = $file->getName();   
            }
            $post->file = $file_name;
        }
       

        $post->title = $this->request->getPost('title');
        $post->description = $this->request->getPost('description');
        $post->save();

        return $this->response->redirect('/post');
    }

    public function deleteAction($post_id){
        $post = Posts::findFirst([
            'conditions' => 'id = :post_id:',
            'bind'       => [
                'post_id' => $post_id,
            ],
        ]);

        $post->delete();
        return $this->response->redirect('/post');
    }

    public function createAction(){

        if(!$this->security->checkToken()){
            echo "invalid csrf !!";
        }

        $file_name = "";
        if ($this->request->hasFiles() == true) {
            foreach ($this->request->getUploadedFiles() as $file) {
                $file->moveTo('files/' . $file->getName());
                $file_name = $file->getName();   
            }
        }
       
        try{

            $this->createPostService->execute(
                1,
                $this->request->getPost('title'),
                $this->request->getPost('description'),
                $file_name
            );
    
        }catch (\Exception $e){
            echo "something error !!";
        }

        return $this->response->redirect('/post');
    }

}

