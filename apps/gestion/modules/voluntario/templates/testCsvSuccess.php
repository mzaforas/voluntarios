<?php use_stylesheet('global.css') ?>
<h1>Test fichero csv</h1>

<div id="sf_admin_container">

   <?php if (isset($analisis)): ?>
   <table>
   <?php foreach ($analisis as $linea): ?>
   <tr><td><?php echo $linea ?></td></tr>
   <?php endforeach; ?>
</table>
   <?php else: ?>
<?php echo form_tag('voluntario/testCsv', array('multipart'=>'true')) ?> 

<fieldset id="sf_fieldset_none">
<?php echo $form->render(); ?>
</fieldset>

<div class="boton">
<input type="submit" value="Enviar" />
<?php echo button_to('Cancelar', 'voluntario/index'); ?>
</div>

   <?php endif; ?>

</div>