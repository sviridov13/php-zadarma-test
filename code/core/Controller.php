<?php

namespace code\core;

use code\core\View;
use code\models\User;

abstract class Controller
{

    public $route;
    public $view;
    public $acl;

    public function __construct($route)
    {
        $this->route = $route;
        if (!$this->checkAcl()) {
            View::errorCode(401);
        }
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($name)
    {
        $path = 'code\models\\' . ucfirst($name);
        if (class_exists($path)) {
            return new $path;
        }
    }

    public function checkAcl()
    {
        $this->acl = require 'code/acl/' . $this->route['controller'] . '.php';
        if ($this->isAcl('all')) {
            return true;
        } elseif ($this->isAcl('authorize')) {
            $user = new User();
            if (isset($_SESSION['hash']) && count($user->getUserByHash($_SESSION['hash'])) > 0) {
                return true;
            }
        }
        return false;
    }

    public function isAcl($key)
    {
        return in_array($this->route['action'], $this->acl[$key]);
    }
}