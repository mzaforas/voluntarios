<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter">
  <?php if ($form->hasGlobalErrors()): ?>
    <?php echo $form->renderGlobalErrors() ?>
  <?php endif; ?>

   <?php $fields = $configuration->getFormFilterFields($form); ?>
   <?php $fieldsets = array(
'datos_personales' => array('nombre','primer_apellido','segundo_apellido','sexo','tipo_documento_identificativo','numero_documento_identificativo','email','telefono_movil','telefono_fijo','talla','fecha_nacimiento'), 
   'datos_geográficos' => array('ciudad','provincia_id','provincia_madrid','pais','pais_españa','nacionalidad'),
   'datos_académicos' => array('nivel_estudios','especialidad','otros_estudios','nivel_ingles','nivel_frances','nivel_aleman','otro_idioma','nivel_otro_idioma','carnet_conducir'),
   'datos_experiencia' => array('experiencia_administracion','experiencia_turismo','experiencia_informatica','experiencia_seguridad','experiencia_educacion','experiencia_sanitario','experiencia_traduccion','experiencia_recursos_humanos','experiencia_otro','experiencia_otro_campo','experiencia_voluntario','experiencia_voluntario_donde','experiencia_trato_discapacitados'),
   'datos_religiosos' => array('parroquia_id','perteneciente_a_parroquia','diocesis','compromiso_religioso','movimiento_id','perteneciente_a_movimiento','perteneciente_a_gran_movimiento'),
   'datos_disponibilidad' => array('disponibilidad_dias','disponibilidad_horas'),
   'datos_gestión' => array('id','reunion_inicial','entrevista_seleccion','apto','revisado_policia','equipo_id','asignado_a_equipo','asignado_a_equipo_acreditable','asignado_a_equipo_orden','jefe_equipo','pagado','foto','acreditado','notas','formacion','documento_autorizacion_paterna'),
   'datos_gestión_logística' => array('registrado','numero_acreditacion','alojamiento','medio_transporte','fecha_llegada','fecha_salida','datos_transporte','documento_identificacion_personal', 'documento_acreditacion', 'documento_compromiso', 'documento_antecedentes_penales','tickets_comida','acreditacion_entregada'),
   'datos_niveles_seguridad' => array('nivel_seguridad_1','nivel_seguridad_2','nivel_seguridad_3','nivel_seguridad_4','nivel_seguridad_5','nivel_seguridad_6','nivel_seguridad_7','nivel_seguridad_8','nivel_seguridad_9','nivel_seguridad_10','nivel_seguridad_11','nivel_seguridad_12'),
) ?>


   <form action="<?php echo url_for('voluntario_collection', array('action' => 'filter')) ?>" method="post">
   <?php foreach ($fieldsets as $fieldset => $fields_names): ?>
   <table cellspacing="0" width="100%">
   <thead><tr><th colspan="2">
   <?php echo sfInflector::humanize($fieldset); ?>
   <?php echo image_tag('../sf/sf_web_debug/images/toggle.gif',array('onclick'=>"$('#".$fieldset."').toggle()",'style'=>'cursor:pointer')); ?>
   </th></tr></thead>
   <tbody id="<?php echo $fieldset?>">
      <?php foreach ($fields_names as $name): ?>
      <?php $field = $fields[$name]; ?>
      <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
        <?php include_partial('voluntario/filters_field', array(
          'name'       => $name,
          'attributes' => $field->getConfig('attributes', array()),
          'label'      => $field->getConfig('label'),
          'help'       => $field->getConfig('help'),
          'form'       => $form,
          'field'      => $field,
          'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_filter_field_'.$name,
        )) ?>
      <?php endforeach; ?>
   </tbody>
   </table>
   <?php endforeach; ?>

   <script>$('tbody').toggle()</script>
   <script>$('#datos_personales').toggle()</script>
   
    <table cellspacing="0" width="100%">
      <tfoot>
        <tr>
          <td colspan="2">
            <?php echo $form->renderHiddenFields() ?>
            <?php echo link_to(__('Reset', array(), 'sf_admin'), 'voluntario_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
            <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
          </td>
        </tr>
      </tfoot>
      <tbody>
      </tbody>
    </table>
  </form>
</div>
