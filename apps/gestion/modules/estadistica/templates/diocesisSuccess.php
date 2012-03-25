<?php use_stylesheet('global.css') ?>
<?php use_helper('myHelper') ?>

<h1>Voluntarios por diocesis</h1>

<script type="text/javascript">
   swfobject.embedSWF(
		      "<?php echo limpiar_url(url_for('@homepage',true))?>open-flash-chart.swf", "grafica",
		      "500", "400", "9.0.0", "expressInstall.swf",
		      {"data-file":"<?php echo url_for('estadistica/diocesisDatos') ?>"} );
</script>

<div style="float: left; margin-right:30px">
  <div id='grafica'></div>
</div>

<div id="sf_admin_container">
<table>
<thead>
<th>Diocesis</th>
<th>Voluntarios</th>
</thead>
<tbody>

  <?php foreach($voluntarios_diocesis as $vd): ?>
  <tr>
  <td><?php echo $vd['diocesis'] ?></td>
  <td><?php echo $vd['voluntarios'] ?></td>
  </tr>
  <?php endforeach; ?>
</tbody>
</table>
</div>


