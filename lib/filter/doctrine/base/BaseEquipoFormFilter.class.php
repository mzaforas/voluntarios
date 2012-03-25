<?php

/**
 * Equipo filter form base class.
 *
 * @package    voluntarios
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEquipoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'notas'         => new sfWidgetFormFilterInput(),
      'bolsa'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'acreditable'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'perfiles_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Perfil')),
      'tareas_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tarea')),
    ));

    $this->setValidators(array(
      'nombre'        => new sfValidatorPass(array('required' => false)),
      'notas'         => new sfValidatorPass(array('required' => false)),
      'bolsa'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'acreditable'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'perfiles_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Perfil', 'required' => false)),
      'tareas_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tarea', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('equipo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addPerfilesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.PerfilEquipo PerfilEquipo')
      ->andWhereIn('PerfilEquipo.perfil_id', $values)
    ;
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
      ->leftJoin($query->getRootAlias().'.TareaEquipo TareaEquipo')
      ->andWhereIn('TareaEquipo.tarea_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Equipo';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'nombre'        => 'Text',
      'notas'         => 'Text',
      'bolsa'         => 'Boolean',
      'acreditable'   => 'Boolean',
      'perfiles_list' => 'ManyKey',
      'tareas_list'   => 'ManyKey',
    );
  }
}
