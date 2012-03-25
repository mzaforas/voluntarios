<?php

/**
 * Tarea filter form base class.
 *
 * @package    voluntarios
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTareaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'franja_horaria'         => new sfWidgetFormChoice(array('choices' => array('' => '', 'Mañana' => 'Mañana', 'Tarde' => 'Tarde', 'Mañana y Tarde' => 'Mañana y Tarde', 'Noche' => 'Noche'))),
      'lugar_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lugar'), 'add_empty' => true)),
      'descripcion'            => new sfWidgetFormFilterInput(),
      'evento_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Evento'), 'add_empty' => true)),
      'voluntario_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Voluntario'), 'add_empty' => true)),
      'perfil_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Perfil'), 'add_empty' => true)),
      'voluntarios_necesarios' => new sfWidgetFormFilterInput(),
      'estado'                 => new sfWidgetFormChoice(array('choices' => array('' => '', 'Sin asignar' => 'Sin asignar', 'Incompleta' => 'Incompleta', 'Asignada' => 'Asignada'))),
      'departamento_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Departamento'), 'add_empty' => true)),
      'hora_comienzo'          => new sfWidgetFormFilterInput(),
      'hora_fin'               => new sfWidgetFormFilterInput(),
      'equipos_list'           => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Equipo')),
      'radioportatiles_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Radioportatil')),
    ));

    $this->setValidators(array(
      'nombre'                 => new sfValidatorPass(array('required' => false)),
      'fecha'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'franja_horaria'         => new sfValidatorChoice(array('required' => false, 'choices' => array('Mañana' => 'Mañana', 'Tarde' => 'Tarde', 'Mañana y Tarde' => 'Mañana y Tarde', 'Noche' => 'Noche'))),
      'lugar_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lugar'), 'column' => 'id')),
      'descripcion'            => new sfValidatorPass(array('required' => false)),
      'evento_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Evento'), 'column' => 'id')),
      'voluntario_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Voluntario'), 'column' => 'id')),
      'perfil_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Perfil'), 'column' => 'id')),
      'voluntarios_necesarios' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'estado'                 => new sfValidatorChoice(array('required' => false, 'choices' => array('Sin asignar' => 'Sin asignar', 'Incompleta' => 'Incompleta', 'Asignada' => 'Asignada'))),
      'departamento_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Departamento'), 'column' => 'id')),
      'hora_comienzo'          => new sfValidatorPass(array('required' => false)),
      'hora_fin'               => new sfValidatorPass(array('required' => false)),
      'equipos_list'           => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Equipo', 'required' => false)),
      'radioportatiles_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Radioportatil', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tarea_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addEquiposListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('TareaEquipo.equipo_id', $values)
    ;
  }

  public function addRadioportatilesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('TareaRadioportatil.radioportatil_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Tarea';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'nombre'                 => 'Text',
      'fecha'                  => 'Date',
      'franja_horaria'         => 'Enum',
      'lugar_id'               => 'ForeignKey',
      'descripcion'            => 'Text',
      'evento_id'              => 'ForeignKey',
      'voluntario_id'          => 'ForeignKey',
      'perfil_id'              => 'ForeignKey',
      'voluntarios_necesarios' => 'Number',
      'estado'                 => 'Enum',
      'departamento_id'        => 'ForeignKey',
      'hora_comienzo'          => 'Text',
      'hora_fin'               => 'Text',
      'equipos_list'           => 'ManyKey',
      'radioportatiles_list'   => 'ManyKey',
    );
  }
}
