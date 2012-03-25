<?php

/**
 * TurnoVoluntario filter form base class.
 *
 * @package    voluntarios
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTurnoVoluntarioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'turno_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Turno'), 'add_empty' => true)),
      'voluntario_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Voluntario'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'turno_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Turno'), 'column' => 'id')),
      'voluntario_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Voluntario'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('turno_voluntario_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TurnoVoluntario';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'turno_id'      => 'ForeignKey',
      'voluntario_id' => 'ForeignKey',
    );
  }
}
