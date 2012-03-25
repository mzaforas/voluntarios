<?php use_stylesheet('global.css') ?>
<?php use_helper('myHelper') ?>

<script type="text/javascript">
   swfobject.embedSWF(
		      "<?php echo limpiar_url(url_for('@homepage',true))?>open-flash-chart.swf", "grafica",
		      "700", "400", "9.0.0", "expressInstall.swf",
		      {"data-file":"<?php echo url_for('estadistica/enEquipoDatos') ?>"} );
</script>

<div style="float: left; margin-right:30px">
<h1>Voluntarios asignados a equipo (excluyendo no aptos)</h1>
<div id='grafica'></div>
</div>

<script type="text/javascript">
   swfobject.embedSWF(
		      "<?php echo limpiar_url(url_for('@homepage',true))?>open-flash-chart.swf", "grafica2",
		      "700", "400", "9.0.0", "expressInstall.swf",
		      {"data-file":"<?php echo url_for('estadistica/equipoDatos') ?>"} );
</script>

<div style="float: left; margin-right:30px">
<h1>Voluntarios por equipos (excluyendo no aptos)</h1>
<div id='grafica2'></div>
</div>

<div id="sf_admin_container">
<table>
<thead>
<th>Equipo</th>
<th>Nombre</th>
<th>Voluntarios</th>
</thead>
<tbody>
  <?php foreach($voluntarios_equipos as $voluntarios_equipo): ?>
  <tr>
   <td><?php echo link_to('Equipo '.$voluntarios_equipo['id'],'equipo/ListFicha?id='.$voluntarios_equipo['id']) ?></td>
  <td><?php echo $voluntarios_equipo['nombre'] ?></td>
  <td><?php echo $voluntarios_equipo['voluntarios'] ?></td>
  </tr>
  <?php endforeach; ?>
</tbody>
</table>
</div>