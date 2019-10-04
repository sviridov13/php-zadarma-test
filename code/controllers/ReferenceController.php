<?php


namespace code\controllers;


use code\core\Controller;
use code\core\View;
use code\models\Reference;
use code\utils\Utils;

class ReferenceController extends Controller
{
    public function indexAction()
    {
        $result = $this->model->findAll($_SESSION['user_id']);
        $vars = [
            'phones' => $result
        ];
        $this->view->render('Номера телефонов', $vars);
    }

    public function createAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uploaddir = '/var/www/html/code/uploads/';
            $uploadfile = $uploaddir . basename($_FILES['pic']['name']);
            if (move_uploaded_file($_FILES['pic']['tmp_name'], $uploadfile)) {
                $this->model->save($_POST['email'], $_POST['phone'], $_POST['first_name'], $_POST['second_name'],
                    "/code/uploads/" . basename($_FILES['pic']['name']), $_SESSION['user_id']);
            } else {
                $this->model->save($_POST['email'], $_POST['phone'], $_POST['first_name'], $_POST['second_name'], $_SESSION['user_id']);
            }
        }
    }

    public function showAction()
    {
        $phone_id = $_GET['id'];
        header('Content-Type: application/json');
        $result = $this->model->getOneById($phone_id);
        $result['phone_number_prop'] = Utils::number2string($result['phone_number']);
        echo json_encode($result);
    }

    public function deleteAction()
    {
        $phone_id = $_POST['phone_id'];
        $this->model->deleteById($phone_id);
    }

    public function updateAction()
    {
        $data = $_POST;
        if (isset($_FILES['pic'])) {
            echo "test";
            $uploaddir = '/var/www/html/code/uploads/';
            $uploadfile = $uploaddir . basename($_FILES['pic']['name']);
            if (move_uploaded_file($_FILES['pic']['tmp_name'], $uploadfile)) {
                echo "test2";
                $this->model->updateById($data['email'], $data['phone'], $data['first_name'], $data['second_name'], $data['phone_id'], "/code/uploads/" . basename($_FILES['pic']['name']));
            }
        } else {
            $this->model->updateById($data['email'], $data['phone'], $data['first_name'], $data['second_name'], $data['phone_id']);
        }
    }
}