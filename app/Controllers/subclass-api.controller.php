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
        $subclasses = $this->model->getAll();
        $this->view->response($subclasses);
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