<?php use_stylesheet('global.css') ?>

<div id="sf_admin_container">

<h1>Ficha del Radio Portátil <?php echo $radioportatil ?></h1>

<script>
$(document).ready(function() {
  $("#tabs").tabs();
});
</script>


<div id="tabs">
   <ul>
     <li><a href="#tareas"><span>Asignación a tareas</span></a></li>
   </ul>

<div id="tareas">
   <table>
   <thead>
   <tr><th>Tarea</th><th>Fecha</th><th>Hora comienzo</th><th>Hora fin</th><th>Voluntario responsable</th></tr>
   <thead>
   <tbody>
   <?php foreach ($radioportatil_tareas as $radioportatil_tarea): ?>
   <tr>
   <?php $tarea = $radioportatil_tarea->getTarea() ?>
   <td><?php echo link_to($tarea,'tarea/ListFicha?id='.$tarea->getId()) ?></td>
   <td><?php echo $tarea->getDateTimeObject('fecha')->format('d/m/Y') ?></td>
   <td><?php echo $tarea->getHoraComienzo() ?></td>
   <td><?php echo $tarea->getHoraFin() ?></td>
   <td><?php echo $radioportatil_tarea->getVoluntario() ?></td>
   </tr>
   <?php endforeach; ?>
   </table>

</div>
</div>

<ul class="sf_admin_actions">
  <li class="sf_admin_action_list"><?php echo link_to('Listar','radioportatil/index') ?></li>
  <li class="sf_admin_action_edit"><?php echo link_to('Editar','radioportatil/edit?id='.$radioportatil->getId()) ?></li>
</ul>


</div>