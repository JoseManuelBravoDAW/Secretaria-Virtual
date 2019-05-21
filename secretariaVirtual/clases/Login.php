<?php
require_once 'Conexion.php';

class Login  
{
    private static $instancia;
    private $dbh;

    /* Contructor del Login */
    private function __construct(){
        try {
            $this->dbh = Conexion::singleton_conexion();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
    }

    /* Singleton del login */
    public static function singleton_login() {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    public function loginUsuario($usuario,$password) {
		$datosUsuario = array('Logeado'=> false);
        $encodedPassword = md5($password);

		try {
            $sql = "select * from usuario WHERE usuario.usuario = :usuario and usuario.password = :pass";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(":usuario", $usuario);
            $query->bindParam(":pass", $encodedPassword);
            $query->execute();
            $this->dbh = null;
            
            //si existe el usuario
            if ($query->rowCount() == 1) {
                $fila  = $query->fetch();
                $datosUsuario = array('Logeado'=> true, 'Nombre'=>$fila['nombre'], 'Email'=>$fila['email'], 'Usuario'=>$fila['usuario'], 'Estado'=>$fila['estado'], 'idUsuario'=>$fila['id']);
                $logueado = true;
            }
        } catch(PDOException $e){
            print "Error!: " . $e->getMessage();
        }
        
        return $datosUsuario;
    }

    public function registroUsuario($nombre, $email, $usuario, $password){
        $contraseniaEncriptada = md5($password);
        try {
            $sql = "insert into usuario (nombre, email, usuario, password) values (:nombre, :email, :usuario, :password)";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(":nombre", $nombre);
            $query->bindParam(":email", $email);
            $query->bindParam(":usuario", $usuario);
            $query->bindParam(":password", $contraseniaEncriptada);
            $query->execute();
            $this->dbh = null;

        } catch(PDOException $e){
            print "Error!: " . $e->getMessage();
        }
    }

}

?>