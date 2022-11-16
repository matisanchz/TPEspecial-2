<?php
require_once './app/Models/subclass.model.php';
require_once './app/Views/api.view.php';
require_once './app/Helpers/auth-api.helper.php';

class SubclassApiController {
    private $model;
    private $view;
    private $authHelper;
    private $data;

    public function __construct() {
        $this->model = new SubclassModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getSubclasses($params = null) {
        $arraySubclass = ["id_subclass", "name", "author", "id_class"];
        $arrayCondition = ["asc", "desc"];
        $quant = $this->model->getQuantRegisters();

        if(isset($_GET['filter'])&&!empty($_GET['filter'])&&
        isset($_GET['value'])){
            if(in_array($_GET['filter'], $arraySubclass)){
                $column = $arraySubclass[array_search($_GET['filter'], $arraySubclass)];
                $value = $_GET['value'];
            }else{
                $this->view->response("Resource not found", 404);
                die();
            }
        }else{
            $column= 1;
            $value = 1;
        }

        if(isset($_GET['orderBy'])&&!empty($_GET['orderBy'])){
            if(in_array($_GET['orderBy'], $arraySubclass)){
                $orderBy = $arraySubclass[array_search($_GET['orderBy'], $arraySubclass)];
            }
            else{
                $this->view->response("Resource not found", 404);
                die();
            }
        }else{
            $orderBy=$arraySubclass[0];
        }

        if((isset($_GET['page']))&&(isset($_GET['limit'])&&!empty($_GET['limit']))){
            if(is_numeric($_GET['page'])&&is_numeric($_GET['limit'])){
                $page = $_GET['page'];
                $limit = $_GET['limit'];
                $offset = $page*$limit;
            }else{
                $this->view->response("Resource not found", 404);
                die();
            }
        }else{
            $offset = 0;
            $limit = $quant;
        }

        if(isset($_GET['cond'])&&!empty($_GET['cond'])){
            if($_GET['cond']==="desc"||$_GET['cond']==="asc"){
                $cond = $arrayCondition[array_search($_GET['cond'], $arrayCondition)];
            }else{
                $this->view->response("Resource not found", 404);
                die();
            }
        }else{
            $cond="asc";
        }

        if($quant<=$offset){
            $this->view->response("You exceed the limit of items", 400);
        }else{
            $subclasses = $this->model->getAll($column, $value, $orderBy, $cond, $limit, $offset);
            $this->view->response($subclasses);
        }
 
    }

    public function getSubclass($params = null) {
        $id = $params[':ID'];
        $subclass = $this->model->get($id);

        if ($subclass)
            $this->view->response($subclass);
        else 
            $this->view->response("The subclass with id=$id doesn´t exist", 404);
    }

    public function deleteSubclass($params = null) {
        $id = $params[':ID'];

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("You are not logged", 401);
            return;
        }

        $subclass = $this->model->get($id);
        if ($subclass) {
            $this->model->delete($id);
            $this->view->response($subclass);
        } else 
            $this->view->response("The subclass with id=$id doesn´t exist", 404);
    }

    public function insertSubclass($params = null) {
        $subclass = $this->getData();

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("You are not logged", 401);
            return;
        }

        if (empty($subclass->name) || empty($subclass->author) || empty($subclass->id_class)) {
            $this->view->response("Complete the fields and try again", 400);
        } else {
            $id = $this->model->insert($subclass->name, $subclass->author, $subclass->id_class);
            $subclass = $this->model->get($id);
            $this->view->response($subclass, 201);
        }
    }

    public function editSubclass($params = null) {
        $id = $params[':ID'];

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("You are not logged", 401);
            return;
        }

        $subclass = $this->model->get($id);
        if ($subclass) {
            $newsubclass = $this->getData();
            if (empty($subclass->name) || empty($subclass->author) || empty($subclass->id_class)) {
                $this->view->response("Complete the fields and try again", 400);
            } else {
                $this->model->edit($newsubclass->name, $newsubclass->author, $newsubclass->id_class, $id);
                $subclass = $this->model->get($id);
                $this->view->response($subclass, 201);
            }
        }
    }

}