<?php
require_once 'Conexion.php';

class Admin  
{
    private static $instancia;
    private $dbh;

    /* Contructor del Admin */
    private function __construct(){
        try {
            $this->dbh = Conexion::singleton_conexion();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
    }

    /* Singleton del Admin */
    public static function singleton_admin() {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    public function getUsuariosAValidar(){
        try {
            $sql = "select * from usuario where usuario.estado = 'bloqueado'";
            $query = $this->dbh->prepare($sql);
            $query->execute();

            return $query->fetchAll();
        } catch(PDOException $e){
            print "Error!: " . $e->getMessage();
        }
    }

    public function getUsuariosValidados(){
        try {
            $sql = "select * from usuario where usuario.estado = 'activo' and usuario.usuario != 'admin'";
            $query = $this->dbh->prepare($sql);
            $query->execute();

            return $query->fetchAll();
        } catch(PDOException $e){
            print "Error!: " . $e->getMessage();
        }
    }

    public function validarUsuarios($usuarios){
        try {
            foreach ($usuarios as $key) {
                
                $sql = "update usuario set usuario.estado = 'activo' where usuario.usuario = :usuario";
                $query = $this->dbh->prepare($sql);
                $query->bindParam(":usuario", $key);
                $query->execute();

                if(!file_exists('subidasUsuarios/' . $key)){
                    mkdir('subidasUsuarios/' . $key);
                }

                //obtenemos el id de usuario
                $sql = "select usuario.id from usuario where usuario.usuario = :usuario";
                $query = $this->dbh->prepare($sql);
                $query->bindParam(":usuario", $key);
                $query->execute();

                $idUsuario = $query->fetch();

                //generamos numero aleatorio y lo introducimos en la tabla
                for ($i=0; $i < 8; $i++) { 
                    for ($j=1; $j < 9; $j++) { 
                        $numero = rand(100,999);

                        switch ($i) {
                            case 0:
                                $letra = 'a';
                                break;
                            case 1:
                                $letra = 'b';
                                break;
                            case 2:
                                $letra = 'c';
                                break;
                            case 3:
                                $letra = 'd';
                                break;
                            case 4:
                                $letra = 'e';
                                break;
                            case 5:
                                $letra = 'f';
                                break;
                            case 6:
                                $letra = 'g';
                                break;
                            case 7:
                                $letra = 'h';
                                break;
                        }

                        $sql = "insert into clavefirma (idUsuario, fila, columna, clave) values (:idUsuario, :fila, :columna, :clave)";
                        $query = $this->dbh->prepare($sql);
                        $query->bindParam(":idUsuario", $idUsuario['id']);
                        $query->bindParam(":fila", $letra);
                        $query->bindParam(":columna", $j);
                        $query->bindParam(":clave", $numero);
                        $query->execute();
                    }
                }
            }

            
        } catch(PDOException $e){
            print "Error!: " . $e->getMessage();
        }
    }

    public function generarClaves($usuarios){
        try {
            foreach ($usuarios as $key) {

                //obtenemos las claves del usuario
                $sql = "select * from clavefirma where clavefirma.idUsuario = :idUsuario";
                $query = $this->dbh->prepare($sql);
                $query->bindParam(":idUsuario", $key);
                $query->execute();
                $clavesUsuario = $query->fetchAll();
                
                //obtenemos informacion del usuario
                $sql = "select * from usuario where usuario.id = :idUsuario";
                $query = $this->dbh->prepare($sql);
                $query->bindParam(":idUsuario", $key);
                $query->execute();
                $infoUsuario = $query->fetchAll();

                //generamos el archivo con las claves
                $ruta = "clavesUsuarios/claves_" . $infoUsuario[0]['usuario'] . ".txt";
                $contenido = "  _______               _                      \n";
                $contenido .= " |__   __|             | |                     \n";
                $contenido .= "    | |_   _ ___    ___| | __ ___   _____  ___ \n";
                $contenido .= "    | | | | / __|  / __| |/ _\` \ \ / / _ \/ __|\n";
                $contenido .= "    | | |_| \__ \ | (__| | (_| |\ V /  __/\__ \ \n";
                $contenido .= "    |_|\__,_|___/  \___|_|\__,_| \_/ \___||___/\n";
                $contenido .= "                                               \n";
                $contenido .= "                                               \n";
                $contenido .= "     |  1  |  2  |  3  |  4  |  5  |  6  |  7  |  8  |\n";
                $contenido .= "-----|-----|-----|-----|-----|-----|-----|-----|-----|\n";
                $contenido .= "  a  | " . $clavesUsuario[0]['clave'] . " | " . $clavesUsuario[1]['clave'] . " | " . $clavesUsuario[2]['clave'] . " | " . $clavesUsuario[3]['clave'] . " | " . $clavesUsuario[4]['clave'] . " | " . $clavesUsuario[5]['clave'] . " | " . $clavesUsuario[6]['clave'] . " | " . $clavesUsuario[7]['clave'] . " |\n";
                $contenido .= "-----|-----|-----|-----|-----|-----|-----|-----|-----|\n";
                $contenido .= "  b  | " . $clavesUsuario[8]['clave'] . " | " . $clavesUsuario[9]['clave'] . " | " . $clavesUsuario[10]['clave'] . " | " . $clavesUsuario[11]['clave'] . " | " . $clavesUsuario[12]['clave'] . " | " . $clavesUsuario[13]['clave'] . " | " . $clavesUsuario[14]['clave'] . " | " . $clavesUsuario[15]['clave'] . " |\n";
                $contenido .= "-----|-----|-----|-----|-----|-----|-----|-----|-----|\n";
                $contenido .= "  c  | " . $clavesUsuario[16]['clave'] . " | " . $clavesUsuario[17]['clave'] . " | " . $clavesUsuario[18]['clave'] . " | " . $clavesUsuario[19]['clave'] . " | " . $clavesUsuario[20]['clave'] . " | " . $clavesUsuario[21]['clave'] . " | " . $clavesUsuario[22]['clave'] . " | " . $clavesUsuario[23]['clave'] . " |\n";
                $contenido .= "-----|-----|-----|-----|-----|-----|-----|-----|-----|\n";
                $contenido .= "  d  | " . $clavesUsuario[24]['clave'] . " | " . $clavesUsuario[25]['clave'] . " | " . $clavesUsuario[26]['clave'] . " | " . $clavesUsuario[27]['clave'] . " | " . $clavesUsuario[28]['clave'] . " | " . $clavesUsuario[29]['clave'] . " | " . $clavesUsuario[30]['clave'] . " | " . $clavesUsuario[31]['clave'] . " |\n";
                $contenido .= "-----|-----|-----|-----|-----|-----|-----|-----|-----|\n";
                $contenido .= "  e  | " . $clavesUsuario[32]['clave'] . " | " . $clavesUsuario[33]['clave'] . " | " . $clavesUsuario[34]['clave'] . " | " . $clavesUsuario[35]['clave'] . " | " . $clavesUsuario[36]['clave'] . " | " . $clavesUsuario[37]['clave'] . " | " . $clavesUsuario[38]['clave'] . " | " . $clavesUsuario[39]['clave'] . " |\n";
                $contenido .= "-----|-----|-----|-----|-----|-----|-----|-----|-----|\n";
                $contenido .= "  f  | " . $clavesUsuario[40]['clave'] . " | " . $clavesUsuario[41]['clave'] . " | " . $clavesUsuario[42]['clave'] . " | " . $clavesUsuario[43]['clave'] . " | " . $clavesUsuario[44]['clave'] . " | " . $clavesUsuario[45]['clave'] . " | " . $clavesUsuario[46]['clave'] . " | " . $clavesUsuario[47]['clave'] . " |\n";
                $contenido .= "-----|-----|-----|-----|-----|-----|-----|-----|-----|\n";
                $contenido .= "  g  | " . $clavesUsuario[48]['clave'] . " | " . $clavesUsuario[49]['clave'] . " | " . $clavesUsuario[50]['clave'] . " | " . $clavesUsuario[51]['clave'] . " | " . $clavesUsuario[52]['clave'] . " | " . $clavesUsuario[53]['clave'] . " | " . $clavesUsuario[54]['clave'] . " | " . $clavesUsuario[55]['clave'] . " |\n";
                $contenido .= "-----|-----|-----|-----|-----|-----|-----|-----|-----|\n";
                $contenido .= "  h  | " . $clavesUsuario[56]['clave'] . " | " . $clavesUsuario[57]['clave'] . " | " . $clavesUsuario[58]['clave'] . " | " . $clavesUsuario[59]['clave'] . " | " . $clavesUsuario[60]['clave'] . " | " . $clavesUsuario[61]['clave'] . " | " . $clavesUsuario[62]['clave'] . " | " . $clavesUsuario[63]['clave'] . " |\n";
                $contenido .= "-----|-----|-----|-----|-----|-----|-----|-----|-----|\n";
                file_put_contents($ruta, $contenido);
            }

        } catch(PDOException $e){
            print "Error!: " . $e->getMessage();
        }
    }
}

?>