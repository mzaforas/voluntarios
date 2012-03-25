<?php use_stylesheet('global.css') ?>

<div id="sf_admin_container">

<h1>Ficha de la tarea <?php echo $tarea->getId(); ?></h1>

<?php if ($sf_user->hasFlash('notice')) { echo '<div class="notice">'.$sf_user->getFlash('notice').'</div>'; } ?>

<script>
$(document).ready(function() {
  $("#tabs").tabs();
});
</script>

<div id="tabs">
   <ul>
     <li><a href="#datos"><span>Datos</span></a></li>
     <li><a href="#equipos"><span>Equipos asignados</span></a></li>
     <li><a href="#radioportatiles"><span>Asignar radio portatiles</span></a></li>
   </ul>

   <div id="datos">
     <h3>Datos de la tarea</h3>
     <table>
       <tr><th>Nombre</th><td><?php echo $tarea->getNombre() ?></td></tr>
       <tr><th>Departamento</th><td><?php echo $tarea->getDepartamento() ?></td></tr>
       <tr><th>Fecha</th><td><?php echo $tarea->getDateTimeObject('fecha')->format('d/m/Y') ?></td></tr>
       <tr><th>Franja horaria</th><td><?php echo $tarea->getFranjaHoraria() ?></td></tr>
       <tr><th>Hora comienzo</th><td><?php echo $tarea->getHoraComienzo() ?></td></tr>
       <tr><th>Hora fin</th><td><?php echo $tarea->getHoraFin() ?></td></tr>
       <tr><th>Lugar</th><td><?php echo $tarea->getLugarId() ? link_to($tarea->getLugar(),'lugar/edit?id='.$tarea->getLugar()->getId()) : ''?></td></tr>
       <tr><th>Descripción</th><td><?php echo $tarea->getDescripcion() ?></td></tr>
       <tr><th>Evento</th><td><?php echo $tarea->getEventoId() ? link_to($tarea->getEvento(),'evento/edit?id='.$tarea->getEvento()->getId()) : ''?></td></tr>
       <tr><th>Responsable</th><td><?php echo $tarea->getVoluntarioId() ? link_to($tarea->getVoluntario(),'voluntario/ListFicha?id='.$tarea->getVoluntario()->getId(),array('title'=>'Ficha del responsable')) : ''?></td></tr>
       <tr><th>Perfil</th><td><?php echo $tarea->getPerfilId() ? link_to($tarea->getPerfil(),'perfil/edit?id='.$tarea->getPerfilId()) : '' ?></td></tr>
     </table>

     <h3>Estado asignación</h3>
     <table>   
       <tr><th>Estado</th><td><?php echo $tarea->getEstado() ?></td></tr>
       <tr><th>Número de voluntarios necesarios</th><td><?php echo $tarea->getVoluntariosNecesarios() ?></td></tr>
       <tr><th>Número de voluntarios asignados</th><td><?php echo $tarea->getNumeroVoluntarios() ?></td></tr>
       <tr><th>Número de equipos asignados</th><td><?php echo $equipos_asignados->count() ?></td></tr>
     </table>

   </div>

   <div id="equipos">
     <h3>Equipos asignados</h3>
     <table>
     <thead>
     <tr><th>Equipo</th><th>Nombre</th><th>Número miembros</th><th>Perfiles asociados</th><th>Tareas asignadas</th></tr>
     <thead>
     <tbody>
     <?php foreach ($equipos_asignados as $equipo_asignado): ?>
     <tr>
     <td><?php echo link_to($equipo_asignado,'equipo/ListFicha?id='.$equipo_asignado->getId(),array('title'=>'Ficha del equipo')); ?></td>
     <td><?php echo $equipo_asignado->getNombre(); ?></td>
     <td><?php echo $equipo_asignado->getVoluntarios()->count(); ?></td>
     <td><?php foreach ($equipo_asignado->getPerfiles() as $perfil) { echo $perfil; } ?></td>
     <td><?php echo $equipo_asignado->getTareas()->count(); ?></td>
     </tr>
     <?php endforeach; ?>
     </tbody>
     </table>
  </div>

   <div id="radioportatiles">
    <?php if (!$tarea->getHoraComienzo() or !$tarea->getHoraFin()): ?> 
   <h3>La tarea debe de tener definida la hora de comienzo y de fin para que se le puedan asignar radioportatiles</h3>
   <?php else: ?>
     <h3>Radio portátiles asignados a esta tarea</h3>
     <table>
     <thead>
     <tr><th>Número de serie</th><th>Desasignar</th></tr>
     <thead>
     <tbody>
     <?php foreach ($radioportatiles_asignados as $radioportatil): ?>
     <tr>
     <td><?php echo link_to($radioportatil,'radioportatil/ListFicha?id='.$radioportatil->getId()) ?></td>
     <td><?php echo link_to('Desasignar','radioportatil/desasignar?radioportatil_id='.$radioportatil->getId().'&tarea_id='.$tarea->getId()) ?></td>
     </tr>
     <?php endforeach; ?>
     </tbody>
     </table>

     <h3>Radio portátiles disponibles no asignados a esta tarea</h3>
     <table>
     <thead>
     <tr><th>Número de serie</th><th>Asignar</th></tr>
     <thead>
     <tbody>
     <?php foreach ($radioportatiles_disponibles as $radioportatil): ?>
     <tr>
     <td><?php echo link_to($radioportatil->get('numero_serie'),'radioportatil/ListFicha?id='.$radioportatil->get('id')) ?></td>
     <td><?php echo link_to('Asignar','radioportatil/asignar?tarea_id='.$tarea->getId().'&radioportatil_id='.$radioportatil->get('id')) ?></td>
     </tr>
     <?php endforeach; ?>
     </tbody>
     </table>

   <?php endif; ?>
   </div>

</div>

<ul class="sf_admin_actions">
  <li class="sf_admin_action_list"><?php echo link_to('Listar','tarea/index') ?></li>
  <li class="sf_admin_action_edit"><?php echo link_to('Editar','tarea/edit?id='.$tarea->getId()) ?></li>
</ul>


</div>