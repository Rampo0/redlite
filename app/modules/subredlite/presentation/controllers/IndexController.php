<?php
declare(strict_types=1);

namespace Redlite\Modules\Subredlite\Controllers;

use Redlite\Modules\Subredlite\Models\SubRedliteModel;

class IndexController extends ControllerBase
{
    
    public function indexAction()
    {
        $subRedlites = $this->getAllSubRedliteService->execute();

        $this->view->subRedlites = $subRedlites;
        $this->view->userId = 1;
    }

    public function createAction()
    {

        if (!$this->security->checkToken())
        {
            echo "invalid csrf !!";
        }

        $user_id = 1;
       
        try
        {
            $this->createSubRedliteService->execute(
                $this->request->getPost('name'),
                $this->request->getPost('description'),
                $user_id
            );
    
        }
        catch (\Exception $e)
        {
            echo "something error !!";
        }

        return $this->response->redirect('/subredlite');
    }

    public function deleteAction($subredliteId)
    {
        $subredlite = SubRedliteModel::findFirst([
            'conditions' => 'id = :subredliteId:',
            'bind'       => [
                'subredliteId' => $subredliteId,
            ],
        ]);

        $subredlite->delete();

        return $this->response->redirect('/subredlite');
    }

}

