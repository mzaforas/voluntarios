<?php use_stylesheet('radioportatil_disponibilidad.css') ?>

<h1>Disponibilidad de equipos radio portatil</h1>

<h2>Agosto 2011</h2>

<table class="calendario">
<thead>
<tr><th>L</th><th>M</th><th>X</th><th>J</th><th>V</th><th>S</th><th>D</th></tr>
</thead>
<tbody>
<tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td></tr>
<tr>
<?php for ($d=8; $d<=14; $d++): ?>
<td><?php echo link_to($d,'radioportatil/disponibilidad?dia='.$d) ?></td>
<?php endfor; ?>
</tr>
<tr>
<?php for ($d=15; $d<=21; $d++): ?>
<td><?php echo link_to($d,'radioportatil/disponibilidad?dia='.$d) ?></td>
<?php endfor; ?>
</tr>
<tr>
<?php for ($d=22; $d<=28; $d++): ?>
<td><?php echo link_to($d,'radioportatil/disponibilidad?dia='.$d) ?></td>
<?php endfor; ?>
</tr>
<tr><td>29</td><td>30</td><td>31</td></tr>
</tbody>
</table>

<h2>Disponibilidad para <?php echo str_pad($dia,2,'0',STR_PAD_LEFT) ?>/08/2011</h2>

<table style="border-collapse:collapse;">
<thead>
<tr>
<th></th>
<th class="hora_th">
<?php $ancho_hora = 1008.0/24.0 - 3.0; ?>
<?php for ($h=0; $h<24; $h++): ?>
<div class="hora_div" style="width:<?php echo $ancho_hora ?>px;">
<?php echo str_pad($h,2,'0',STR_PAD_LEFT) ?>:00
</div>
 <?php endfor; ?>
</th>
</tr>
</thead>
<tbody>
<?php foreach ($radioportatiles as $radioportatil): ?>
<tr style="height:25px;"><td><?php echo link_to($radioportatil,'radioportatil/ListFicha?id='.$radioportatil->getId()) ?></td>
<td class="radioportatil_td">
   <?php
   foreach ($radioportatil->getRadioportatilTareas() as $radioportatil_tarea) {
   $tarea = $radioportatil_tarea->getTarea();
   if ($tarea->getFecha() == '2011-08-'.str_pad($dia,2,'0',STR_PAD_LEFT)) {
   $array_hora_comienzo = explode(':',$tarea->getHoraComienzo());
   $desplazamiento = ((float)$array_hora_comienzo[0] * 60.0 + (float)$array_hora_comienzo[1]) * 1008.0 / (24.0*60.0);
   $array_hora_fin = explode(':',$tarea->getHoraFin());
   $ancho = (((float)$array_hora_fin[0] * 60.0 + $array_hora_fin[1]) * 1008.0 / (24.0*60.0)) - ($desplazamiento + 2.0);
   echo link_to('Tarea '.$tarea->getId(),'tarea/ListFicha?id='.$tarea->getId(),
		array('class'=>'tarea', 'style'=>'left:'.$desplazamiento.'px;width:'.$ancho.'px;',
		      'title'=>$tarea.' ('.$tarea->getHoraComienzo().' - '.$tarea->getHoraFin().')'));
   }
 }
   ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

