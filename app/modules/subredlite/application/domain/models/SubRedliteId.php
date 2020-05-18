<?php

namespace Redlite\Modules\Subredlite\Models;

require_once __DIR__ . "/../../../../../../vendor/autoload.php";

use Ramsey\Uuid\Uuid;


/**
 * Generate UUID id for Subredlite.
 */
class SubRedliteId {

    private $id;

    /**
     * Construct Subredlite Id.
     * @param id, if null will use uuid4 instead.
     */
    public function __construct($id = null) {
        $this->id = $id ? : Uuid::uuid4()->toString();
    }

    /**
     * Getter function
     */
    public function id() {
        return $this->id;
    }

    /**
     * Whether this id is equals with param.
     * @param subredliteId compared id.
     */
    public function equals(SubRedliteId $subredliteId) {
        return $this->id === $subRedliteId->id;
    }

}