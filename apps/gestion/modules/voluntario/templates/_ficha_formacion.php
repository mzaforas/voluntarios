    <h3>Formación recibida:</h3>
    <?php echo voluntario_tag_list($voluntario); ?>

    <h3>Añadir formación:</h3>
    <form method="post" action="<?php echo url_for('voluntario/fichaFormacion') ?>">
    <fieldset id="sf_fieldset_none">
    <?php echo $formacion_form->render(); ?>
    </fieldset>
    <input type="submit" value="Añadir"/>
    </form>

