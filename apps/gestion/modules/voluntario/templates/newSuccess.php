<?php use_helper('I18N','jQuery') ?>
<?php use_stylesheet('formulario.css') ?>

<h1 align="center"><?php echo __('Inscripcion Nuevo Voluntario') ?></h1>

<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<form action="<?php echo url_for('voluntario/create') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> class="formulario">

<?php echo $form->renderGlobalErrors() ?>
<?php echo $form->renderHiddenFields() ?>
<fieldset>
<legend><?php echo __('Datos personales') ?></legend>
<?php echo $form['nombre']->renderRow() ?>
<?php echo $form['primer_apellido']->renderRow() ?>
<?php echo $form['segundo_apellido']->renderRow() ?>
<?php echo $form['fecha_nacimiento']->renderRow() ?>
<?php echo $form['tipo_documento_identificativo']->renderRow() ?>
<?php echo $form['numero_documento_identificativo']->renderRow() ?>
<?php echo $form['sexo']->renderRow() ?>
<?php echo $form['talla']->renderRow() ?>
<?php echo $form['nacionalidad']->renderRow() ?>
</fieldset>

<?php echo jq_javascript_tag('function actualizarParroquia() { if ($("#voluntario_provincia_id").val()=="32") { $("#voluntario_parroquia_id").removeAttr("disabled"); $("#autocomplete_voluntario_parroquia_id").removeAttr("disabled"); } else { $("#voluntario_parroquia_id").attr("disabled",true); $("#autocomplete_voluntario_parroquia_id").attr("disabled",true); } }') ?>
<?php echo jq_javascript_tag('function actualizarProvincia() {  if ($("#voluntario_pais").val()=="ES") {       $("#voluntario_provincia_id").removeAttr("disabled");   } else {       $("#voluntario_provincia_id").attr("value", ""); $("#voluntario_provincia_id").attr("disabled",true);   } }') ?>

<fieldset>
<legend><?php echo __('Datos direccion') ?></legend>
<?php echo $form['pais']->renderRow() ?>
<?php echo $form['provincia_id']->renderRow() ?>
<?php echo $form['codigo_postal']->renderRow() ?>
<?php echo $form['ciudad']->renderRow() ?>
<?php echo $form['tipo_via']->renderRow() ?>
<?php echo $form['direccion']->renderRow() ?>
<?php echo $form['numero_via']->renderRow() ?>
<?php echo $form['escalera']->renderRow() ?>
<?php echo $form['piso']->renderRow() ?>
<?php echo $form['puerta']->renderRow() ?>
</fieldset>

<fieldset>
<legend><?php echo __('Datos contacto') ?></legend>
<?php echo $form['telefono_fijo']->renderRow() ?>
<?php echo $form['telefono_movil']->renderRow() ?>
<?php echo $form['fax']->renderRow() ?>
<?php echo $form['email']->renderRow() ?>
<?php echo $form['email_comprobacion']->renderRow() ?>
</fieldset>

<fieldset>
<legend><?php echo __('Estudios') ?></legend>
<?php echo $form['nivel_estudios']->renderRow() ?>
<?php echo $form['especialidad']->renderRow() ?>
<?php echo $form['otros_estudios']->renderRow() ?>
<?php echo $form['nivel_ingles']->renderRow() ?>
<?php echo $form['nivel_frances']->renderRow() ?>
<?php echo $form['nivel_aleman']->renderRow() ?>
<?php echo $form['otro_idioma']->renderRow() ?>
<?php echo $form['nivel_otro_idioma']->renderRow() ?>
</fieldset>

<fieldset>
<legend><?php echo __('Experiencia') ?></legend>
<?php echo $form['experiencia_administracion']->renderRow() ?>
<?php echo $form['experiencia_turismo']->renderRow() ?>
<?php echo $form['experiencia_informatica']->renderRow() ?>
<?php echo $form['experiencia_seguridad']->renderRow() ?>
<?php echo $form['experiencia_educacion']->renderRow() ?>
<?php echo $form['experiencia_sanitario']->renderRow() ?>
<?php echo $form['experiencia_traduccion']->renderRow() ?>
<?php echo $form['experiencia_recursos_humanos']->renderRow() ?>
<?php echo $form['experiencia_otro']->renderRow() ?>
<?php echo $form['experiencia_otro_campo']->renderRow() ?>
<?php echo $form['experiencia_voluntario']->renderRow() ?>
<?php echo $form['experiencia_voluntario_donde']->renderRow() ?>
<?php echo $form['experiencia_trato_discapacitados']->renderRow() ?>
<?php echo $form['carnet_conducir']->renderRow() ?>
</fieldset>

<fieldset>
<legend><?php echo __('Compromiso religioso') ?></legend>
<?php echo $form['parroquia_id']->renderRow() ?>
<?php echo $form['compromiso_religioso']->renderRow() ?>
<?php echo $form['movimiento_id']->renderRow() ?>
</fieldset>

<fieldset>
<legend><?php echo __('Disponibilidad') ?></legend>
<?php echo $form['disponibilidad_dias']->renderRow() ?>
<?php echo $form['disponibilidad_horas']->renderRow() ?>
</fieldset>

<fieldset>
<legend><?php echo __('Politica de privacidad') ?></legend>
<?php echo $form['aceptacion_condiciones']->renderRow() ?>
</fieldset>

<div class="boton" align="center">
<input type="submit" value="<?php echo __('Enviar') ?>" />
</div>

</form>
