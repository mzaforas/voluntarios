<?php

/**
 * IdiomaPais filter form base class.
 *
 * @package    voluntarios
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseIdiomaPaisFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'pais_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pais'), 'add_empty' => true)),
      'idioma_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Idioma'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'pais_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pais'), 'column' => 'id')),
      'idioma_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Idioma'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('idioma_pais_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'IdiomaPais';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'pais_id'   => 'ForeignKey',
      'idioma_id' => 'ForeignKey',
    );
  }
}
