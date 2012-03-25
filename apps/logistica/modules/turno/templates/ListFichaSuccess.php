<?php use_stylesheet('global.css') ?>

<div id="sf_admin_container">

<h1>Ficha del Turno <?php echo $turno ?></h1>

<script>
$(document).ready(function() {
  $("#tabs").tabs();
});
</script>


<div id="tabs">
   <ul>
     <li><a href="#turno"><span>Datos turno</span></a></li>
     <li><a href="#voluntarios"><span>Voluntarios</span></a></li>
   </ul>

<div id="turno">
   <table>
   <tr><th>Nombre</th><td><?php echo $turno->getNombre() ?></td></tr>
   <tr><th>Descripción</th><td><?php echo $turno->getDescripcion() ?></td></tr>
   <tr><th>Lugar</th><td><?php echo $turno->getLugar() ?></td></tr>
   <tr><th>Fecha</th><td><?php echo $turno->getDateTimeObject('fecha')->format('d/m/Y')  ?></td></tr>
   <tr><th>Hora comienzo</th><td><?php echo $turno->getHoraComienzo() ?></td></tr>
   <tr><th>Hora fin</th><td><?php echo $turno->getHoraFin() ?></td></tr>
   </table>

</div>

<div id="voluntarios">
   <table>
     <h3>Voluntarios asignados a este turno</h3>
     <table>
     <thead>
     <tr><th>Nombre y apellidos</th><th>Desasignar</th></tr>
     <thead>
     <tbody>
     <?php foreach ($voluntarios_asignados as $voluntario): ?>
     <tr>
     <td><?php echo $voluntario->get('nombre').' '.$voluntario->get('primer_apellido').' '.$voluntario->get('segundo_apellido') ?></td>
     <td><?php echo link_to('Desasignar','turno/desasignar?turno_id='.$turno->getId().'&voluntario_id='.$voluntario->get('id')) ?></td>
     </tr>
     <?php endforeach; ?>
     </tbody>
   </table>

   <table>
   <h3>Voluntarios disponibles no asignados a este turno</h3>
     <table>
     <thead>
     <tr><th>Nombre y apellidos</th><th>Asignar</th></tr>
     <thead>
     <tbody>
     <?php foreach ($voluntarios_disponibles as $voluntario): ?>
     <tr>
     <td><?php echo $voluntario->get('nombre').' '.$voluntario->get('primer_apellido').' '.$voluntario->get('segundo_apellido') ?></td>
     <td><?php echo link_to('Asignar','turno/asignar?turno_id='.$turno->getId().'&voluntario_id='.$voluntario->get('id')) ?></td>
     </tr>
     <?php endforeach; ?>
     </tbody>
   </table>

</div>
</div>

<ul class="sf_admin_actions">
  <li class="sf_admin_action_list"><?php echo link_to('Listar','turno/index') ?></li>
  <li class="sf_admin_action_edit"><?php echo link_to('Editar','turno/edit?id='.$turno->getId()) ?></li>
</ul>


</div>