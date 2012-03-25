<?php

/**
 * TareaEquipo form base class.
 *
 * @method TareaEquipo getObject() Returns the current form's model object
 *
 * @package    voluntarios
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTareaEquipoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'tarea_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tareas'), 'add_empty' => true)),
      'equipo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Equipos'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tarea_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tareas'), 'required' => false)),
      'equipo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Equipos'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tarea_equipo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TareaEquipo';
  }

}
