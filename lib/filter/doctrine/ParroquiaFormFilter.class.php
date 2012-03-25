<?php

/**
 * Parroquia filter form.
 *
 * @package    voluntarios
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ParroquiaFormFilter extends BaseParroquiaFormFilter
{
  public function configure()
  {
    $this->setWidget('vicaria_id', new sfWidgetFormDoctrineChoice(array('model' => 'Vicaria', 'add_empty' => true)));
    $this->setValidator('vicaria_id', new  sfValidatorPass());
    $this->setWidget('diocesis_id', new sfWidgetFormDoctrineChoice(array('model' => 'Diocesis', 'add_empty' => true)));
    $this->setValidator('diocesis_id', new  sfValidatorPass());
    $this->widgetSchema['arciprestazgo_id']->setOption('order_by', array('nombre','asc'));
  }

  public function addVicariaIdColumnQuery(Doctrine_Query $query, $field, $value)
  {
    $query->addWhere('vicaria.id = ?', $value);
  }

  public function addDiocesisIdColumnQuery(Doctrine_Query $query, $field, $value)
  {
    $query->addWhere('diocesis.id = ?', $value);
  }

}
