<?php

namespace Redlite\Modules\Subredlite\Models;
use Phalcon\Mvc\Model;

class SubRedliteModel extends Model
{

    public function initialize()
    {
        $this->setSource('subredlite');
    }

    /**
     * Id of the subredlite.
     */
    public $id;

    /**
     * Name of the subredlite.
     */
    public $name;

    /**
     * Description of the subredlite.
     */
    public $description;

    /**
     * Owner Id of the subredlite.
     */
    public $owner_id;
}

?>