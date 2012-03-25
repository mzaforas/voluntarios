<?php use_stylesheet('global.css') ?>
<?php use_helper('myHelper') ?>

<h1>Voluntarios por niveles seguridad (excluyendo no aptos)</h1>

<script type="text/javascript">
   swfobject.embedSWF(
		      "<?php echo limpiar_url(url_for('@homepage',true))?>open-flash-chart.swf", "grafica",
		      "800", "800", "9.0.0", "expressInstall.swf",
		      {"data-file":"<?php echo url_for('estadistica/seguridadDatos') ?>"} );
</script>

<div style="float: left; margin-right:30px">
<div id='grafica'></div>
</div>

<div id="sf_admin_container">
<table>
<thead>
<th>Evento</th>
<th>Nulo</th>
<th>Gris</th>
<th>Azul</th>
<th>Rojo</th>
</thead>
<tbody>
   <?php foreach ($voluntarios_seguridad_eventos as $etiqueta => $niveles): ?>
   <tr>
   <td><?php echo $etiqueta ?></td>
   <td><?php echo $niveles['Nulo'] ?></td>
   <td><?php echo $niveles['Gris'] ?></td>
   <td><?php echo $niveles['Azul'] ?></td>
   <td><?php echo $niveles['Rojo'] ?></td>
   </tr>
   <?php endforeach; ?>
   </tbody>
</table>
</div>