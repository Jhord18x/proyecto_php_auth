
<?php 
class Conexion {
    protected static $conexion;
    public function __construct(){
        try{
            self::$conexion = new PDO(
                'mysql:charset=utf8mb4;host=localhost;port=3306;dbname=dblogin', 
                'root', '');
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conexion->setAttribute(PDO::ATTR_PERSISTENT, false);    
        }catch (PDOException $e){
            echo "No hemos podido conectar con la base de datos.";
            exit;
        }
    }
    public static function getConn(){
        if(!self::$conexion){
            new Conexion();
        }
        return self::$conexion;
    }
}
?>