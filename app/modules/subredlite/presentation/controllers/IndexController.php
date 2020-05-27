<?php
declare(strict_types=1);

namespace Redlite\Modules\Subredlite\Controllers;

use Redlite\Modules\Subredlite\Models\SubRedlite;

class IndexController extends ControllerBase
{
    
    public function indexAction()
    {

        $user_id = $this->getDI()->getShared("session")->get('user_id');
        if (!$user_id)
        {
            return $this->response->redirect("/user");
        }

        $subRedlites = $this->getAllSubRedliteService->execute();
        

        $this->view->subRedlites = $subRedlites;
        $this->view->userId = $user_id;
    }

    public function createAction()
    {

        if (!$this->security->checkToken())
        {
            echo "invalid csrf !!";
        }

        $user_id = $this->getDI()->getShared("session")->get('user_id');
        if (!$user_id)
        {
            return $this->response->redirect("/user");
        }
       
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
        // $subredlite = SubRedliteModel::findFirst([
        //     'conditions' => 'id = :subredliteId:',
        //     'bind'       => [
        //         'subredliteId' => $subredliteId,
        //     ],
        // ]);

        // $subredlite->delete();

        // return $this->response->redirect('/subredlite');
    }

    public function editAction()
    {
        if (!$this->security->checkToken())
        {
            echo "invalid csrf !!";
        }

        $redliteId = $this->request->getPost('edit-subredlite-id');

        $this->updateSubRedliteService->execute(
            $redliteId,
            $this->request->getPost('edit-name'),
            $this->request->getPost('edit-description')
        );

        return $this->response->redirect('/subredlite');
    }

    public function modAction()
    {

        if (!$this->security->checkToken())
        {
            echo "invalid csrf !!";
        }
       
        try
        {
            $this->addModsService->execute(
                $this->request->getPost('edit-user-id'),
                $this->request->getPost('mod-subredlite-id')
            );
    
        }
        catch (\Exception $e)
        {
            echo "something error !!";
        }

        return $this->response->redirect('/subredlite');
    }

}

