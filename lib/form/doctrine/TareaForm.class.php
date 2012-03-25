<?php

/**
 * Tarea form.
 *
 * @package    voluntarios
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TareaForm extends BaseTareaForm
{
  public function configure()
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
    if (sfContext::getInstance()->getConfiguration()->getApplication() == 'gestion') {
      $this->useFields(array('nombre', 'departamento_id', 'fecha', 'franja_horaria', 'evento_id', 'lugar_id', 'descripcion', 'voluntario_id', 'perfil_id', 'voluntarios_necesarios'));
    }

    $this->widgetSchema['voluntario_id']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
    $this->widgetSchema['voluntario_id']->setOption('renderer_options', array('model' => 'Voluntario', 'url' => url_for('voluntario/autocompletar')));
    $this->widgetSchema['fecha'] = new sfWidgetFormI18nDate(array('culture'=>'es'));
    $this->widgetSchema['fecha']->setDefault(array('year' => '2011'));

    unset($this->widgetSchema['equipos_list']);
    $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'postValidador'))));

  }

  /* 
     Comprobacion de que al editar una tarea, las otras tareas de los equipos que esten asignados, no se solapen con esta "nueva" tarea, 
     que cumplen el perfil,
  */
  public function postValidador($validator, $values)
  {
     if (!$this->isNew()) {
      $nueva_fecha = $values['fecha'];
      $nueva_franja = $values['franja_horaria'];
      $nuevo_perfil = $values['perfil_id'];
      $tarea_nueva = Doctrine::getTable('Tarea')->find($values['id']);
      $equipos = $tarea_nueva->getEquipos();
      foreach($equipos as $equipo) {
        if (/*($tarea->getFranjaHoraria() != $nueva_franja) && */
            /*(!EquipoTable::isEquipoDisponible($equipo, $nueva_fecha, $tarea_nueva))*/
            !$equipo->estaDisponible($nueva_fecha, $nueva_franja, $tarea_nueva)) {
          $error_msg = 'El '.$equipo.' ya tiene otra tarea asignada en la misma fecha y franja horaria.';
          throw new sfValidatorError($validator, $error_msg);
        } 
        if( isset($perfil) && !$equipo->tienePerfil($perfil)) {
          $error_msg = 'El '.$equipo.' ya no tiene el perfil de la tarea.';
          throw new sfValidatorError($validator, $error_msg);
        }
      }
    }
    return $values;
  }

  public function save($con = null)
  {
    $object = parent::save($con);
    $object->actualizarEstado();
    return $object;
  } 
}
