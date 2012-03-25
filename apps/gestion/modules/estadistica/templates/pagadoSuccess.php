<?php use_stylesheet('global.css') ?>
<?php use_helper('myHelper') ?>

<h1>Voluntarios pagados (excluyendo no aptos)</h1>

<script type="text/javascript">
   swfobject.embedSWF(
		      "<?php echo limpiar_url(url_for('@homepage',true))?>open-flash-chart.swf", "grafica",
		      "400", "300", "9.0.0", "expressInstall.swf",
		      {"data-file":"<?php echo url_for('estadistica/pagadoDatos') ?>"} );
</script>

<div style="float: left; margin-right:30px">
<div id='grafica'></div>
</div>

<div id="sf_admin_container">
<table>
<thead>
<th>Pagado</th>
<th>Voluntarios</th>
</thead>
<tbody>
  <?php foreach($voluntarios_pagados as $voluntarios_pagado): ?>
  <tr>
  <td><?php echo $voluntarios_pagado['pagado'] ?></td>
  <td><?php echo $voluntarios_pagado['voluntarios'] ?></td>
  </tr>
  <?php endforeach; ?>
</tbody>
</table>
</div>

<br/>

<div id="sf_admin_container">
<table>
<thead>
<th>Procedencia</th>
<th>Voluntarios pagados</th>
</thead>
<tbody>
  <tr><td>Madrid</td><td><?php echo $pagados_madrid['COUNT'] ?></td></tr>
  <tr><td>Nacionales</td><td><?php echo $pagados_nacionales['COUNT'] ?></td></tr>
  <tr><td>Internacionales</td><td><?php echo $pagados_internacionales['COUNT'] ?></td></tr>
</tbody>
</table>
</div>