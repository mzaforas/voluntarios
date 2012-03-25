<?php

/**
 * Lugar form base class.
 *
 * @method Lugar getObject() Returns the current form's model object
 *
 * @package    voluntarios
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLugarForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'nombre'             => new sfWidgetFormInputText(),
      'arciprestazgo_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Arciprestazgo'), 'add_empty' => true)),
      'mapa'               => new sfWidgetFormTextarea(),
      'municipio'          => new sfWidgetFormInputText(),
      'direccion'          => new sfWidgetFormTextarea(),
      'telefono'           => new sfWidgetFormInputText(),
      'metro_cercano'      => new sfWidgetFormTextarea(),
      'autobus_cercano'    => new sfWidgetFormTextarea(),
      'servicios_cercanos' => new sfWidgetFormTextarea(),
      'descripcion'        => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'             => new sfValidatorString(array('max_length' => 255)),
      'arciprestazgo_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Arciprestazgo'), 'required' => false)),
      'mapa'               => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'municipio'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'direccion'          => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'telefono'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'metro_cercano'      => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'autobus_cercano'    => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'servicios_cercanos' => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'descripcion'        => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lugar[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lugar';
  }

}
