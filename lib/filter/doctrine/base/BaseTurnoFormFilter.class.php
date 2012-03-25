<?php

/**
 * Turno filter form base class.
 *
 * @package    voluntarios
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTurnoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'      => new sfWidgetFormFilterInput(),
      'lugar_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lugar'), 'add_empty' => true)),
      'fecha'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'hora_comienzo'    => new sfWidgetFormFilterInput(),
      'hora_fin'         => new sfWidgetFormFilterInput(),
      'voluntarios_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Voluntario')),
    ));

    $this->setValidators(array(
      'nombre'           => new sfValidatorPass(array('required' => false)),
      'descripcion'      => new sfValidatorPass(array('required' => false)),
      'lugar_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lugar'), 'column' => 'id')),
      'fecha'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'hora_comienzo'    => new sfValidatorPass(array('required' => false)),
      'hora_fin'         => new sfValidatorPass(array('required' => false)),
      'voluntarios_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Voluntario', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('turno_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addVoluntariosListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.TurnoVoluntario TurnoVoluntario')
      ->andWhereIn('TurnoVoluntario.voluntario_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Turno';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'nombre'           => 'Text',
      'descripcion'      => 'Text',
      'lugar_id'         => 'ForeignKey',
      'fecha'            => 'Date',
      'hora_comienzo'    => 'Text',
      'hora_fin'         => 'Text',
      'voluntarios_list' => 'ManyKey',
    );
  }
}
