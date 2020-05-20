<?php

namespace Redlite\Models;

class GeneralResponse
{
    protected $data;
    protected $message;
    protected $isError;
    protected $code;

    public function __construct($data, $message, $code = 200, $isError = null)
    {
        $this->data = $data;
        $this->message = $message;
        $this->code = $code;
        $this->isError = $isError;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data): void
    {
        $this->data = $data;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message): void
    {
        $this->message = $message;
    }

    public function isError()
    {
        return $this->isError;
    }

    public function setError($error): void
    {
        $this->isError = $error;
    }


}