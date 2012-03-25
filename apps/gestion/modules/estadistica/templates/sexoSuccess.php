<?php use_stylesheet('global.css') ?>
<?php use_helper('myHelper') ?>

<h1>Voluntarios por sexos</h1>

<script type="text/javascript">
   swfobject.embedSWF(
		      "<?php echo limpiar_url(url_for('@homepage',true))?>open-flash-chart.swf", "grafica",
		      "400", "300", "9.0.0", "expressInstall.swf",
		      {"data-file":"<?php echo url_for('estadistica/sexoDatos') ?>"} );
</script>

<div style="float: left; margin-right:30px">
<div id='grafica'></div>
</div>

<div id="sf_admin_container">
<table>
<thead>
<th>Sexo</th>
<th>Voluntarios</th>
</thead>
<tbody>
  <?php foreach($voluntarios_sexos as $voluntarios_sexo): ?>
  <tr>
  <td><?php echo $voluntarios_sexo['sexo'] ?></td>
  <td><?php echo $voluntarios_sexo['voluntarios'] ?></td>
  </tr>
  <?php endforeach; ?>
</tbody>
</table>
</div>