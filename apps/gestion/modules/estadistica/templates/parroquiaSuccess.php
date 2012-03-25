<?php use_stylesheet('global.css') ?>
<?php use_helper('myHelper') ?>

<h1>Voluntarios por parroquias</h1>

<script type="text/javascript">
   swfobject.embedSWF(
		      "<?php echo limpiar_url(url_for('@homepage',true))?>open-flash-chart.swf", "grafica",
		      "700", "400", "9.0.0", "expressInstall.swf",
		      {"data-file":"<?php echo url_for('estadistica/parroquiaDatos') ?>"} );
</script>

<div style="float: left; margin-right:30px">
<div id='grafica'></div>
</div>

<div id="sf_admin_container">
<table>
<thead>
<th>Parroquia</th>
<th>Voluntarios</th>
</thead>
<tbody>
  <?php foreach($voluntarios_parroquias as $voluntarios_parroquia): ?>
  <tr>
  <td><?php echo $voluntarios_parroquia['nombre'] ?></td>
  <td><?php echo $voluntarios_parroquia['voluntarios'] ?></td>
  </tr>
  <?php endforeach; ?>
</tbody>
</table>
</div>