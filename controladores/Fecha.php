<?php
class Fecha{
    public $anio;
    public $dia;
    public $mes;
    public $hora;
    public $minutos;
    public $segundos;
    public $milisegundos;
    public $meses = array('01','02','03','04','05','06','07','08','09','10','11','12');

    function Fecha($f){
        $this->milisegundos = strtotime($f);
        $fecha = getdate($this->milisegundos);
        $this->anio = $fecha['year'];
        $this->dia = $fecha['mday'];
        $this->mes = $fecha['mon'];
        $this->hora = $fecha['hours'];
        $this->segundos = $fecha['seconds'];
        $this->minutos = $fecha['minutes'];
    }

    function getAnio(){
        return $this->anio;
    }

    function getMes(){
        return $this->meses[$this->mes-1];
    }

    function getDia(){
        $d= $this->dia;
        if($d<10){
            $d='0'.$d;
        }
        return $d;
    }

    function getHoras(){
        $h = $this->hora;
        if($h<10){
            $h='0'.$h;
        }
        return $h;
    }

    function getMinutos(){
        $min = $this->minutos;
        if($min<10){
            $min = '0'.$min;
        }
        return $min;
    }

    function getSegundos(){
        $seg = $this->segundos;
        if($seg<10){
            $seg ='0'.$seg;
        }
        return $seg;
    }

    function getUnixTime(){
        return $this->milisegundos;
    }
}
?>