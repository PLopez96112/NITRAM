<?php
include_once('Config.php');

class Model extends PDO
{

    protected $conexion;

    public function __construct()
    {
        //$this->conexion = new PDO('mysql:dbname=keyboard_masher;host=127.0.0.1;port=3306', Config::$mvc_bd_usuario, Config::$mvc_bd_clave);

        $this->conexion = new PDO('mysql:host=' . Config::$mvc_bd_hostname . ';dbname=' . Config::$mvc_bd_nombre . '', Config::$mvc_bd_usuario, Config::$mvc_bd_clave);
        // Realiza el enlace con la BD en utf-8
        $this->conexion->exec("set names utf8");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function insertarUsuario($nombre,$apellidos, $correo,$tipo)
    {
        $consulta = "insert into usuarios (Correo, Nombre, Apellidos,Tipo) values (?, ?, ?,?)";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(1, $correo);
        $result->bindParam(2, $nombre);
        $result->bindParam(3, $apellidos);
        $result->bindParam(4, $tipo);
        $result->execute();
        return $result;
    }


    public function insertarGrupo($nombre)
    {
        $consulta = "insert into grupos (Nombre) values (?)";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(1, $nombre);
        $result->execute();
        return $result;
    }
    public function CompruebaUsuario($correo)
    {
        $consulta = "SELECT * FROM usuarios where Correo = '$correo'";
        $result = $this->conexion->query($consulta);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function CompruebaUsuarioID($Id)
    {
        $consulta = "SELECT * FROM usuarios where Id = '$Id'";
        $result = $this->conexion->query($consulta);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function CompruebaGrupoID($Id)
    {
        $consulta = "SELECT * FROM grupos where Id = '$Id'";
        $result = $this->conexion->query($consulta);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function Damegrupos()
    {
        $consulta = "SELECT * FROM grupos";
        $result = $this->conexion->query($consulta);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function DameUsuarios()
    {
        $consulta = "SELECT Id,Nombre,Apellidos FROM usuarios where Estado='0' and Tipo='U'";
        $result = $this->conexion->query($consulta);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function DameCU()
    {
        $consulta = "SELECT Id,Nombre,Apellidos FROM usuarios where Estado='0' and (Tipo='U' or Tipo='C')";
        $result = $this->conexion->query($consulta);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function DameEstados()
    {
        $consulta = "SELECT * FROM estados where Estado='0'";
        $result = $this->conexion->query($consulta);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function DameUsuarioId($correo)
    {
        $consulta = "SELECT Id FROM usuarios where Correo='$correo'";
        $result = $this->conexion->query($consulta);
        $x = $result->fetchAll(PDO::FETCH_ASSOC);
        return $x[0];
    }
    public function insertarToken($id_token, $id_user, $caducidad)
    {
        $consulta = "insert into tokens (Id, ID_Usuario,Caducidad) values (?,?,?)";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(1, $id_token);
        $result->bindParam(2, $id_user);
        $result->bindParam(3, $caducidad);
        $result->execute();
        return $result;
    }
    public function CompruebaToken($token)
    {
        $consulta = "SELECT * FROM tokens where Id = '$token'";
        $result = $this->conexion->query($consulta);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function CambiarPass($id_user,$Pass)
    {
        $consulta = "UPDATE usuarios set Contraseña = ? where Id = ?";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(1, $Pass);
        $result->bindParam(2, $id_user);
        $result->execute();
        return $result;
    }

    public function ModificarUsuario($id,$nombre,$apellidos, $correo,$tipo,$grupo,$estado)
    {
        $consulta = "UPDATE usuarios SET  Correo= ? , Nombre= ? , Apellidos= ? , Tipo= ?  ,Grupo= ?  ,Estado= ?   WHERE Id = ? ";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(1, $correo);
        $result->bindParam(2, $nombre);
        $result->bindParam(3, $apellidos);
        $result->bindParam(4, $tipo);
        $result->bindParam(5, $grupo);
        $result->bindParam(6, $estado);
        $result->bindParam(7, $id);
        $result->execute();
        return $result;
    }
    public function CrearTicket($Tipo,$Resumen,$Descripcion,$Estado,$FU,$FA,$Gupo,$solicitante,$prioridad)
    {
        $consulta = "insert into tickets (Tipo, Resumen,Descripcion,Estado,Prioridad,Fecha_Ultima_actualizacion,Fecha_Apertura,Grupo_resolutor,Solicitante) values (?,?,?,?,?,?,?,?,?)";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(1, $Tipo);
        $result->bindParam(2, $Resumen);
        $result->bindParam(3, $Descripcion);
        $result->bindParam(4, $Estado);
        $result->bindParam(5, $prioridad);
        $result->bindParam(6, $FU);
        $result->bindParam(7, $FA);
        $result->bindParam(8, $Gupo);
        $result->bindParam(9, $solicitante);
        $result->execute();
        return $result;
    }


}
