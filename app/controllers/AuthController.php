<?php

use Phalcon\Http\Request;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Form;

class AuthController extends ControllerBase
{

    /**
     * Login action
     */
    public function loginAction()
    {
        if ($this->session->has('auth')) {
            $this->response->redirect("/");
        }

        $request = new Request();
        $form = new LoginForm();

        if (true === $request->isPost() && $this->security->checkToken() ) {
            if($form->isValid($request->getPost())) {
                /** @var Users $user */
                $user = Users::findFirst([
                    'driver_license = ?0',
                    'bind' => [$form->get('driver_license')->getValue()],
                ]);

                if($user && $this->security->checkHash($form->get('password'), $user->password)) {
                    $this->session->set('auth',
                        ['userId' => $user->id]
                    );
                    $this->session->set('user',$user);
                    $this->flash->success("Welcome back " . $user->getFullName());
                    $this->response->redirect("/");
                } else {
                    $this->flash->error("The credentials you supplied were not correct.");
                }
            }
        }
        $this->view->setVar("form", $form);
    }

    /**
     * Logout action
     */
    public function logoutAction()
    {
        $request = new Request();

        if (true === $request->isPost() && $this->session->has('auth') && $this->security->checkToken() ) {
            $this->session->destroy();
            $this->flash->success("You are logged out");
        }
        $this->response->redirect("/login");
    }

    /**
     * Register action
     */
    public function signupAction()
    {
        if ($this->session->has('auth')) {
            $this->response->redirect("/");
        }

        $request = new Request();
        $form = new SignupForm();

        // POST
        if (true === $request->isPost() && $this->security->checkToken() ) {
            $user = new Users();
            $form->bind($request->getPost(), $user);
            if($form->isValid()) {
                $user->password = $this->security->hash($form->get('password'));
                $user->save();
                $this->flash->success("Registered. You can login now.");
                $this->response->redirect("login");
            }
        }
        $this->view->setVar("form", $form);
    }
}