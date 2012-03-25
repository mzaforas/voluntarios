<h1>Contactar con el equipo de desarrollo</h1>
<h3>Si has detectado un problema en la aplicación o tienes alguna sugerencia para mejorarla, puedes contactar con el equipo de desarrollo a través del siguiente formulario. ¡Gracias!</h3>

<div id="sf_admin_container">

<?php echo form_tag('ayuda/contactarDesarrolladores') ?> 

<fieldset id="sf_fieldset_none">
<?php echo $form->render() ?>
</fieldset>

<div class="boton">
<input type="submit" value="Enviar" />
<?php echo button_to('Cancelar', 'voluntario/index'); ?>
</div>

</div>