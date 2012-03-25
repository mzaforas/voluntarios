<?php use_stylesheet('global.css') ?>
<?php use_helper('myHelper') ?>

<h1>Estadísticas registro voluntarios</h1>

<div id="sf_admin_container">
<table>
   <tr><th>Registrados</th><td><?php echo $registrados ?> (<?php echo round(($registrados*100) / $prevision_registros, 2) ?>% previstos, <?php echo $prevision_registros - $registrados ?> restantes)</td></tr>
<tr><th>Registrados alojados en IFEMA</th><td><?php echo $registrados_ifema ?> (<?php echo round(($registrados_ifema*100) / $prevision_ifema, 2) ?>% previstos)</td></tr>
<tr><th>Abonos transporte repartidos (aprox.)</th><td><?php echo $abonos_transporte_repartidos ?></td></tr>
<tr><th>Tickets comida repartidos primera semana (aprox.)</th><td><?php echo $tickets_comida_repartidos ?></td></tr>
<tr><th>Tickets comida repartidos segunda semana (exacto)</th><td><?php echo $tickets_comida_segunda_semana_repartidos ?></td></tr>
</table>

</div>