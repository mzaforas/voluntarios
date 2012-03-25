    <h3>Actualización datos de gestión departamento voluntarios</h3>
    <?php echo form_tag('voluntario/fichaGestion', array('multipart'=>'true')) ?> 
    <input type="submit" value="Actualizar"/>
    <fieldset id="sf_fieldset_none">
    <?php echo $gestion_form->render(); ?>									      
    </fieldset>
    <input type="submit" value="Actualizar"/>
    </form>
