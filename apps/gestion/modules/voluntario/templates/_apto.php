<?php 
$apto = $voluntario->getApto();
if (is_null($apto)) {
  echo "?";    
} elseif ($apto == 0) {
  echo image_tag('../sfDoctrinePlugin/images/delete.png',array('title'=>'No apto'));
} elseif ($apto == 1) {
  echo image_tag('../sfDoctrinePlugin/images/tick.png',array('title'=>'Apto'));
} 
?>
