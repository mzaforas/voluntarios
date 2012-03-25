<h1>Ficha del perfil "<?php echo $perfil->getNombre() ?>" </h1>

<script>
$(document).ready(function() {
  $("#tabs").tabs();
});
</script>

<div id="tabs">
  <ul>
    <li><a href="#datos"><span>Datos</span></a></li>
  </ul>

<div id="datos">

<h2>Descripción perfil:</h2>
<p><?php echo $perfil->getDescripcion() ?></p>

<div id="sf_admin_container">
<h2>Equipos con este perfil:</h2>
<ul>
<?php foreach ($equipos as $equipo): ?>
   <li><?php echo link_to($equipo->getNombreCompleto(),'equipo/ListFicha?id='.$equipo->getId(),array('title'=>'Ficha del equipo '.$equipo->getId())) ?></li>
<?php endforeach; ?>
</ul>
</div>
</div>
</div>

<div id="sf_admin_container">
<ul class="sf_admin_actions">
<li class="sf_admin_action_list">
    <?php echo link_to('Listar','perfil/index') ?>
</li>
</ul>
</div>