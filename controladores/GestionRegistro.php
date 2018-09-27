<?php
class GestionRegistro{
    function GestionRegistro(){

    }

    function setPassword($contrasenia){
        return password_hash($contrasenia, PASSWORD_DEFAULT);
    }

    function insertar_usuario($link,$datos){
        $query = "insert into usuarios(nombre,apellidos,fechaN,nick,contrasenia,email)
                  values('".$datos['nombre']."','".$datos['apellidos']."','".$datos['fnac']."',
                  '".$datos['nick']."','".$datos['rpass']."','".$datos['email']."')";
        if(mysqli_query($link,$query)){
            return true;
        }else{
            return false;
        }
    }

    function registrar($link,$usuario){
        $contrasenia_f = $this->setPassword($usuario['rpass']);
        $usuario['rpass']=$contrasenia_f;
        if($this->insertar_usuario($link,$usuario)){
            return 1;
        }
        return 0;
    }
}
?>