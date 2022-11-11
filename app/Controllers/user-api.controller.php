<?php
// require_once './app/Models/user.model.php';
require_once './app/Views/api.view.php';
require_once "./app/Helpers/auth-api.helper.php";

class UserApiController{

    private $model;
    private $view;
    private $authHelper;

    function __construct(){
        $this->model = new UserModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();
    }

    function getToken($params = null) {
        $userpass = $this->authHelper->getBasic();
        // Obtengo el usuario de la base de datos
        // $user = $this->model->getUser($email);
        $user = array("user"=>$userpass["user"]);
    
        // Si el usuario existe y las contraseñas coinciden
        if (true/*$user && password_verify($password, $user->password)*/) {
            $token = $this->authHelper->createToken($user);
            
            // devolver un token
            $this->view->response(["token"=>$token], 200);
        
        }else{
            $this->view->response("Usuario y contraseña incorrectos", 401);
        }
    }

    function obtenerUsuario($params = null){
        // users/:ID
        $id = $params[":ID"];
        $user = $this->authHelper->getUser();
        if($user)
            if($id == $user->sub){
                $this->view->response($user, 200);
            }else{
                $this->view->response("Forbidden", 403);
            }
        else{
            $this->view->response("Unauthorized", 401);
        }
    }
}


