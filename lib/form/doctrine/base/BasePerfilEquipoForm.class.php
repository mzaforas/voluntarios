<?php

/**
 * PerfilEquipo form base class.
 *
 * @method PerfilEquipo getObject() Returns the current form's model object
 *
 * @package    voluntarios
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePerfilEquipoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'perfil_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Perfiles'), 'add_empty' => true)),
      'equipo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Equipos'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'perfil_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Perfiles'), 'required' => false)),
      'equipo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Equipos'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('perfil_equipo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PerfilEquipo';
  }

}
