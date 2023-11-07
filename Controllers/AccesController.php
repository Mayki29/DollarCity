<?php
//include(__DIR__."/../Models/UsuarioModel.php");
//include(__DIR__."/../includes/conexion.php");
class AccesController extends conexion
{


    public function login()
    {
        view("acces.login");
    }
    public function registro(){
        view("acces.registro");
    }


    public function registrarCliente(){
        $data = json_decode(file_get_contents('php://input'));
        $cliente = new UsuarioModel();
        $cliente->setNombres($data->Nombres);
        $cliente->setApellidos($data->Apellidos);
        $cliente->setEmail($data->Email);
        $cliente->setPassword($data->Password);
        $cliente->setNumeroTelefono($data->NumeroTelefono);
        $resultado = $cliente->saveCliente();
        echo $resultado;
    }
    public function validarUsuario()
    {

        $data = json_decode(file_get_contents('php://input'));
        $email = $data->usuario;
        $password = $data->password;
        $user = UsuarioModel::loginEmpleado($email, $password);
        if ($user != null) {
            session_start();
            $_SESSION['user'] = $user;
            echo "correct";
        } else {
            echo "fail";
        }
    }

    function logout()
    {
        session_start();
        session_destroy();
        echo 'hecho';
    }

    /*private function conn(){
        $conn = new conexion();
        return $conn->getConnection();
    }*/
}
