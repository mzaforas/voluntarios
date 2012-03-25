<?php

/**
 * Alojamiento Voluntario form.
 *
 */
class AlojamientoVoluntarioForm extends BaseVoluntarioForm
{
  public function configure()
  {
    $this->useFields(array('id','alojamiento','datos_alojamiento'));

    $this->widgetSchema->setFormFormatterName('Admin'); 
    $this->widgetSchema->getFormFormatter()->setValidatorSchema($this->validatorSchema); 
    $this->widgetSchema->setNameFormat('voluntario_alojamiento[%s]');
  }

}
