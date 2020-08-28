<?php
declare(strict_types=1);

class IndexController extends ControllerBase
{

    public function initialize()
    {
        parent::initialize();
        // TODO move to RBAC
        if (!$this->session->has('auth')) {
            $this->flash->error('Please login into the application');
            // then redirect to your login page
            $this->response->redirect("login");
        }
    }
    public function indexAction()
    {

    }

}

