<?php use_stylesheet('global.css') ?>

<div id="sf_admin_container">

<h1>Asignación de radioportatil <?php echo $radioportatil ?></h1>
<h2>Seleccione la persona responsable del radioportatil <u><?php echo $radioportatil ?></u> para la tarea <u><?php echo $tarea ?></u></h2>

<table>
<thead>
<tr><th>Voluntario</th><th>Equipo</th><th>Jefe de equipo</th><th>Seleccionar</th></tr>
<thead>
<tbody>
 <?php foreach ($voluntarios as $voluntario): ?>
<tr>
<td><?php echo $voluntario ?></td>
<td><?php echo $voluntario->getEquipo()->getNombreCompleto() ?></td>
<td><?php echo $voluntario->getJefeEquipo() ? image_tag('../sfDoctrinePlugin/images/tick.png',array('title'=>'Es jefe de equipo')) : '' ?></td>
<td><?php echo link_to('Seleccionar','radioportatil/asignar?tarea_id='.$tarea->getId().'&radioportatil_id='.$radioportatil->getId().'&voluntario_id='.$voluntario->getId()) ?></td>
</tr>
 <?php endforeach; ?>
</tbody>
</table>

</div>