<h1>Enviar mensaje a todos los usuarios del sistema</h1>

<div id="sf_admin_container">

<?php echo form_tag('ayuda/contactarUsuarios') ?> 

<fieldset id="sf_fieldset_none">
<?php echo $form->render() ?>
</fieldset>

<div class="boton">
<input type="submit" value="Enviar" />
<?php echo button_to('Cancelar', 'voluntario/index'); ?>
</div>

</div>