<?php

/**
 * Registro Voluntario form.
 *
 */
class RegistroVoluntarioForm extends BaseVoluntarioForm
{
  public function configure()
  {
    $this->useFields(array('id','registrado','idioma_documentacion'));
    
    $this->widgetSchema['idioma_documentacion']->setOption('expanded',true);

    $this->widgetSchema->setFormFormatterName('Admin'); 
    $this->widgetSchema->getFormFormatter()->setValidatorSchema($this->validatorSchema); 
    $this->widgetSchema->setNameFormat('voluntario_registro[%s]');
  }

}
