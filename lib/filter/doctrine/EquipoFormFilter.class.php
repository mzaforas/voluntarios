<?php

/**
 * Equipo filter form.
 *
 * @package    voluntarios
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EquipoFormFilter extends BaseEquipoFormFilter
{
  public function configure()
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
    $this->setWidget('id', new sfWidgetFormDoctrineChoice(array('model' => 'Equipo', 'add_empty' => true)));
    $this->setValidator('id', new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Equipo', 'column' => 'id')));
    $this->widgetSchema['id']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
    $this->widgetSchema['id']->setOption('renderer_options', array('model' => 'Equipo', 'url' => url_for('equipo/autocompletar')));
    $this->setWidget('jefe', new sfWidgetFormDoctrineChoice(array('model' => 'Voluntario', 'add_empty' => true, 'table_method' => 'findJefesEquipo')));
    $this->setValidator('jefe', new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Voluntario', 'column' => 'id')));
  }

  public function addIdColumnQuery(Doctrine_Query $query, $field, $value)
  {
    $query->andWhereIn($query->getRootAlias().'.id', $value);
  }

  public function addJefeColumnQuery(Doctrine_Query $query, $field, $value)
  {
    $query->leftJoin($query->getRootAlias().'.Voluntarios v')
      ->andWhere('v.id = ?',$value);
    return;
  }

  public function getFields()
  {
    $fields = parent::getFields();
    $fields['jefe'] = 'Number';
    return $fields;
  }
}
