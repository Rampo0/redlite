<?php

namespace Redlite\Modules\Post\Responses;

use Redlite\Models\GeneralResponse;

class CreatePostResponse extends GeneralResponse
{
   
    public function __construct($data, $message, $code = 200, $error = null)
    {
        parent::__construct($data, $message, $code, $error);
    }

}