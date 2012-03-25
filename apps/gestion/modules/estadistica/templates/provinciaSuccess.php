<?php use_stylesheet('global.css') ?>
<?php use_helper('myHelper') ?>

<h1>Voluntarios por provincias</h1>

<script type="text/javascript">
   swfobject.embedSWF(
		      "<?php echo limpiar_url(url_for('@homepage',true))?>open-flash-chart.swf", "grafica",
		      "500", "400", "9.0.0", "expressInstall.swf",
		      {"data-file":"<?php echo url_for('estadistica/provinciaDatos') ?>"} );
</script>

<div style="float: left; margin-right:30px">
  <div id='grafica'></div>
</div>

<div id="sf_admin_container">
<table>
<thead>
<th>Provincia</th>
<th>Voluntarios</th>
</thead>
<tbody>
  <?php foreach($voluntarios_provincias as $voluntarios_provincia): ?>
  <tr>
  <td><?php echo $voluntarios_provincia['nombre'] ?></td>
  <td><?php echo $voluntarios_provincia['voluntarios'] ?></td>
  </tr>
  <?php endforeach; ?>
</tbody>
</table>
</div>


