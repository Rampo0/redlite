<?php

namespace Redlite\Modules\User\Repository;

interface IUserRepository{
    public function SignUp($nickname, $email , $password, $security);
    public function Login($email , $password, $controller);
}

?>