<?php

/**
 * TIC Voluntario form.
 *
 */
class TICVoluntarioForm extends BaseVoluntarioForm
{
  public function configure()
  {
    $this->useFields(array('id','tickets_comida','acreditacion_entregada'));
    
    $this->widgetSchema['acreditacion_entregada'] = new sfWidgetFormInputCheckbox(array(), array('disabled' => true));
      $this->widgetSchema->setFormFormatterName('Admin'); 
    $this->widgetSchema->getFormFormatter()->setValidatorSchema($this->validatorSchema); 
    $this->widgetSchema->setNameFormat('voluntario_tic[%s]');
  }

}
