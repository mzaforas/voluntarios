<?php

use_helper('myHelper');

$i = 1;
$campos = array('id','nombre','notas','bolsa','acreditable','jefe','numero_miembros','pagados','fotos','perfiles_string');

$cabecera = '';
foreach ($campos as $campo){
    $cabecera = $cabecera.';'.latin1(sfInflector::humanize($campo));
}
echo $cabecera."\n";

foreach ($equipos as $equipo) {
  echo $i;
  foreach ($campos as $campo) {
    echo ';';
    $valor = $equipo->{'get'.sfInflector::tableize($campo)}();
    if (is_bool($valor)) {
      echo  $valor ? 'Si' : 'No';
    } elseif ($valor != null) {
      echo str_replace(';','',latin1($valor));
    } 
    
  }
  echo "\n";
  $i++;
  unset($equipo);
}
