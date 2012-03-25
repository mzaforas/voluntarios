<?php use_stylesheet('global.css') ?>

<div id="sf_admin_container">

<h1>Hojas de firmas</h1>

<table>
<?php foreach ($eventos as $evento): ?>
<tr><td><?php echo link_to('Hoja de firmas '.$evento,'radioportatil/firmas?evento_id='.$evento->getId()) ?></td></tr>
<?php endforeach ?>
</table>

</div>