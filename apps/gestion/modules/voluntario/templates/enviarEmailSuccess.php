<h1>Nuevo correo electrónico</h1>
<h3>El correo electrónico va a ser enviado a <?php echo $voluntarios_num ?> voluntarios</h3>

<?php if (isset($voluntarios)): ?>
  <h4><?php echo $voluntarios ?></h4>
<?php endif; ?>

<div id="sf_admin_container">

<?php echo form_tag('voluntario/enviarEmail', array('multipart'=>'true')) ?> 

<fieldset id="sf_fieldset_none">
<?php echo $form->render(); ?>
</fieldset>

<div class="boton">
<input type="submit" value="Enviar" />
<?php echo button_to('Cancelar', 'voluntario/index'); ?>
</div>

</div>