<?php

/**
 * Lugar filter form base class.
 *
 * @package    voluntarios
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLugarFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'arciprestazgo_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Arciprestazgo'), 'add_empty' => true)),
      'mapa'               => new sfWidgetFormFilterInput(),
      'municipio'          => new sfWidgetFormFilterInput(),
      'direccion'          => new sfWidgetFormFilterInput(),
      'telefono'           => new sfWidgetFormFilterInput(),
      'metro_cercano'      => new sfWidgetFormFilterInput(),
      'autobus_cercano'    => new sfWidgetFormFilterInput(),
      'servicios_cercanos' => new sfWidgetFormFilterInput(),
      'descripcion'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nombre'             => new sfValidatorPass(array('required' => false)),
      'arciprestazgo_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Arciprestazgo'), 'column' => 'id')),
      'mapa'               => new sfValidatorPass(array('required' => false)),
      'municipio'          => new sfValidatorPass(array('required' => false)),
      'direccion'          => new sfValidatorPass(array('required' => false)),
      'telefono'           => new sfValidatorPass(array('required' => false)),
      'metro_cercano'      => new sfValidatorPass(array('required' => false)),
      'autobus_cercano'    => new sfValidatorPass(array('required' => false)),
      'servicios_cercanos' => new sfValidatorPass(array('required' => false)),
      'descripcion'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lugar_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lugar';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'nombre'             => 'Text',
      'arciprestazgo_id'   => 'ForeignKey',
      'mapa'               => 'Text',
      'municipio'          => 'Text',
      'direccion'          => 'Text',
      'telefono'           => 'Text',
      'metro_cercano'      => 'Text',
      'autobus_cercano'    => 'Text',
      'servicios_cercanos' => 'Text',
      'descripcion'        => 'Text',
    );
  }
}
