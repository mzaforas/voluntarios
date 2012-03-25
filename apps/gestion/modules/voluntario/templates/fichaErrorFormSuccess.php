<?php use_stylesheet('global.css') ?>
<div id="sf_admin_container">
    <h3>Actualización datos de <?php echo $seccion?></h3>
    <?php echo form_tag('voluntario/ficha'.ucfirst($seccion), array('multipart'=>'true')) ?> 
    <input type="submit" value="Actualizar"/>
    <fieldset id="sf_fieldset_none">
    <?php echo $form->render(); ?>									      
    </fieldset>
    <input type="submit" value="Actualizar"/>
    </form>
</div>