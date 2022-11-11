<?php
require_once './app/Models/subclass.model.php';
require_once './app/Views/api.view.php';

class SubclassApiController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new SubclassModel();
        $this->view = new ApiView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getSubclasses($params = null) {
        $arrayClass = ["id_subclass", "name", "author", "id_class"];
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
            $subclasses = $this->model->getAll($column, $value, $orderBy, $cond, $limit, $offset);
            $this->view->response($subclasses);
        }
 
    }

    public function getSubclass($params = null) {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $subclass = $this->model->get($id);

        // si no existe devuelvo 404
        if ($subclass)
            $this->view->response($subclass);
        else 
            $this->view->response("La subclase con el id=$id no existe", 404);
    }

    public function deleteSubclass($params = null) {
        $id = $params[':ID'];

        $subclass = $this->model->get($id);
        if ($subclass) {
            $this->model->delete($id);
            $this->view->response($subclass);
        } else 
            $this->view->response("La subclase con el id=$id no existe", 404);
    }

    public function insertSubclass($params = null) {
        $subclass = $this->getData();

        if (empty($subclass->name) || empty($subclass->author) || empty($subclass->id_class)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($subclass->name, $subclass->author, $subclass->id_class);
            $subclass = $this->model->get($id);
            $this->view->response($subclass, 201);
        }
    }

    public function editSubclass($params = null) {
        $id = $params[':ID'];
        $subclass = $this->model->get($id);
        if ($subclass) {
            $newsubclass = $this->getData();
            if (empty($subclass->name) || empty($subclass->author) || empty($subclass->id_class)) {
                $this->view->response("Complete los datos", 400);
            } else {
                //ver si existe forma de devolver el id de un update, sin tener q volver a llamar denuevo a get(id)
                $this->model->edit($newsubclass->name, $newsubclass->author, $newsubclass->id_class, $id);
                $subclass = $this->model->get($id);
                $this->view->response($subclass, 201);
            }
        }
    }

}