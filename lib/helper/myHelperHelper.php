<?php

function limpiar_url($url) {
  $url = str_replace('request_password','',$url);
  $url = str_replace('logout','',$url);
  $url = str_replace('gestion_dev.php/','',$url);
  $url = str_replace('gestion.php/','',$url);
  return $url;
}

function latin1($txt) {
  $encoding = mb_detect_encoding($txt, 'ASCII,UTF-8,ISO-8859-1');
  if ($encoding == "UTF-8") {
    $txt = utf8_decode($txt);
  }
  return $txt;
}

function utf8($txt) {
  $encoding = mb_detect_encoding($txt, 'ASCII,UTF-8,ISO-8859-1');
  if ($encoding == "ISO-8859-1") {
    $txt = utf8_encode($txt);
  }
  return $txt;
}

function quitar_tildes($t) {
  $vocalti= array ("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ");
  $vocales= array ("a","e","i","o","u","n","A","E","I","O","U","N");

  return str_replace($vocalti, $vocales, $t);
}

function voluntario_tag_list($voluntario)
{
  $voluntario_id = $voluntario->getId();
  $q = Doctrine::getTable('Tagging')
    ->createQuery('v')
    ->where('v.taggable_id = '.$voluntario_id);
  $taggins = $q->execute();

  $result = '';

  if (count($taggins) > 0) {
    $result = '<table><thead><tr><th>Formación</th><th>Eliminar</th></tr></thead>';
    $i = 1;
    foreach ($taggins as $taggin) {
      $tag = $taggin->getTag()->getName();
      $result .= '<tr><td>'.$tag.'</td><td>';
      $result .= link_to(image_tag('../sfDoctrinePlugin/images/delete.png',array('title'=>'Eliminar')),'voluntario/deleteTag?tagging_id='.$taggin->getId().'#formacion',array('confirm'=>'¿Estás seguro de que deseas eliminarlo?'));
      $result .= '</td></tr>';
      $i++;
    }
      $result .= '</table>';
  }

  return $result;
}
