<?php use_stylesheet('global.css') ?>
<?php use_helper('myHelper') ?>

<h1>Resumen proceso acreditación voluntarios</h1>

<div id="sf_admin_container">
<table>
<tr><td></td><th>Foto sí</th><th>Foto no</th></tr>
<tr><th>Pagado sí</th><td><?php echo $foto_si_pagado_si ?></td><td><?php echo $foto_no_pagado_si ?></td></tr>
<tr><th>Pagado no</th><td><?php echo $foto_si_pagado_no ?></td><td><?php echo $foto_no_pagado_no ?></td></tr>
</table>

<br/>

<table>
<thead>
<td></td>
<th>Sí</th>
<th>No</th>
<th>Sin definir</th>
</thead>
<tbody>
<tr><th>Apto</th><td><?php echo $apto_si ?></td><td><?php echo $apto_no ?></td><td><?php echo $apto_sin_definir ?></td></tr>
<tr><th>Revisado policía</th><td><?php echo $policia_si ?></td><td><?php echo $policia_no ?></td></tr>
<tr><th>Pagado</th><td><?php echo $pagado_si ?></td><td><?php echo $pagado_no ?></td></tr>
<tr><th>Asignado a equipo</th><td><?php echo $equipo_si ?></td><td><?php echo $equipo_no ?></td></tr>
<tr><th>Asignado a equipo acreditable</th><td><?php echo $equipo_acreditable_si ?></td><td><?php echo $equipo_acreditable_no ?></td></tr>
<tr><th>Foto</th><td><?php echo $foto_si ?></td><td><?php echo $foto_no ?></td></tr>
<tr><th>(Apto + Policía + Pagado + Equipo acreditable)</th><td><?php echo $equipo_pagado_policia_apto_si ?></td><td><?php echo $equipo_pagado_policia_apto_no ?></td></tr>
</tbody>
</table>
</div>