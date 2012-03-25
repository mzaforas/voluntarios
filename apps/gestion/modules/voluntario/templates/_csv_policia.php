<?php

use_helper('myHelper','I18N');

$i = 1;
$campos = array(
'primer_apellido',
'segundo_apellido',
'nombre',
'fecha_nacimiento',
'numero_documento_identificativo',
'nacionalidad',
'area',
'email', 
'telefono_movil', 
);

$cabecera = '';
foreach ($campos as $campo){
    $cabecera = $cabecera.';'.latin1(sfInflector::humanize($campo));
}
echo $cabecera."\n";

foreach ($voluntarios as $voluntario) {
  $voluntario->setRevisadoPolicia(true);
  $voluntario->save();
  echo $i;
  foreach ($campos as $campo) {
    echo ';';
    if ($campo == 'area') {
      echo 'Orden';
    } elseif ($campo == 'nacionalidad') {
      echo str_replace(';','',latin1(format_country($voluntario->{'get'.sfInflector::camelize($campo)}())));
    } else {
      echo str_replace(';','',latin1($voluntario->{'get'.sfInflector::camelize($campo)}()));
    }
  }
  echo "\n";
  $i++;
  unset($voluntario);
}
