<?php
use_helper('myHelper');

/* VOLUNTARIOS POR PAIS */
echo latin1("VOLUNTARIOS POR PAÍS\n\n");
echo latin1("PAÍS;VOLUNTARIOS\n");
$total_paises = 0;
foreach($paises as $pais) {
  $pais_cantidad = $pais['voluntarios'];
  $total_paises += $pais_cantidad;
  echo latin1($pais['pais']).";".$pais_cantidad."\n";
}
echo "TOTAL;".$total_paises."\n";

echo "\n\n";

/* VOLUNTARIOS POR PROVINCIA */
echo "VOLUNTARIOS POR PROVINCIA\n\n";
echo "PROVINCIA;VOLUNTARIOS\n";
$total_provincias = 0;
foreach($provincias as $provincia) {
  $provincia_cantidad = $provincia['voluntarios'];
  $total_provincias += $provincia_cantidad;
  echo latin1($provincia['nombre']).";".$provincia_cantidad."\n";
}
echo "TOTAL;".$total_provincias."\n";

echo "\n\n";

/* VOLUNTARIOS POR EDAD*/
echo "VOLUNTARIOS POR EDADES\n\n";
echo latin1("EDAD;MUNDO;ESPAÑA;MADRID APLICACIÓN VOLUNTARIOS\n");

$total_mundo = $total_españa = $total_madrid = 0;

for ($i=0; $i<12; $i++) {
  $cantidad_mundo = $edades_mundo[$i]['cantidad'];
  $total_mundo += $cantidad_mundo;
  $cantidad_españa = $edades_españa[$i]['cantidad'];
  $total_españa += $cantidad_españa;
  $cantidad_madrid = $edades_madrid[$i]['cantidad'];
  $total_madrid += $cantidad_madrid;
  echo latin1($edades_mundo[$i]['grupo_edad']).';'.$cantidad_mundo.';'.$cantidad_españa.';'.$cantidad_madrid."\n";
}
echo "TOTAL;".$total_mundo.";".$total_españa.";".$total_madrid."\n";

echo "\n\n";

/* VOLUNTARIOS MADRID POR IDIOMAS */
echo "VOLUNTARIOS MADRID POR IDIOMAS\n\n";
echo "TOTAL IDIOMAS;NIVEL\n";
echo latin1("PROVINCIA MADRID (APLICACIÓN VOLUNTARIADO);ALTO;MEDIO;BAJO;NO\n");
echo latin1("INGLÉS;").$ingles['Alto'].';'.$ingles['Medio'].';'.$ingles['Bajo'].';'.$ingles['No']."\n";
echo latin1("FRANCÉS;").$frances['Alto'].';'.$frances['Medio'].';'.$frances['Bajo'].';'.$frances['No']."\n";
echo latin1("ALEMÁN;").$aleman['Alto'].';'.$aleman['Medio'].';'.$aleman['Bajo'].';'.$aleman['No']."\n";
?>