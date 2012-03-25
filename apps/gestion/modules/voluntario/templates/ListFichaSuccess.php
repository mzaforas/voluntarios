<?php use_stylesheet('global.css') ?>
<?php use_helper('myHelper','I18N'); ?>

<div id="sf_admin_container">

<h1>Ficha de <?php echo $voluntario->getNombreCompleto() ?></h1>

<?php echo isset($flash) ? '<div class="notice">'.$flash.'</div>' : '' ?>
<?php if ($sf_user->hasFlash('notice')) { echo '<div class="notice">'.$sf_user->getFlash('notice').'</div>'; } ?>

<script>
$(document).ready(function() {
  $("#tabs").tabs();
});
</script>

<div id="tabs">
  <ul>
    <li><a href="#datos"><span>Datos</span></a></li>
    <?php if ($voluntario->getApto()): ?>
    <li><a href="#registro"><span>Registro</span></a></li>
   <?php if (($voluntario->getPais()!='ES' or $voluntario->getProvinciaId()!=32) and $voluntario->getAlojamiento()=='IFEMA'): ?>
    <li><a href="#tic"><span>Material TIC</span></a></li>
    <?php endif; ?>
    <li><a href="#alojamiento"><span>Alojamiento</span></a></li>
    <li><a href="#transporte"><span>Transporte</span></a></li>
    <li><a href="#seguridad"><span>Seguridad</span></a></li>
    <li><a href="#formacion"><span>Formación</span></a></li>
   <?php endif; ?>
    <li><a href="#gestion"><span>Gestión</span></a></li>
    <?php echo $tareas->count() ? '<li><a href="#tareas"><span>Responsable tareas</span></a></li>' : ''?>
  </ul>

  <div id="datos">
   <?php include_partial('voluntario/ficha_datos', array('voluntario' => $voluntario, 'foto_path' => $foto_path, 'etiquetas_eventos_seguridad'=> $etiquetas_eventos_seguridad)) ?>
  </div>

  <div id="gestion">
    <?php include_partial('voluntario/ficha_gestion', array('voluntario' => $voluntario, 'gestion_form' => $gestion_form)) ?>
  </div>

 <?php if ($voluntario->getApto()): ?>

   <?php if (($voluntario->getPais()!='ES' or $voluntario->getProvinciaId()!=32) and $voluntario->getAlojamiento()=='IFEMA'): ?>
  <div id="tic">
    <?php include_partial('voluntario/ficha_tic', array('voluntario' => $voluntario, 'tic_form' => $tic_form)) ?>
  </div>
  <?php endif; ?>

  <div id="registro">
    <?php include_partial('voluntario/ficha_registro', array('voluntario' => $voluntario, 'registro_form' => $registro_form)) ?>
  </div>

  <div id="alojamiento">
    <?php include_partial('voluntario/ficha_alojamiento', array('voluntario' => $voluntario, 'alojamiento_form' => $alojamiento_form)) ?>
  </div>

  <div id="transporte">
    <?php include_partial('voluntario/ficha_transporte', array('voluntario' => $voluntario, 'transporte_form' => $transporte_form)) ?>
  </div>

  <div id="seguridad">
    <?php include_partial('voluntario/ficha_seguridad', array('voluntario' => $voluntario, 'seguridad_form' => $seguridad_form)) ?>
  </div>

  <div id="formacion">
   <?php include_partial('voluntario/ficha_formacion', array('voluntario' => $voluntario, 'formacion_form' => $formacion_form)) ?>
  </div>
 
  <?php endif; ?>

</div>

<ul class="sf_admin_actions">
  <li class="sf_admin_action_list">
    <?php echo link_to('Listar','voluntario/index') ?>
  </li>
  <li class="sf_admin_action_edit">
    <?php echo link_to('Editar','voluntario/edit?id='.$voluntario->getId()) ?>
  </li>
</ul>

</div>