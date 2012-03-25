<?php

/**
 * PerfilEquipo filter form base class.
 *
 * @package    voluntarios
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePerfilEquipoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'perfil_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Perfiles'), 'add_empty' => true)),
      'equipo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Equipos'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'perfil_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Perfiles'), 'column' => 'id')),
      'equipo_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Equipos'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('perfil_equipo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PerfilEquipo';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'perfil_id' => 'ForeignKey',
      'equipo_id' => 'ForeignKey',
    );
  }
}
