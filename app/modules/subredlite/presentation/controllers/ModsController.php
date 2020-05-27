<?php
declare(strict_types=1);

namespace Redlite\Modules\Subredlite\Controllers;

use Redlite\Modules\Subredlite\Models\Moderators;
use Redlite\Modules\Post\Models\Post;
use Redlite\Modules\Post\Models\Posts;

class ModsController extends ControllerBase
{
    
    public function indexAction()
    {
        $user_id = $this->getDI()->getShared("session")->get('user_id');
        if (!$user_id)
        {
            return $this->response->redirect("/user");
        }

        $id = $this->dispatcher->getParam('subredlite_id');
        $subRedlite = $this->getSubRedliteService->execute($id);

        $this->view->subRedlite = $subRedlite;
        $this->view->userId = $user_id;
    }

    public function deleteAction()
    {        
        $modsId = $this->dispatcher->getParam('id');
        $this->removeModAccessService->execute($modsId);

        return $this->response->redirect("/subredlite");
    }

    

    
    public function lockAction($post_id)
    {
        $user_id = $this->getDI()->getShared("session")->get('user_id');
        if (!$user_id)
        {
            return $this->response->redirect("/user");
        }

        $post = Posts::findFirst([
            'conditions' => 'id = :post_id:',
            'bind'       => [
                'post_id' => $post_id,
            ],
        ]);

        
        $mod = Moderators::findFirst([
            'subredlite_id = :subredlite_id: AND user_id = :user_id: AND active = 1',
            'bind'       => [
                'subredlite_id' => $post->subredlite_id,
                'user_id' => $user_id,
            ],
        ]);

        if ($mod)
        {
            $post->able_to_comment = 0;
            $post->save();
        }

        return $this->response->redirect('/comment/index/show/' . $post_id);
    }
}

