<?php
require_once './app/Models/specie.model.php';
require_once './app/Views/api.view.php';
require_once './app/Helpers/auth-api.helper.php';

class SpecieApiController {
    private $model;
    private $view;
    private $authHelper;
    private $data;

    public function __construct() {
        $this->model = new SpecieModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getSpecies($params = null) {
        $arraySpecie = ["id_specie", "scientific_name", "author", "location", "id_subclass"];
        $arrayCondition = ["asc", "desc"];
        $quant = $this->model->getQuantRegisters();

        if(isset($_GET['filter'])&&!empty($_GET['filter'])&&
        isset($_GET['value'])){
            if(in_array($_GET['filter'], $arraySpecie)){
                $column = $arraySpecie[array_search($_GET['filter'], $arraySpecie)];
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
            if(in_array($_GET['orderBy'], $arraySpecie)){
                $orderBy = $arraySpecie[array_search($_GET['orderBy'], $arraySpecie)];
            }
            else{
                $this->view->response("Resource not found", 404);
                die();
            }
        }else{
            $orderBy=$arraySpecie[0];
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
            $this->view->response("The specie with id=$id doesn´t exist", 404);
    }

    public function deleteSpecie($params = null) {
        $id = $params[':ID'];

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("You are not logged", 401);
            return;
        }

        $specie = $this->model->get($id);
        if ($specie) {
            $this->model->delete($id);
            $this->view->response($specie);
        } else 
            $this->view->response("The specie with id=$id doesn´t exist", 404);
    }

    public function insertSpecie($params = null) {
        $specie = $this->getData();

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("You are not logged", 401);
            return;
        }

        if (empty($specie->scientific_name) || empty($specie->author) || empty($specie->location)|| empty($specie->id_subclass)) {
            $this->view->response("Complete the fields and try again", 400);
        } else {
            $id = $this->model->insert($specie->scientific_name, $specie->author, $specie->location, $specie->id_subclass);
            $specie = $this->model->get($id);
            $this->view->response($specie, 201);
        }
    }

    public function editSpecie($params = null) {
        $id = $params[':ID'];

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("You are not logged", 401);
            return;
        }

        $specie = $this->model->get($id);
        if ($specie) {
            $newspecie = $this->getData();
            if (empty($specie->scientific_name) || empty($specie->author) || empty($specie->location)|| empty($specie->id_subclass)) {
                $this->view->response("Complete the fields and try again", 400);
            } else {
                $this->model->edit($newspecie->scientific_name, $newspecie->author, $newspecie->location, $newspecie->id_subclass, $id);
                $specie = $this->model->get($id);
                $this->view->response($specie, 201);
            }
        }
    }

}