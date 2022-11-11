<?php
require_once './app/Models/class.model.php';
require_once './app/Views/api.view.php';

class ClassApiController {
    private $model;
    private $view;
    private $data;

    public function __construct() {
        $this->model = new ClassModel();
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getClasses($params = null) {
        $arrayClass = ["id_class", "name", "author", "features"];
        $quant = $this->model->getQuantRegisters();

        if(isset($_GET["filter"])&&!empty($_GET["filter"])&&
        isset($_GET['value'])){
            if(in_array($_GET["filter"], $arrayClass)){
                $column = $_GET['filter'];
                $value = $_GET['value'];
            }else{
                $column= 1;
                $value = 1;
            }
        }else{
            $column= 1;
            $value = 1;
        }

        if(isset($_GET["orderBy"])&&!empty($_GET["orderBy"])){
            if(in_array($_GET["orderBy"], $arrayClass)){
                $orderBy = $_GET["orderBy"];
            }
        }else{
            $orderBy=$arrayClass[0];
        }

        if((isset($_GET['page']))&&(isset($_GET['limit'])&&!empty($_GET['limit']))){
            $page = $_GET['page'];
            $limit = $_GET['limit'];
            $offset = $page*$limit;
        }else{
            $offset = 0;
            $limit = $quant;
        }

        if(isset($_GET["orderBy"])&&!empty($_GET["orderBy"])){
            if(in_array($_GET["orderBy"], $arrayClass)){
                $orderBy = $_GET["orderBy"];
            }
        }else{
            $orderBy=$arrayClass[0];
        }
        if(isset($_GET['cond'])&&!empty($_GET['cond'])){
            if($_GET['cond']==="desc"||$_GET['cond']==="asc"){
                $cond = $_GET['cond'];
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

        // si no existe devuelvo 404
        if ($class)
            $this->view->response($class);
        else 
            $this->view->response("The Class with id=$id does not exist", 404);
    }

    public function deleteClass($params = null) {
        $id = $params[':ID'];

        $class = $this->model->get($id);
        if ($class) {
            $this->model->delete($id);
            $this->view->response($class);
        } else 
            $this->view->response("The Class with id=$id does not exist", 404);
    }

    public function insertClass($params = null) {
        $class = $this->getData();

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