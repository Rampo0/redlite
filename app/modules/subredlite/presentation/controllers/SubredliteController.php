<?php
declare(strict_types=1);

namespace Redlite\Modules\Subredlite\Controllers;

use Redlite\Modules\Subredlite\Models\SubRedliteModel;

class SubredliteController extends ControllerBase
{
    
    public function indexAction()
    {
        $id = $this->dispatcher->getParam('subredlite_id');
        $subRedlite = $this->getSubRedliteService->execute($id);

        $this->view->subRedlite = $subRedlite;
        $this->view->userId = 1;
    }
}

