<?php

/**
 * TurnoVoluntario form base class.
 *
 * @method TurnoVoluntario getObject() Returns the current form's model object
 *
 * @package    voluntarios
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTurnoVoluntarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'turno_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Turno'), 'add_empty' => true)),
      'voluntario_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Voluntario'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'turno_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Turno'), 'required' => false)),
      'voluntario_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Voluntario'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('turno_voluntario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TurnoVoluntario';
  }

}
