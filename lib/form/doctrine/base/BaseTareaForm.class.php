<?php

/**
 * Tarea form base class.
 *
 * @method Tarea getObject() Returns the current form's model object
 *
 * @package    voluntarios
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTareaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'nombre'                 => new sfWidgetFormInputText(),
      'fecha'                  => new sfWidgetFormDate(),
      'franja_horaria'         => new sfWidgetFormChoice(array('choices' => array('Mañana' => 'Mañana', 'Tarde' => 'Tarde', 'Mañana y Tarde' => 'Mañana y Tarde', 'Noche' => 'Noche'))),
      'lugar_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lugar'), 'add_empty' => true)),
      'descripcion'            => new sfWidgetFormTextarea(),
      'evento_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Evento'), 'add_empty' => true)),
      'voluntario_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Voluntario'), 'add_empty' => true)),
      'perfil_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Perfil'), 'add_empty' => true)),
      'voluntarios_necesarios' => new sfWidgetFormInputText(),
      'estado'                 => new sfWidgetFormChoice(array('choices' => array('Sin asignar' => 'Sin asignar', 'Incompleta' => 'Incompleta', 'Asignada' => 'Asignada'))),
      'departamento_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Departamento'), 'add_empty' => true)),
      'hora_comienzo'          => new sfWidgetFormTime(),
      'hora_fin'               => new sfWidgetFormTime(),
      'equipos_list'           => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Equipo')),
      'radioportatiles_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Radioportatil')),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'                 => new sfValidatorString(array('max_length' => 255)),
      'fecha'                  => new sfValidatorDate(),
      'franja_horaria'         => new sfValidatorChoice(array('choices' => array(0 => 'Mañana', 1 => 'Tarde', 2 => 'Mañana y Tarde', 3 => 'Noche'))),
      'lugar_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lugar'), 'required' => false)),
      'descripcion'            => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'evento_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Evento'), 'required' => false)),
      'voluntario_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Voluntario'), 'required' => false)),
      'perfil_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Perfil'), 'required' => false)),
      'voluntarios_necesarios' => new sfValidatorInteger(array('required' => false)),
      'estado'                 => new sfValidatorChoice(array('choices' => array(0 => 'Sin asignar', 1 => 'Incompleta', 2 => 'Asignada'), 'required' => false)),
      'departamento_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Departamento'), 'required' => false)),
      'hora_comienzo'          => new sfValidatorTime(array('required' => false)),
      'hora_fin'               => new sfValidatorTime(array('required' => false)),
      'equipos_list'           => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Equipo', 'required' => false)),
      'radioportatiles_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Radioportatil', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tarea[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tarea';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['equipos_list']))
    {
      $this->setDefault('equipos_list', $this->object->Equipos->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['radioportatiles_list']))
    {
      $this->setDefault('radioportatiles_list', $this->object->Radioportatiles->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveEquiposList($con);
    $this->saveRadioportatilesList($con);

    parent::doSave($con);
  }

  public function saveEquiposList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['equipos_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Equipos->getPrimaryKeys();
    $values = $this->getValue('equipos_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Equipos', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Equipos', array_values($link));
    }
  }

  public function saveRadioportatilesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['radioportatiles_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Radioportatiles->getPrimaryKeys();
    $values = $this->getValue('radioportatiles_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Radioportatiles', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Radioportatiles', array_values($link));
    }
  }

}
