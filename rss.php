<?php 
include_once('controladores/Periodico.php'); 
$periodico= new Periodico();
$periodico->getRSS();
?>