<?php
if ($voluntario->getEquipo()) {
  echo link_to($voluntario->getEquipo(),'equipo/ListFicha?id='.$voluntario->getEquipoId(), array('title'=>$voluntario->getEquipo()->getNombreCompleto()));
}
?>