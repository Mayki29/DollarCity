<?php
class UsuarioModel implements JsonSerializable
{
    private $UsuarioID;
    private $Nombres;
    private $Apellidos;
    private $Email;
    private $DNI;
    private $Direccion;
    private $NumeroTelefono;
    private $Password;
    private $TipoUsuario;

    public function getUsuarioID()
    {
        return $this->UsuarioID;
    }
    public function setUsuarioID($UsuarioID)
    {
        $this->UsuarioID = $UsuarioID;
    }
    public function getNombres()
    {
        return $this->Nombres;
    }
    public function setNombres($Nombres)
    {
        $this->Nombres = $Nombres;
    }

    public function getApellidos()
    {
        return $this->Apellidos;
    }

    public function setApellidos($Apellidos)
    {
        $this->Apellidos = $Apellidos;
    }
    public function getEmail()
    {
        return $this->Email;
    }

    public function setEmail($Email)
    {
        $this->Email = $Email;
    }
    public function getDNI()
    {
        return $this->DNI;
    }

    public function setDNI($DNI)
    {
        $this->DNI = $DNI;
    }
    public function getDireccion()
    {
        return $this->Direccion;
    }

    public function setDireccion($Direccion)
    {
        $this->Direccion = $Direccion;
    }
    public function getNumeroTelefono()
    {
        return $this->NumeroTelefono;
    }

    public function setNumeroTelefono($NumeroTelefono)
    {
        $this->NumeroTelefono = $NumeroTelefono;
    }
    public function getPassword()
    {
        return $this->Password;
    }

    public function setPassword($Password)
    {
        $this->Password = $Password;
    }
    public function getTipoUsuario()
    {
        return $this->TipoUsuario;
    }

    public function setTipoUsuario($TipoUsuario)
    {
        $this->TipoUsuario = $TipoUsuario;
    }

    public function jsonSerialize()
    {
        return [
            'usuarioId' => $this->UsuarioID,
            'nombres' => $this->Nombres,
            'apellidos' => $this->Apellidos,
            'email' => $this->Email,
            'dni' => $this->DNI,
            'direccion' => $this->Direccion,
            'numeroTelefono' => $this->NumeroTelefono
        ];
    }



    public static function getAllEmpleados()
    {
        $conn = new conexion();
        $result = $conn->getConnection()->prepare("exec SP_ListarEmpleados");
        $result->execute();

        return $result->fetchAll(PDO::FETCH_CLASS, UsuarioModel::class);
    }
    
    public function saveCliente()
    {
        $conn = new conexion();
        $query = "exec SP_CrearUsuario :nom, :ape, :email, :dni, :dir, :num, :pass, 3";
        try {
            $result = $conn->getConnection()->prepare($query);
            $result->bindValue(":nom", $this->Nombres);
            $result->bindValue(":ape", $this->Apellidos);
            $result->bindValue(":email", $this->Email);
            $result->bindValue(":dni", $this->DNI);
            $result->bindValue(":dir", $this->Direccion);
            $result->bindValue(":pass", $this->Password);
            $result->bindValue(":num", $this->NumeroTelefono);
            $result->execute();

            return "correct";
        } catch (PDOException $e) {
            return "error";
        }
    }
    public function saveEmpleado()
    {
        $conn = new conexion();
        $query = "exec SP_CrearUsuario :nom, :ape, :email, :dni, :dir, :num, '1234', 2";
        try {
            $result = $conn->getConnection()->prepare($query);
            $result->bindValue(":nom", $this->Nombres);
            $result->bindValue(":ape", $this->Apellidos);
            $result->bindValue(":email", $this->Email);
            $result->bindValue(":dni", $this->DNI);
            $result->bindValue(":dir", $this->Direccion);
            $result->bindValue(":num", $this->NumeroTelefono);
            $result->execute();

            return "correct";
        } catch (PDOException $e) {
            return "error";
        }
    }

    public function editEmpleado()
    {
        $conn = new conexion();
        $query = "exec SP_ActualizarUsuario :id, :nom, :ape, :email, :dni, :dir, :num";
        try {
            $result = $conn->getConnection()->prepare($query);
            $result->bindValue(":id", $this->UsuarioID);
            $result->bindValue(":nom", $this->Nombres);
            $result->bindValue(":ape", $this->Apellidos);
            $result->bindValue(":email", $this->Email);
            $result->bindValue(":dni", $this->DNI);
            $result->bindValue(":dir", $this->Direccion);
            $result->bindValue(":num", $this->NumeroTelefono);

            $result->execute();

            return "correct";
        } catch (PDOException $e) {
            return "error";
        }
    }

    public function deleteEmpleado()
    {
        $conn = new conexion();
        $query = "exec SP_DeshabilitarUsuario :cod";
        try {
            $result = $conn->getConnection()->prepare($query);
            $result->bindValue(":cod", $this->UsuarioID);
            $result->execute();

            return "correct";
        } catch (PDOException $e) {
            return "error";
        }
    }

    public static function loginEmpleado($email, $password)
    {
        $conn = new conexion();
        $query = "exec SP_ValidarLoginCliente :param1, :param2";
        try {
            $result = $conn->getConnection()->prepare($query);
            $result->bindValue(":param1", $email);
            $result->bindValue(":param2", $password);
            $result->execute();
            $user = $result->fetchAll(PDO::FETCH_CLASS, UsuarioModel::class);

            if(count($user) > 0){
                return $user[0];
            }else{
                return null;
            }
        } catch (PDOException $e) {
            return $e;
        }
    }
}


?>