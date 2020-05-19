<?php
declare(strict_types=1);

namespace Redlite\Modules\Subredlite\Controllers;

use Redlite\Modules\Subredlite\Models\SubRedliteModel;
use Redlite\Modules\Subredlite\Models\Moderators;

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

        $moderator = Moderators::findFirst([
            'conditions' => 'id = :mods_id:',
            'bind'       => [
                'mods_id' => $modsId,
            ],
        ]);

        $moderator->active = 0;
        $moderator->save();

        return $this->response->redirect("/subredlite");
    }
}

