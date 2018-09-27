<?php
class GestionLogin{
    function GestionLogin(){

    }

    function setPassword($contrasenia){
        return password_hash($contrasenia, PASSWORD_DEFAULT);
    }

    function checkPassword($pass,$hash){
        if(password_verify($pass, $hash)){
            return true;
        }
        return false;
    }

    function login($link,$nick,$password){

        $query = "select * from trabajadores where email='".$nick."'";
        $consulta=mysqli_query($link,$query);

        if(mysqli_num_rows($consulta)>0){
            $usuario=mysqli_fetch_array($consulta);
            if($this->checkPassword($password,$usuario['contrasenia'])){
                return $usuario;
            }
        }
        return '1';
        
    }

    function loginUser($link,$nick,$password){

        $query = "select * from usuarios where nick='".$nick."'";
        $consulta=mysqli_query($link,$query);

        if(mysqli_num_rows($consulta)>0){
            $usuario=mysqli_fetch_array($consulta);
            if($this->checkPassword($password,$usuario['contrasenia'])){
                return $usuario;
            }
        }
        return '1';
        
    }

}

?>