<?php use_stylesheet('global.css') ?>
<?php use_helper('myHelper') ?>

<h1>Voluntarios por tallas</h1>

<script type="text/javascript">
   swfobject.embedSWF(
		      "<?php echo limpiar_url(url_for('@homepage',true))?>open-flash-chart.swf", "grafica",
		      "400", "300", "9.0.0", "expressInstall.swf",
		      {"data-file":"<?php echo url_for('estadistica/tallaDatos') ?>"} );
</script>

<div style="float: left; margin-right:30px">
<div id='grafica'></div>
</div>

<div id="sf_admin_container">
<table>
<thead>
<th>Talla</th>
<th>Voluntarios</th>
</thead>
<tbody>
  <?php foreach($voluntarios_tallas as $voluntarios_talla): ?>
  <tr>
  <td><?php echo $voluntarios_talla['talla'] ?></td>
  <td><?php echo $voluntarios_talla['voluntarios'] ?></td>
  </tr>
  <?php endforeach; ?>
</tbody>
</table>
</div>