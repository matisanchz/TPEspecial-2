<?php
require_once './app/Models/specie.model.php';
require_once './app/Views/api.view.php';

class SpecieApiController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new SpecieModel();
        $this->view = new ApiView();
        
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getSpecies($params = null) {
        $arrayClass = ["id_specie", "scientific_name", "author", "location", "id_subclass"];
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
            $species = $this->model->getAll($column, $value, $orderBy, $cond, $limit, $offset);
            $this->view->response($species);
        }
    }

    public function getSpecie($params = null) {
        $id = $params[':ID'];
        $specie = $this->model->get($id);

        if ($specie)
            $this->view->response($specie);
        else 
            $this->view->response("La subclase con el id=$id no existe", 404);
    }

    public function deleteSpecie($params = null) {
        $id = $params[':ID'];

        $specie = $this->model->get($id);
        if ($specie) {
            $this->model->delete($id);
            $this->view->response($specie);
        } else 
            $this->view->response("La subclase con el id=$id no existe", 404);
    }

    public function insertSpecie($params = null) {
        $specie = $this->getData();

        if (empty($specie->scientific_name) || empty($specie->author) || empty($specie->location)|| empty($specie->id_subclass)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($specie->scientific_name, $specie->author, $specie->location, $specie->id_subclass);
            $specie = $this->model->get($id);
            $this->view->response($specie, 201);
        }
    }

    public function editSpecie($params = null) {
        $id = $params[':ID'];
        $specie = $this->model->get($id);
        if ($specie) {
            $newspecie = $this->getData();
            if (empty($specie->scientific_name) || empty($specie->author) || empty($specie->location)|| empty($specie->id_subclass)) {
                $this->view->response("Complete los datos", 400);
            } else {
                //ver si existe forma de devolver el id de un update, sin tener q volver a llamar denuevo a get(id)
                $this->model->edit($newspecie->scientific_name, $newspecie->author, $newspecie->location, $newspecie->id_subclass, $id);
                $specie = $this->model->get($id);
                $this->view->response($specie, 201);
            }
        }
    }

}