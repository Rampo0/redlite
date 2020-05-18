<?php
declare(strict_types=1);

namespace Redlite\Modules\Subredlite\Controllers;

use Redlite\Modules\Subredlite\Models\SubRedliteModel;

class IndexController extends ControllerBase
{
    public function indexAction() {
        $subRedlites = $this->getAllSubRedliteService->execute();
        $this->view->subRedlites = $subRedlites;
    }
}

