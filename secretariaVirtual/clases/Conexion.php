<?php

class Conexion  
{
    /* Variable de instancia */
    private static $instancia;

    /* Variable de conexión */
    private $dbh;

    /* Constructor */
    public function __construct(){
        try{

            $this->dbh = new PDO("mysql:host=localhost;dbname=secretaria_virtual", "usuario_secretaria", "password");
            $this->dbh->exec("SET CHARACTER SET utf8"); 

        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();
            die();
        }
    }
    
    /* Devuelve la instancia */
    public static function singleton_conexion(){
        if(!isset(self::$instancia)){
            $class = __CLASS__;
            self::$instancia = new $class;
        }
        return self::$instancia;
    }

    /* Funcion para evitar la inyeccion */
    public function prepare($sql) {
        return $this->dbh->prepare($sql);
    }

    /* Método para evitar que se pueda clonar el objeto */
    public function __clone() {
        trigger_error('La clonacion de este objeto no esta permitida!', E_USER_ERRROR);
    }
}

?>