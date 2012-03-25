<?php if($voluntario->getApto() and $voluntario->getRegistrado()): ?>
<h3>Descargar hoja de registro del voluntario: <?php echo link_to(image_tag('../sf/sf_admin/images/default_icon.png',array('title'=>'Descargar hoja de registro del voluntario')),'voluntario/hojaRegistro?id='.$voluntario->getId()) ?></h3>
<?php endif; ?>

<h3>Actualización datos de registro del voluntario</h3>
<?php echo form_tag('voluntario/fichaRegistro') ?> 
<input type="submit" value="Actualizar"/>
<fieldset id="sf_fieldset_none">
<?php echo $registro_form->render(); ?>									      
</fieldset>
<input type="submit" value="Actualizar"/>
</form>

