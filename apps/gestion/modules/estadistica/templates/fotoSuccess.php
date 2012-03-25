<?php use_stylesheet('global.css') ?>
<?php use_helper('myHelper') ?>

<h1>Fotos voluntarios (excluyendo no aptos)</h1>

<div id="sf_admin_container">
<h2>Voluntarios grandes movimientos</h2>

<table>
<thead>
<tr>
<th>Movimiento</th>
<th>Con foto</th>
<th>Sin foto</th>
<tr>
</thead>
<tbody>
   <?php foreach ($grandes_movimientos_fotos as $movimiento => $voluntarios): ?>
   <tr>
   <td><?php echo $movimiento?></td>
   <td><?php echo $voluntarios[0] ?></td>
   <td><?php echo $voluntarios[1] ?></td>
   </tr>
   <?php endforeach ?>
</tbody>
</table>

<h2>Resto voluntarios</h2>

<table>
<thead>
<tr>
<th>Origen</th>
<th>Con foto</th>
<th>Sin foto</th>
<tr>
</thead>
<tbody>
   <tr>
   <td>Internacional</td>
   <td><?php echo $internacional_foto_si ?></td>
   <td><?php echo $internacional_foto_no ?></td>
   </tr>
   <tr>
   <td>Nacional</td>
   <td><?php echo $nacional_foto_si ?></td>
   <td><?php echo $nacional_foto_no ?></td>
   </tr>
   <tr>
   <td>Madrid</td>
   <td><?php echo $madrid_foto_si ?></td>
   <td><?php echo $madrid_foto_no ?></td>
   </tr>
</tbody>
</table>

<h2>Por niveles de seguridad (sin foto)</h2>

<table>
<thead>
<tr>
<th>Evento</th>
<th>Nivel seguridad</th>
<th>Voluntarios sin foto</th>
<tr>
</thead>
<tbody>
   <?php foreach ($fotos_seguridad as $evento => $fotos_por_evento): ?>
   <?php foreach ($fotos_por_evento as $color => $fotos): ?>
   <tr><td><?php echo $evento.'. '.$etiquetas_eventos[$evento] ?></td><td><?php echo $color ?></td><td><?php echo $fotos?></td></tr>
   <?php endforeach; ?>
   <?php endforeach; ?>
</tbody>
</table>