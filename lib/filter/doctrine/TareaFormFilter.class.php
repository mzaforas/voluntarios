<?php

/**
 * Tarea filter form.
 *
 * @package    voluntarios
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TareaFormFilter extends BaseTareaFormFilter
{
  public function configure()
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
    $this->setWidget('id', new sfWidgetFormFilterInput(array('with_empty' => false)));
    $this->setValidator('id', new sfValidatorPass(array('required' => false)));
    $this->widgetSchema['voluntario_id']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
    $this->widgetSchema['voluntario_id']->setOption('renderer_options', array('model' => 'Voluntario', 'url' => url_for('voluntario/autocompletar')));
    $from_date = new sfWidgetFormI18nDate(array('culture'=>'es','empty_values'=>array('year'=>array('2011'=>'2011'),'month'=>array('8'=>'agosto'),'day'=>array('15'=>'15'))));
    $to_date = new sfWidgetFormI18nDate(array('culture'=>'es',
					      'empty_values'=>array('year'=>array('2011'=>'2011'),'month'=>array('8'=>'agosto'),'day'=>array('21'=>'21'))));
    $this->widgetSchema['fecha'] = new sfWidgetFormFilterDate(array(
								    'from_date' => $from_date,
								    'to_date' => $to_date,
								    'with_empty' => false));
  }
}
