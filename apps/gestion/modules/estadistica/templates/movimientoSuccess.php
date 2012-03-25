<?php use_stylesheet('global.css') ?>
<?php use_helper('myHelper') ?>

<h1>Voluntarios por movimientos</h1>

<script type="text/javascript">
   swfobject.embedSWF(
		      "<?php echo limpiar_url(url_for('@homepage',true))?>open-flash-chart.swf", "grafica",
		      "500", "400", "9.0.0", "expressInstall.swf",
		      {"data-file":"<?php echo url_for('estadistica/movimientoDatos') ?>"} );
</script>

<div style="float: left; margin-right:30px">
<div id='grafica'></div>
</div>

<div id="sf_admin_container">
<table>
<thead>
<th>Movimiento</th>
<th>Voluntarios</th>
</thead>
<tbody>
  <?php foreach($voluntarios_movimientos as $voluntarios_movimiento): ?>
  <tr>
  <td><?php echo $voluntarios_movimiento['nombre'] ?></td>
  <td><?php echo $voluntarios_movimiento['voluntarios'] ?></td>
  </tr>
  <?php endforeach; ?>
</tbody>
</table>
</div>