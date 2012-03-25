<?php

/**
 * Evento form.
 *
 * @package    voluntarios
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EventoForm extends BaseEventoForm
{
  public function configure()
  {
    $this->widgetSchema['comienzo'] = new sfWidgetFormI18nDateTime(array('culture'=>'es'));
    $this->widgetSchema['comienzo']->setDefault(array('year' => '2011'));
    $this->widgetSchema['fin'] = new sfWidgetFormI18nDateTime(array('culture'=>'es'));
    $this->widgetSchema['fin']->setDefault(array('year' => '2011'));

    /* Comprobar que la fecha de inicio sea anterior a la de fin */
    $this->validatorSchema->setPostValidator( 
                     new sfValidatorSchemaCompare('comienzo', sfValidatorSchemaCompare::LESS_THAN, 'fin',
                                                  array(), array('invalid' => 'La fecha de comienzo ("%left_field%") debe ser anterior a la de fin ("%right_field%")') ));
  }
}
