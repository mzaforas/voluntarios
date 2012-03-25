<?php

use_helper('myHelper','I18N');

$i = 1;
$campos = array(
'id',
'nombre',
'primer_apellido',
'segundo_apellido',
'tipo_documento_identificativo',
'numero_documento_identificativo',
'nacionalidad',
'provincia',
'email', 
);

$cabecera = '';
foreach ($campos as $campo){
    $cabecera = $cabecera.';'.latin1(sfInflector::humanize($campo));
}
echo $cabecera."\n";

foreach ($voluntarios as $voluntario) {
  echo $i;
  foreach ($campos as $campo) {
    echo ';';
    if ($campo == 'nacionalidad') {
      echo str_replace(';','',latin1(format_country($voluntario->{'get'.sfInflector::camelize($campo)}())));
    } else {
      echo str_replace(';','',latin1($voluntario->{'get'.sfInflector::camelize($campo)}()));
    }
  }
  echo "\n";
  $i++;
  unset($voluntario);
}
