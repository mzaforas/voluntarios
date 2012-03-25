<?php

/**
 * Radioportatil filter form base class.
 *
 * @package    voluntarios
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRadioportatilFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numero_serie' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tareas_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tarea')),
    ));

    $this->setValidators(array(
      'numero_serie' => new sfValidatorPass(array('required' => false)),
      'tareas_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tarea', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('radioportatil_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addTareasListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.TareaRadioportatil TareaRadioportatil')
      ->andWhereIn('TareaRadioportatil.tarea_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Radioportatil';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'numero_serie' => 'Text',
      'tareas_list'  => 'ManyKey',
    );
  }
}
