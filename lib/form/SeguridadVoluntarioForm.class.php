<?php

/**
 * Registro Voluntario form.
 *
 */
class SeguridadVoluntarioForm extends BaseVoluntarioForm
{
  public function configure()
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));

    $etiquetas_eventos_seguridad = sfConfig::get('app_etiquetas_eventos_seguridad');
    $campos = array();

    foreach ($etiquetas_eventos_seguridad as $codigo => $etiqueta) {
      $campos[] = 'nivel_seguridad_'.$codigo;
      $this->widgetSchema['nivel_seguridad_'.$codigo]->setLabel($codigo.'. '.$etiqueta);
    }
    
    $this->useFields($campos);

    $this->widgetSchema->setFormFormatterName('Admin'); 
    $this->widgetSchema->getFormFormatter()->setValidatorSchema($this->validatorSchema); 
    $this->widgetSchema->setNameFormat('voluntario_seguridad[%s]');
  }

}
