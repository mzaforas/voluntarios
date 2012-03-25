<?php

use_helper('myHelper');

$i = 1;

echo ";Nombre;Municipio;Arciprestazgo;Diocesis\n";

foreach ($parroquias as $parroquia) {
  echo $i;
  echo ";".$parroquia->getNombre();
  echo ";".$parroquia->getMunicipio();
  echo ";".$parroquia->getArciprestazgo();
  echo ";".$parroquia->getDiocesis();
  echo "\n";
  $i++;
}
