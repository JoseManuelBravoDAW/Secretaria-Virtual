<?php
require_once 'Conexion.php';

class Secretaria
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
    public static function singleton_secretaria() {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    public function subirDocumento($descripcion){
        try {

            $fichero = basename($_FILES['documento']['name']);

            $sql = "insert into documentos (idUsuario, descripcion, fichero, estado) values (:idUsuario, :descripcion, :fichero, 'Pendiente')";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(":idUsuario", $_SESSION['logeado']['idUsuario']);
            $query->bindParam(":descripcion", $descripcion);
            $query->bindParam(":fichero", $fichero);
            $query->execute();

            move_uploaded_file($_FILES['documento']['tmp_name'], "subidasUsuarios/" . $_SESSION['logeado']['Usuario'] . "/" . basename($_FILES['documento']['name']));

        } catch(PDOException $e){
            print "Error!: " . $e->getMessage();
        }
    }

    public function getDocumentos(){
        try {
            $sql = "select * from documentos where documentos.idUsuario = :idUsuario";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(":idUsuario", $_SESSION['logeado']['idUsuario']);
            $query->execute();

            return $query->fetchAll();
        } catch(PDOException $e){
            print "Error!: " . $e->getMessage();
        }
    }

    public function getDocumento($id){
        try {
            $sql = "select * from documentos where documentos.id = :id";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(":id", $id);
            $query->execute();

            return $query->fetchAll();
        } catch(PDOException $e){
            print "Error!: " . $e->getMessage();
        }
    }

    public function firmarDocumento($fila, $columna, $clave){
        try {
            $sql = "select * from clavefirma where clavefirma.idUsuario = :idUsuario and clavefirma.fila = :fila and clavefirma.columna = :columna";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(":idUsuario", $_SESSION['logeado']['idUsuario']);
            $query->bindParam(":fila", $fila);
            $query->bindParam(":columna", $columna);
            $query->execute();

            $resultado = $query->fetchAll();
            
            if($resultado[0]['clave'] == $clave){
                $fecha = date('Y-m-d H:i:s');
                
                $sql = "update documentos set documentos.estado = 'Firmado' , documentos.fechaFirma = :fecha where documentos.id = :id";
                $query = $this->dbh->prepare($sql);
                $query->bindParam(":id", $_SESSION['documentoAFirmar']);
                $query->bindParam(":fecha", $fecha);
                $query->execute();

                return true;
            }
            return false;
        } catch(PDOException $e){
            print "Error!: " . $e->getMessage();
        }
    }
}
?>