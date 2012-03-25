<?php use_stylesheet('global.css') ?>
<?php use_helper('myHelper') ?>

<h1>Voluntarios por edad</h1>

<script type="text/javascript">

   swfobject.embedSWF(
		      "<?php echo limpiar_url(url_for('@homepage',true))?>open-flash-chart.swf", "grafica",
		      "625", "500", "9.0.0", "expressInstall.swf",
		      {"data-file":"<?php echo url_for('estadistica/edadDatos') ?>"} );

</script>

<div style="float: left; margin-right:30px">
<div id='grafica'></div>
</div>

<div id="sf_admin_container">
<table>
<thead>
<th>Edad</th>
<th>Voluntarios</th>
</thead>
<tbody>
    <?php foreach($voluntarios_edades as $voluntarios_edad): ?>
  <tr>
  <td><?php echo $voluntarios_edad['grupo_edad'] ?></td>
  <td><?php echo $voluntarios_edad['cantidad'] ?></td>
  </tr>
   <?php endforeach; ?>
</tbody>
</table>
</div>


