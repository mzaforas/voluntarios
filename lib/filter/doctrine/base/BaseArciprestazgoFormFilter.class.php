<?php

/**
 * Arciprestazgo filter form base class.
 *
 * @package    voluntarios
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArciprestazgoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'diocesis_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Diocesis'), 'add_empty' => true)),
      'vicaria_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Vicaria'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'      => new sfValidatorPass(array('required' => false)),
      'diocesis_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Diocesis'), 'column' => 'id')),
      'vicaria_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Vicaria'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('arciprestazgo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Arciprestazgo';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'nombre'      => 'Text',
      'diocesis_id' => 'ForeignKey',
      'vicaria_id'  => 'ForeignKey',
    );
  }
}
