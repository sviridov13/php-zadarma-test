<?php

namespace code\controllers;

use code\core\Controller;
use code\models\User;
use code\utils\Utils;

class AccountController extends Controller
{
    public function loginAction()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->view->render('Вход');
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (md5($_POST['norobot']) == $_SESSION['randomnr2']) {
                $userModel = new User();
                $data = $userModel->getUserIdAndPasswordByLogin($_POST['login']);
                if ($data['password'] === md5(md5($_POST['password']))) {
                    $hash = md5(Utils::generateCode(10));
                    if (empty($_SESSION['user_id'])) {
                        $_SESSION['user_id'] = $data['user_id'];
                        $_SESSION['hash'] = $hash;
                        $userModel->saveHash($hash);
                    } elseif ($_SESSION['user_id'] != $data['user_id']) {
                        $_SESSION['user_id'] = $data['user_id'];
                        $_SESSION['hash'] = $hash;
                        $userModel->saveHash($hash);
                    } else {
                        $errors = "Вы уже авторизованы";
                    }
                } else {
                    $errors = "Неверное имя пользователя или пароль";
                }
            } else {
                $errors = "Вы бот!";
            }
            if (count($errors) == 0) {
                $this->view->redirect('http://127.0.0.1/');
            } else {
                var_dump($errors);
            }
        }
    }

    public function registerAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->view->render('Регистрация');
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST["submit"])) {
                if (md5($_POST['norobot']) == $_SESSION['randomnr2']) {
                    $login = $_POST['login'];
                    $errors = [];
                    if (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
                        $errors[] = "Некорретный email";
                    }

                    if (!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/", $_POST['password'])) {
                        $errors[] = "Пароль может состоять только из букв английского алфавита и цифр";
                    }

                    $userModel = new User();

                    if (count($userModel->getUserLoginByLogin($login)) > 0) {
                        $errors[] = "Пользователь с таким логином уже существует";
                    }

                } else {
                    $errors[] = "Вы бот!";
                }
                if (count($errors) == 0) {
                    $userModel->save($login, $_POST['password']);
                    $this->view->redirect('http://127.0.0.1/account/login');
                } else {
                    var_dump($errors);
                }
            }

        }
    }

    static function checkLogin()
    {

    }
}