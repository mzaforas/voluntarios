<?php

/**
 * Parroquia filter form base class.
 *
 * @package    voluntarios
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseParroquiaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'municipio'        => new sfWidgetFormFilterInput(),
      'arciprestazgo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Arciprestazgo'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'           => new sfValidatorPass(array('required' => false)),
      'municipio'        => new sfValidatorPass(array('required' => false)),
      'arciprestazgo_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Arciprestazgo'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('parroquia_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parroquia';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'nombre'           => 'Text',
      'municipio'        => 'Text',
      'arciprestazgo_id' => 'ForeignKey',
    );
  }
}
