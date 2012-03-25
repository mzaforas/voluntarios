<?php

/**
 * Voluntario form.
 *
 * @package    voluntarios
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InscripcionVoluntarioForm extends BaseVoluntarioForm
{
  public function configure()
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

    /* Campos */
    $this->useFields(array('nombre','primer_apellido','segundo_apellido','tipo_documento_identificativo','numero_documento_identificativo','sexo','talla',
			   'nacionalidad','fecha_nacimiento','pais','provincia_id','codigo_postal','ciudad','tipo_via','direccion','numero_via','escalera',
			   'piso','puerta','telefono_fijo','telefono_movil','fax','email','nivel_estudios','especialidad','otros_estudios','nivel_ingles',
			   'nivel_frances','nivel_aleman','otro_idioma','nivel_otro_idioma','experiencia_administracion','experiencia_turismo',
			   'experiencia_informatica','experiencia_seguridad','experiencia_educacion','experiencia_sanitario','experiencia_traduccion',
			   'experiencia_recursos_humanos','experiencia_otro','experiencia_otro_campo','experiencia_voluntario',
			   'experiencia_voluntario_donde','experiencia_trato_discapacitados','carnet_conducir','parroquia_id','compromiso_religioso',
			   'movimiento_id','disponibilidad_dias','disponibilidad_horas','colaborar_acogida','colaborar_viacrucis','colaborar_vigilia',
			   'colaborar_despedida','colaborar_ambientacion','colaborar_protocolo','colaborar_ministro_comunion','autorizacion_boletin',
			   'autorizacion_diocesis','aceptacion_condiciones'));

    /* Redeclaración de widgets */
    for($i=1910; $i<=2000; $i++) { $años[$i] = $i; }
    $this->widgetSchema['fecha_nacimiento'] = new sfWidgetFormDate(array('format'=>'%day%/%month%/%year%','years'=>$años), array('class'=>'hora_corta'));
    $this->widgetSchema['pais'] = new sfWidgetFormI18nChoiceCountry(array('culture'=>sfContext::getInstance()->getUser()->getCulture(),'add_empty'=>true));
    $this->widgetSchema['nacionalidad'] = new sfWidgetFormI18nChoiceCountry(array('culture'=>sfContext::getInstance()->getUser()->getCulture(),'add_empty'=>true));
    $this->widgetSchema['parroquia_id']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
    $this->widgetSchema['parroquia_id']->setOption('renderer_options', array('model' => 'Parroquia', 'url' => url_for('parroquia/autocompletar')));

    /* Valores por defecto y atributos */
    $this->widgetSchema['autorizacion_diocesis']->setDefault(true);
    $this->widgetSchema['autorizacion_boletin']->setDefault(true);
    if ($this->isNew()) {
      $this->widgetSchema['provincia_id']->setAttribute('onchange','actualizarParroquia()');
      $this->widgetSchema['parroquia_id']->setAttribute('disabled','disabled');
      $this->widgetSchema['pais']->setAttribute('onchange','actualizarProvincia()');
    }

    /* Redeclaración de validadores */
    $this->validatorSchema['pais'] = new sfValidatorI18nChoiceCountry(array('required'=>true));
    $this->validatorSchema['nacionalidad'] = new sfValidatorI18nChoiceCountry(array('required'=>true));
    $this->validatorSchema['email'] = new sfValidatorEmail(array('required'=>true));
    $EmailPattern = '/^([-_a-z0-9\.]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/i';
    $this->validatorSchema['email']->setOption('pattern', $EmailPattern);
    $this->validatorSchema['aceptacion_condiciones'] = new sfValidatorBoolean(array('required' => true));
   
    $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'postValidador'))));
    /* Comprobacion doble del mail */
    $this->widgetSchema['email_comprobacion'] = new sfWidgetFormInputText();
    $this->validatorSchema['email_comprobacion'] = clone $this->validatorSchema['email']; //new sfValidatorString(array('max_length' => 255))
    $this->validatorSchema['email_comprobacion']->setOption('pattern', $EmailPattern);
    $this->mergePostValidator(new sfValidatorSchemaCompare('email', sfValidatorSchemaCompare::EQUAL, 'email_comprobacion', 
							   array(), array('invalid' => _("error_emails_distintos"))));
  
    /* Formato */
    $this->widgetSchema->setFormFormatterName('Div');
    $this->widgetSchema->getFormFormatter()->setValidatorSchema($this->validatorSchema);
  }

  /**
   * Post Validador
   */
  public function postValidador($validator, $values)
  {
    // Limpiar Documento Identificativo
    $NumLettersRegex = "/[^A-Za-z0-9]/";
    $values['numero_documento_identificativo'] = strtoupper(preg_replace($NumLettersRegex,"",$values['numero_documento_identificativo']));
    /* Comprobación pais-provincia
     * Unsetting the disable attribute for 'provincia' field because 'pais' is 'ES'
     */
    if( $values['pais'] == 'ES' and empty($values['provincia_id']) )
    {
      $error = new sfValidatorError($validator, 'La provincia debe rellenarse si es residente en España');
      throw new sfValidatorErrorSchema( $validator, array('provincia_id' => $error ));
    }
    $vs_mail = $values['email'] ? Doctrine::getTable('Voluntario')->findByEmail($values['email']) : null;
    $vs_movil = $values['telefono_movil'] ? Doctrine::getTable('Voluntario')->findByTelefonoMovil($values['telefono_movil']) : null;
    $q = $values['numero_documento_identificativo'] ? Doctrine_Query::create()
      ->select('nombre')
      ->from('voluntario')
      ->where("tipo_documento_identificativo = 'NIF' and numero_documento_identificativo LIKE '".$values['numero_documento_identificativo']."'") : null;

    if( $vs_mail && $vs_mail->count() > 0 || $vs_movil && $vs_movil->count() > 0 || $q && count($q->execute()) > 0)
    {
      throw new sfValidatorError( $validator, "Ya tenemos tus datos de un registro previo. Si hay algún error en los datos que nos has facilitado ponte en contacto con el departamento de voluntariado de la JMJ. Gracias." );
    }


    
    return $values;
  }
  
}
