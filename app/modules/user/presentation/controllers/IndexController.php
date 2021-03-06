<?php
declare(strict_types=1);

namespace Redlite\Modules\User\Controllers;

use Redlite\Modules\User\Forms\LoginForm;
use Redlite\Modules\User\Forms\RegisterForm;


class IndexController extends ControllerBase
{

    public function indexAction(){
        $login_form = new LoginForm();
        
        $this->view->loginForm = $login_form;
        
        $sessions = $this->getDI()->getShared("session");

        if ($sessions->has("user_id")) {
            return $this->response->redirect("/post");
        }
    }

    public function signupAction(){
        $register_form = new RegisterForm();
        $this->view->regForm = $register_form; 

        $sessions = $this->getDI()->getShared("session");

        if ($sessions->has("user_id")) {
            return $this->response->redirect("/post");
        }
        
    }

    public function registerAction(){
        $register_form = new RegisterForm();

        if(!$this->security->checkToken()){
            echo "invalid csrf !!";
        }

        if($register_form->isValid($this->request->getPost())){
            try{
                $this->registerService->execute(
                    $this->request->getPost('nickname'),
                    $this->request->getPost('email'),
                    $this->request->getPost('password'),
                    $this->security
                );
            }catch (\RegisterFailedException $e){
                echo "Register Failed";
            }
            
            return $this->response->redirect('/user');
        }else{
            return $this->response->redirect('/user');
        }

    }

    public function loginAction(){
        $login_form = new LoginForm();
        if(!$this->security->checkToken()){
            echo "invalid csrf !!";
        }

        if($login_form->isValid($this->request->getPost())){
                
            $user = $this->loginService->execute(
                $this->request->getPost('email'), 
                $this->request->getPost('password'),
                $this
            );
            
            if($user){
                return $this->response->redirect('/post');
            }else{
                return $this->response->redirect('/user');    
            }

        }else{
            return $this->response->redirect('/user');
        }

    }

    public function logoutAction(){

        $sessions = $this->getDI()->getShared("session");
        $sessions->remove("user_id");

        return $this->response->redirect('/user');
        
    }

}

