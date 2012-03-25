<?php

/**
 * Transporte Voluntario form.
 *
 */
class TransporteVoluntarioForm extends BaseVoluntarioForm
{
  public function configure()
  {
    $this->useFields(array('id','medio_transporte','fecha_llegada','fecha_salida','datos_transporte'));

    $this->widgetSchema->setFormFormatterName('Admin'); 
    $this->widgetSchema->getFormFormatter()->setValidatorSchema($this->validatorSchema); 
    $this->widgetSchema->setNameFormat('voluntario_transporte[%s]');
  }

}
