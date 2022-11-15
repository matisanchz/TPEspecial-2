<?php
require_once './app/Models/class.model.php';
require_once './app/Views/api.view.php';
require_once './app/Helpers/auth-api.helper.php';

class ClassApiController {
    private $model;
    private $view;
    private $authHelper;
    private $data;

    public function __construct() {
        $this->model = new ClassModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getClasses($params = null) {
        $arrayClass = ["id_class", "name", "author", "features"];
        $arrayCondition = ["asc", "desc"];
        $quant = $this->model->getQuantRegisters();

        if(isset($_GET['filter'])&&!empty($_GET['filter'])&&
        isset($_GET['value'])){
            if(in_array($_GET['filter'], $arrayClass)){
                $column = $arrayClass[array_search($_GET['filter'], $arrayClass)];
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
            if(in_array($_GET['orderBy'], $arrayClass)){
                $orderBy = $arrayClass[array_search($_GET['orderBy'], $arrayClass)];
            }
            else{
                $this->view->response("Resource not found", 404);
                die();
            }
        }else{
            $orderBy=$arrayClass[0];
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
            $classes = $this->model->getAll($column, $value, $orderBy, $cond, $limit, $offset);
            $this->view->response($classes);
        }
    }

    public function getClass($params = null) {
        $id = $params[':ID'];
        $class = $this->model->get($id);

        if ($class)
            $this->view->response($class);
        else 
            $this->view->response("The Class with id=$id does not exist", 404);
    }

    public function deleteClass($params = null) {
        $id = $params[':ID'];

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logeado", 401);
            return;
        }

        $class = $this->model->get($id);
        if ($class) {
            $this->model->delete($id);
            $this->view->response($class);
        } else 
            $this->view->response("The Class with id=$id does not exist", 404);
    }

    public function insertClass($params = null) {
        $class = $this->getData();

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logeado", 401);
            return;
        }

        if (empty($class->name) || empty($class->author) || empty($class->features)) {
            $this->view->response("Complete the fields and try again", 400);
        } else {
            $id = $this->model->insert($class->name, $class->author, $class->features);
            $class = $this->model->get($id);
            $this->view->response($class, 201);
        }
    }

    public function editClass($params = null) {
        $id = $params[':ID'];

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logeado", 401);
            return;
        }

        $class = $this->model->get($id);
        if ($class) {
            $newclass = $this->getData();
            if (empty($class->name) || empty($class->author) || empty($class->features)) {
                $this->view->response("Complete the fields and try again", 400);
            } else {
                //ver si existe forma de devolver el id de un update, sin tener q volver a llamar denuevo a get(id)
                $this->model->edit($newclass->name, $newclass->author, $newclass->features, $id);
                $class = $this->model->get($id);
                $this->view->response($class, 201);
            }
        }
    }

}