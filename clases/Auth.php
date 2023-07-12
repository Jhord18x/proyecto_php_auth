<?php 
    include "Conexion.php";

    class Auth extends Conexion {
        public function registrar($nombre, $dni, $email, $password) {
            $conexion = parent::getConn();             
            $buscar_user = $conexion->prepare("SELECT * FROM tblusers WHERE email = :email LIMIT 1");             
            $buscar_user->bindParam(':email', $email, PDO::PARAM_STR);             
            $buscar_user->execute();
        
            if($buscar_user->rowCount() == 1){
                echo "Este email ya está en uso! <br>";
            }else{
                $nuevo_user = $conexion->prepare("INSERT INTO tblusers (nombre, dni, email, password) VALUES(:nombre, :dni , :email, :password)");
                $nuevo_user->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $nuevo_user->bindParam(':dni', $dni, PDO::PARAM_STR);
                $nuevo_user->bindParam(':email', $email, PDO::PARAM_STR);
                $nuevo_user->bindParam(':password', $password, PDO::PARAM_STR);
                return $nuevo_user->execute();
            }
        }

        public function logear($email, $password) {
            $conexion = parent::getConn();
            $buscar_user = $conexion->prepare("SELECT * FROM tblusers WHERE email = :email LIMIT 1");     
            $buscar_user->bindParam(':email', $email, PDO::PARAM_STR);
            $buscar_user->execute();
            if($buscar_user->rowCount() == 1){
                $user = $buscar_user->fetch(PDO::FETCH_ASSOC);
                $user_email = $user['email'];
                $hash = (string) $user['password'];
                if(password_verify($password,$hash)){
                    $_SESSION['email']=$user_email;
                    $conexion = null;
                    return true;
                }else{
                    $conexion = null;
                    return false;
                }
            }else{
                $conexion = null;
                return false;
            }
        }   
    }

?>
