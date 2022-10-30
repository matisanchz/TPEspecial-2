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
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getClasses($params = null) {
        $classes = $this->model->getAll();
        $this->view->response($classes);
    }

    public function getClass($params = null) {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $class = $this->model->get($id);

        // si no existe devuelvo 404
        if ($class)
            $this->view->response($class);
        else 
            $this->view->response("La clase con el id=$id no existe", 404);
    }

    public function deleteClass($params = null) {
        $id = $params[':ID'];

        $class = $this->model->get($id);
        if ($class) {
            $this->model->delete($id);
            $this->view->response($class);
        } else 
            $this->view->response("La clase con el id=$id no existe", 404);
    }

    public function insertClass($params = null) {
        $class = $this->getData();

        if (empty($class->name) || empty($class->author) || empty($class->features)) {
            $this->view->response("Complete los datos", 400);
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
                $this->view->response("Complete los datos", 400);
            } else {
                //ver si existe forma de devolver el id de un update, sin tener q volver a llamar denuevo a get(id)
                $this->model->edit($newclass->name, $newclass->author, $newclass->features, $id);
                $class = $this->model->get($id);
                $this->view->response($class, 201);
            }
        }
    }

}