<?php
require_once './app/Models/user.model.php';
require_once './app/Views/api.view.php';
require_once "./app/Helpers/auth-api.helper.php";

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

class AuthApiController {
    private $model;
    private $view;
    private $authHelper;
    private $data;
    private $key;

    public function __construct() {
        $this->model = new UserModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();
        $this->key = "web2-tp2";
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getToken($params = null) {
        // Obtener "Basic base64(user:pass)
        $basic = $this->authHelper->getAuthHeader();
        
        if(empty($basic)){
            $this->view->response('Not authorized', 401);
            return;
        }
        $basic = explode(" ",$basic); // ["Basic" "base64(user:pass)"]
        if($basic[0]!="Basic"){
            $this->view->response('The authentication must be Basic', 401);
            return;
        }

        //validar usuario:contraseña
        $userpass = base64_decode($basic[1]); // user:pass
        $userpass = explode(":", $userpass);
        $username = $userpass[0];
        $pass = $userpass[1];
        $user = $this->model->getUser($username);
        //verifico si existe
        if($user && password_verify($pass, $user->password)){
            //  crear un token
            $header = array(
                'alg' => 'HS256',
                'typ' => 'JWT'
            );
            $payload = array(
                'id' => 1,
                'name' => $user,
                'exp' => time()+3600
            );
            $header = base64url_encode(json_encode($header));
            $payload = base64url_encode(json_encode($payload));
            $signature = hash_hmac('SHA256', "$header.$payload", $this->key, true);
            $signature = base64url_encode($signature);
            $token = "$header.$payload.$signature";
             $this->view->response($token);
        }else{
            $this->view->response('Incorrect user and password', 401);
        }
    }
}


