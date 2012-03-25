<?php

use_helper('myHelper');

$i = 1;
$campos = array(
'nombre',
'primer_apellido',
'segundo_apellido',
'equipo_id',
'sexo',
'tipo_documento_identificativo',
'numero_documento_identificativo',
'ciudad', 
'provincia_id',
'pais', 
'email', 
'telefono_movil', 
'talla',
'nacionalidad',
'fecha_nacimiento',
'nivel_estudios',
'especialidad',
'otros_estudios',
'nivel_ingles',
'nivel_frances',
'nivel_aleman',
'otro_idioma',
'nivel_otro_idioma',
'experiencia_administracion',
'experiencia_turismo',
'experiencia_informatica',
'experiencia_seguridad',
'experiencia_educacion',
'experiencia_sanitario',
'experiencia_traduccion',
'experiencia_recursos_humanos',
'experiencia_otro',
'experiencia_otro_campo',
'experiencia_voluntario',
'experiencia_voluntario_donde',
'experiencia_trato_discapacitados',
'carnet_conducir',
'parroquia_id',
'diocesis',
'compromiso_religioso',
'movimiento_id',
'disponibilidad_dias',
'disponibilidad_horas',
'apto',
'foto',
'pagado',
'jefe_equipo',
'notas',
'alojamiento',
'datos_alojamiento',
'medio_transporte',
'fecha_llegada',
'fecha_salida');

$cabecera = '';
foreach ($campos as $campo){
    $cabecera = $cabecera.';'.latin1(sfInflector::humanize($campo));
}
echo $cabecera."\n";

foreach ($voluntarios as $voluntario) {
  echo $i;
  foreach ($campos as $campo) {
    echo ';';
    if ($campo == 'parroquia_id') {
      $valor = $voluntario[$campo];
      if ($valor) {
	echo latin1($parroquias[$valor]['nombre']);
      } 
    } elseif ($campo == 'diocesis') {
      $valor = $voluntario['parroquia_id'];
      if ($valor) {
	echo latin1($diocesis[$arciprestazgos[$parroquias[$valor]['arciprestazgo_id']]['diocesis_id']]['nombre']);
      } 
    } elseif ($campo == 'movimiento_id') {
      $valor = $voluntario[$campo];
      if ($valor) {
	echo latin1($movimientos[$valor]['nombre']);
      } 
    } elseif ($campo == 'provincia_id') {
      $valor = $voluntario[$campo];
      if ($valor) {
	echo latin1($provincias[$valor]['nombre']);
      } 
    } elseif ($campo == 'foto'){ 
      $valor = $voluntario[$campo];
      echo ($valor !== "")? 'Si' : 'No';
    } else {
      $valor = $voluntario[$campo];
      if (is_bool($valor)) {
      	echo $voluntario[$campo] ? 'Si' : 'No';
      } elseif ($valor != null) {
      	echo str_replace(';','',latin1($valor));
      } 
    }
  }
  echo "\n";
  $i++;
  unset($voluntario);
}
