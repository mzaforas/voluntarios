   <?php if ($tareas->count()): ?>
   <div id="tareas">
   <h3><?php echo $voluntario->getNombreCompleto() ?> es responsable de las siguientes tareas:</h3>
   <table>
   <thead><tr><th>Tareas</th></tr></thead>
   <?php foreach ($tareas as $tarea): ?>
   <tr><td><?php echo link_to($tarea->getNombre(),'tarea/ListFicha?id='.$tarea->getId()); ?></td></tr>
   <?php endforeach; ?>
   </table>
   </div>
   <?php endif; ?>
