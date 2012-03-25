<?php use_stylesheet('global.css') ?>

<div id="sf_admin_container">

<h1>Ficha de <?php echo $lugar ?></h1>

<?php if ($sf_user->hasFlash('notice')) { echo '<div class="notice">'.$sf_user->getFlash('notice').'</div>'; } ?>

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
<h3>Datos del lugar</h3>

<table>
<tr><th>Nombre</th><td><?php echo $lugar->getNombre() ?><td>
<?php if ($lugar->getMapa()): ?>
<td rowspan="9" style="background-color:#EEEEEE; border-color:#EEEEEE;" ></td>
<td rowspan="9"><?php echo $lugar->getMapa(ESC_RAW) ?></td>
<?php endif; ?>
</tr>
<tr><th>Arciprestazgo</th><td><?php echo $lugar->getArciprestazgo() ?><td></tr>
<tr><th>Vicaría</th><td><?php echo $lugar->getArciprestazgo()->getVicaria() ?><td></tr>
<tr><th>Diocesis</th><td><?php echo $lugar->getArciprestazgo()->getVicaria()->getDiocesis() ?><td></tr>
<tr><th>Municipio</th><td><?php echo $lugar->getMunicipio() ?><td></tr>
<tr><th>Dirección</th><td><?php echo $lugar->getDireccion() ?><td></tr>
<tr><th>Teléfono</th><td><?php echo $lugar->getTelefono() ?><td></tr>
<tr><th>Metro cercano</th><td><?php echo $lugar->getMetroCercano() ?><td></tr>
<tr><th>Autobús cercano</th><td><?php echo $lugar->getAutobusCercano() ?><td></tr>
<tr><th>Servicios cercanos</th><td><?php echo $lugar->getServiciosCercanos() ?><td></tr>
<tr><th>Descripción</th><td><?php echo $lugar->getDescripcion() ?><td></tr>
</table>

</div>

</div>

<ul class="sf_admin_actions">
<li class="sf_admin_action_list">
  <?php echo link_to('Listar','lugar/index') ?>
</li>
<li class="sf_admin_action_edit">
  <?php echo link_to('Editar','lugar/edit?id='.$lugar->getId()) ?>
</li>

</ul>

</div>



