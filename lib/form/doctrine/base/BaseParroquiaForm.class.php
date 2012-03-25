<?php

/**
 * Parroquia form base class.
 *
 * @method Parroquia getObject() Returns the current form's model object
 *
 * @package    voluntarios
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseParroquiaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'nombre'           => new sfWidgetFormInputText(),
      'municipio'        => new sfWidgetFormInputText(),
      'arciprestazgo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Arciprestazgo'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'           => new sfValidatorString(array('max_length' => 255)),
      'municipio'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'arciprestazgo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Arciprestazgo'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('parroquia[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parroquia';
  }

}
