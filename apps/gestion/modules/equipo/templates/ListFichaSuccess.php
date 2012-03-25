<?php use_stylesheet('global.css') ?>

<div id="sf_admin_container">

<h1>Ficha del <?php echo $equipo ?></h1>

<?php if ($sf_user->hasFlash('notice')) { echo '<div class="notice">'.$sf_user->getFlash('notice').'</div>'; } ?>

<script>
$(document).ready(function() {
  $("#tabs").tabs();
});
</script>

<div id="tabs">
    <ul>
        <li><a href="#datos"><span>Datos</span></a></li>
        <li><a href="#miembros"><span>Miembros</span></a></li>
        <li><a href="#seguridad"><span>Seguridad</span></a></li>
        <li><a href="#tareas"><span>Tareas</span></a></li>
        <li><a href="#email"><span>Email</span></a></li>
    </ul>

<div id="datos">
<h3>Datos del equipo</h3>
<table>
<tr><th>Nombre</th><td><?php echo $equipo->getNombre() ?><td></tr>
<tr><th>Perfiles</th><td>
<?php foreach ($perfiles as $perfil): ?>
  <?php echo link_to($perfil,'perfil/ListFicha?id='.$perfil->getId(),array('title'=>'Ficha del perfil')) ?>
<?php endforeach; ?>
<td></tr>
<tr><th>Jefe de equipo</th><td><?php echo $equipo->getJefe() ? link_to($equipo->getJefe(),'voluntario/ListFicha?id='.$equipo->getJefe()->getId(),array('title'=>'Ver ficha del jefe de equipo')) : '' ?><td></tr>
<tr><th>Es bolsa</th><td><?php echo $equipo->getBolsa() ? image_tag('../sfDoctrinePlugin/images/tick.png',array('title'=>'Es bolsa')) : image_tag('../sfDoctrinePlugin/images/delete.png',array('title'=>'No es bolsa')) ?><td></tr>
<tr><th>Acreditable</th><td><?php echo $equipo->getAcreditable() ? image_tag('../sfDoctrinePlugin/images/tick.png',array('title'=>'Es acreditable')) : image_tag('../sfDoctrinePlugin/images/delete.png',array('title'=>'No es acreditable')) ?><td></tr>
<tr><th>Notas</th><td><?php echo $equipo->getNotas() ?><td></tr>
<tr><th>Número de miembros</th><td><?php echo $miembros->count() ?><td></tr>
<tr><th>Número de miembros que han pagado</th><td><?php echo $equipo->getPagados() ?><td></tr>
<tr><th>Número de miembros que tienen la foto</th><td><?php echo $equipo->getFotos() ?><td></tr>
<tr><th>Número de miembros que han sido acreditados </th><td><?php echo $equipo->getAcreditados() ?><td></tr>
<tr><th>Número de tareas</th><td><?php echo $tareas->count() ?><td></tr>
</table>
</div>

<div id="miembros">
<h3>Miembros del equipo</h3>
<table>
<thead>
<tr><th>Nombre y apellidos</th><th>Email</th><th>Teléfono Móvil</th><th>Apto</th><th>Policía</th><th>Pagado</th><th>Foto</th><th>Movimiento</th></tr>
</thead>
<tbody>
<?php $icono_si = '../sfDoctrinePlugin/images/tick.png'; ?>
<?php $icono_no = '../sfDoctrinePlugin/images/delete.png'; ?>

<?php foreach ($miembros as $miembro): ?>
<tr>
  <td><?php echo link_to($miembro,'voluntario/ListFicha?id='.$miembro->getId(),array('title'=>'Ficha del voluntario')) ?></li></td>
  <td><?php echo $miembro->getEmail() ?></td>
  <td><?php echo $miembro->getTelefonoMovil() ?></td>
  <td>
    <?php 
      $apto = $miembro->getApto();
      if (is_null($apto)) {
        echo "Sin definir";    
      } elseif ($apto == 0) {
        echo image_tag($icono_no,array('title'=>'No apto'));
      } elseif ($apto == 1) {
        echo image_tag($icono_si,array('title'=>'Apto'));
      } 
    ?>
  </td>
<td> <?php echo $miembro->getRevisadoPolicia() ? image_tag($icono_si,array('title'=>'Revisado por la policía')) : image_tag($icono_no,array('title'=>'No revisado por la policía')) ?></td>
<td> <?php echo $miembro->getPagado() ? image_tag($icono_si,array('title'=>'Ha pagado')) : image_tag($icono_no,array('title'=>'No ha pagado')) ?></td>
<td> <?php echo $miembro->getFoto() != '' ? image_tag($icono_si,array('title'=>'Foto sí')) : image_tag($icono_no,array('title'=>'Foto no')) ?></td>
<td> <?php echo $miembro->getMovimiento() ?></td>
</tr>

<?php endforeach; ?>
</tbody>
</table>

</div>

<div id="seguridad">
<h3>Seguridad</h3>
<table>
<tr>
<td></td>
  <?php for($i=1;$i<=12;$i++): ?>
  <td>Evento <?php echo $i ?></td>
  <?php endfor; ?>
</tr>
<?php foreach ($miembros as $miembro): ?>
<tr>
  <td><?php echo link_to($miembro,'voluntario/ListFicha?id='.$miembro->getId(),array('title'=>'Ficha del voluntario')) ?></li></td>
  <?php for($i=1;$i<=12;$i++): ?>
<td>
<?php
    $nivel = $miembro->{'getNivelSeguridad_'.$i}();
    switch($nivel) {
    case 'Gris':
      echo '<span style="color:grey">Gris</span>';
      break;
    case 'Azul':
      echo '<span style="color:blue">Azul</span>';
      break;
    case 'Rojo':
      echo '<span style="color:red">Rojo</span>';
      break;
    default:
      echo $nivel;
    } ?>
</td>
  <?php endfor; ?>
<?php endforeach; ?>
</tr>
</table>
</div>



<div id="tareas">
<h3>Tareas asignadas al equipo</h3>
<table>
<thead>
<tr><th>Id</th><th>Nombre</th><th>Fecha</th><th>Franja horaria</th><th>Lugar</th><th>Descripción</th><th>Evento</th><th>Responsable</th></tr>
</thead>
<tbody>
<?php foreach ($tareas as $tarea): ?>
<tr>
   <td><?php echo $tarea->getId() ?></td>
   <td><?php echo link_to($tarea,'tarea/ListFicha?id='.$tarea->getId(),array('title'=>'Ficha de la tarea')) ?></td>
   <td><?php echo $tarea->getDateTimeObject('fecha')->format('d/m/Y') ?></td>
   <td><?php echo $tarea->getFranjaHoraria() ?></td>
   <td><?php echo $tarea->getLugar() ?></td>
   <td><?php echo $tarea->getDescripcion() ?></td>
   <td><?php echo $tarea->getEvento() ?></td>
   <td><?php echo $tarea->getVoluntario() ?></td>
</tr> 
<?php endforeach; ?>
</tbody>
</table>
</div>

<div id="email">
   <?php echo form_tag('equipo/enviarEmail?equipo_id='.$equipo->getId(), array('class'=>'formulario', 'multipart'=>'true')) ?> 

   <fieldset id="sf_fieldset_none">
   <?php echo $email_form->render(); ?>
   </fieldset>

   <div class="boton">
   <input type="submit" value="Enviar" />
   <?php echo button_to('Cancelar', 'equipo/ListFicha?id='.$equipo->getId()); ?>
   </div>
</div>

</div>

<ul class="sf_admin_actions">
<li class="sf_admin_action_list">
  <?php echo link_to('Listar','equipo/index') ?>
</li>
<li class="sf_admin_action_edit">
  <?php echo link_to('Editar','equipo/edit?id='.$equipo->getId()) ?>
</li>
<li class="sf_admin_action_list">
  <?php echo link_to('Descargar PDF','equipo/generarPdf?id='.$equipo->getId()) ?>
</li>

</ul>

</div>