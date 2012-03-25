<?php

use_helper('I18N');

$i = 1;
$campos = array(
'id',
'nombre',
'primer_apellido',
'segundo_apellido',
'numero_documento_identificativo',
'fecha_nacimiento',
'nacionalidad',
'nivel_seguridad_1',
'nivel_seguridad_2',
'nivel_seguridad_3',
'nivel_seguridad_4',
'nivel_seguridad_5',
'nivel_seguridad_6',
'nivel_seguridad_7',
'nivel_seguridad_8',
'nivel_seguridad_9',
'nivel_seguridad_10',
'nivel_seguridad_11',
'nivel_seguridad_12',
'foto',
);

$cabecera = '';
foreach ($campos as $campo){
  $cabecera = $cabecera.';'.sfInflector::humanize($campo);
}
echo $cabecera."\n";

foreach ($voluntarios as $voluntario) {
  echo $i;
  foreach ($campos as $campo) {
    echo ';';
    if ($campo == 'nacionalidad') {
      echo utf8_decode(format_country($voluntario->getRaw('nacionalidad')));
    } elseif ($campo == 'foto') {
      //echo 'v_'.$voluntario->getRaw('numero_documento_identificativo').'.jpg';
      echo $voluntario->getRaw('foto');
    } elseif ($campo == 'area') {
      /*
      if (isset($voluntario['Equipo']['Perfiles'][0])) {
      	echo $voluntario['Equipo']['Perfiles'][0]['nombre'];
      }*/
      echo '';
    } elseif (substr($campo,0,15) == 'nivel_seguridad') {
      if ($campo == 'nivel_seguridad_11') {
	echo 'Gris';
      } else {
	echo 'Nulo';
      }
      //      echo $voluntario[$campo];
      /*$movimiento = $voluntario['Movimiento']['nombre'];
      if ($movimiento == 'CIONG' or $movimiento == 'Camino Neocatecumenal' or $movimiento == 'Voluntarios del norte') {
      	echo $voluntario['Movimiento']['nombre'];
      }*/
    } else {
      echo utf8_decode($voluntario->getRaw($campo));
    }
  }
  echo "\n";
  $i++;
  unset($voluntario);
}
