<?php

/**
 * TareaRadioportatil filter form base class.
 *
 * @package    voluntarios
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTareaRadioportatilFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tarea_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tarea'), 'add_empty' => true)),
      'radioportatil_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Radioportatil'), 'add_empty' => true)),
      'voluntario_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Voluntario'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'tarea_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tarea'), 'column' => 'id')),
      'radioportatil_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Radioportatil'), 'column' => 'id')),
      'voluntario_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Voluntario'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('tarea_radioportatil_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TareaRadioportatil';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'tarea_id'         => 'ForeignKey',
      'radioportatil_id' => 'ForeignKey',
      'voluntario_id'    => 'ForeignKey',
    );
  }
}
