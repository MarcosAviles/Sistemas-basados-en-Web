<?php
class DB{
    function conectar(){
        $mysql_host = "localhost";
        $mysql_database = "dailysport";
        $mysql_user = "root";
        $mysql_password = "";
        $link=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_database);
        return $link;
    }

    function desconectar($link){
        mysqli_close($link);
    }

}

?>