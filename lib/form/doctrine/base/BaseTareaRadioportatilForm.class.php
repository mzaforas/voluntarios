<?php

/**
 * TareaRadioportatil form base class.
 *
 * @method TareaRadioportatil getObject() Returns the current form's model object
 *
 * @package    voluntarios
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTareaRadioportatilForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'tarea_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tarea'), 'add_empty' => true)),
      'radioportatil_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Radioportatil'), 'add_empty' => true)),
      'voluntario_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Voluntario'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tarea_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tarea'), 'required' => false)),
      'radioportatil_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Radioportatil'), 'required' => false)),
      'voluntario_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Voluntario'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tarea_radioportatil[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TareaRadioportatil';
  }

}
