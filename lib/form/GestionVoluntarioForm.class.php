<?php

/**
 * Gestion Voluntario form.
 *
 */
class GestionVoluntarioForm extends BaseVoluntarioForm
{
  public function configure()
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));

    $this->useFields(array('id','reunion_inicial','entrevista_seleccion','apto','equipo_id',
			   'jefe_equipo','notas'));

    $this->widgetSchema['equipo_id']->setOption('method','getNombreCompleto');
    $this->widgetSchema['apto'] = new sfWidgetFormTrilean();
    $this->validatorSchema['apto'] = new sfValidatorTrilean(); 
    if (sfContext::getInstance()->getUser()->hasCredential('voluntario_subir_foto')) {
      $foto_src = 'https://voluntarios.madrid11.com/uploads/fotos/' . ($this->getObject()->getFoto() ? $this->getObject()->getFoto() : 'generica.png');
      $this->widgetSchema['foto'] = new sfWidgetFormInputFileEditable(array('file_src'=>$foto_src,
									    'is_image'=>true,
									    'with_delete'=>false,
									    'template'=>'%file%<br />%input%<br />'));
      $this->validatorSchema['foto'] = new sfValidatorFile(array('required'   => false,
								 'path'       => sfConfig::get('sf_upload_dir').'/fotos',
								 'mime_types' => array('image/jpeg','image/pjpeg')));
    }
    $path_doc = sfConfig::get('sf_data_dir').'/documentos';
    $this->widgetSchema['documento_identificacion_personal'] = new sfWidgetFormInputFile();
    $this->validatorSchema['documento_identificacion_personal'] = new sfValidatorFile(array('required' => false,
											    'path' => $path_doc.'/documento_identificacion_personal'));
    $this->widgetSchema['documento_acreditacion'] = new sfWidgetFormInputFile();
    $this->validatorSchema['documento_acreditacion'] = new sfValidatorFile(array('required' => false,
										 'path' => $path_doc.'/documento_acreditacion'));
    $this->widgetSchema['documento_compromiso'] = new sfWidgetFormInputFile();
    $this->validatorSchema['documento_compromiso'] = new sfValidatorFile(array('required' => false,
									       'path' => $path_doc.'/documento_compromiso'));
    $this->widgetSchema['documento_antecedentes_penales'] = new sfWidgetFormInputFile();
    $this->validatorSchema['documento_antecedentes_penales'] = new sfValidatorFile(array('required' => false,
											 'path' => $path_doc.'/documento_antecedentes_penales'));

    $this->widgetSchema['documento_autorizacion_paterna'] = new sfWidgetFormInputFile();
    $this->validatorSchema['documento_autorizacion_paterna'] = new sfValidatorFile(array('required' => false,
											 'path' => $path_doc.'/documento_autorizacion_paterna'));

    $this->widgetSchema->setFormFormatterName('Admin'); 
    $this->widgetSchema->getFormFormatter()->setValidatorSchema($this->validatorSchema); 
    $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'postValidador'))));
    $this->widgetSchema->setNameFormat('voluntario_gestion[%s]');
  }

  /**
   * Post Validador
   */
  public function postValidador($validator, $values)
  {
    $equipo_destino_id = $values['equipo_id'];
    $equipo_origen_id = $this->getObject()->getEquipoId();

    if ($equipo_destino_id) {
      $equipo = Doctrine::getTable('Equipo')->find($equipo_destino_id); 
      /* Comprobación tamaño equipo */
      if ($this->getObject()->getEquipoId() != $equipo_destino_id) {
	if (!sfContext::getInstance()->getUser()->hasCredential('voluntario_asignar_equipo')) {
      	  $error = new sfValidatorError($validator, 'No tiene permisos suficientes para asignar un voluntario a un equipo');
      	  throw new sfValidatorErrorSchema( $validator, array('equipo_id' => $error ));
      	} elseif (!$equipo->getBolsa() and $equipo->getNumeroMiembros() >= 20) {
      	  $error = new sfValidatorError($validator, 'El '.$equipo.' tiene ya 20 voluntarios. Debe asignar el voluntario a otro equipo');
      	  throw new sfValidatorErrorSchema( $validator, array('equipo_id' => $error ));
      	}
      }
      /* Comprobación jefe equipo único */
      if (($values['jefe_equipo'] == true)) {
    	if ($equipo->getJefe() != null and $equipo->getJefe()->getId() != $values['id']) {
    	  $error = new sfValidatorError($validator, 'El '.$equipo.' ya tiene un jefe de equipo asignado. No puede asignar dos jefes de equipo al mismo equipo');
    	  throw new sfValidatorErrorSchema( $validator, array('equipo_id' => $error ));
    	}
      }
      /* Comprobación de que no vamos a poner voluntarios en un equipo que tiene tareas asignadas */
      /* if ($equipo_origen_id != $equipo_destino_id and $equipo->getTareas()->count()) { */
      /* 	$error = new sfValidatorError($validator, 'El '.$equipo.' ya tiene tareas asignadas. No puede poner voluntarios de un equipo con tareas ya asignadas'); */
      /* 	throw new sfValidatorErrorSchema( $validator, array('equipo_id' => $error )); */
      /* } */
    }
    /* Comprobación de que no vamos a quitar voluntarios de un equipo que tiene tareas asignadas */
    /* if ($equipo_origen_id and $equipo_origen_id != $equipo_destino_id and $this->getObject()->getEquipo()->getTareas()->count()) { */
    /*   $error = new sfValidatorError($validator, 'El '.$this->getObject()->getEquipo().' ya tiene tareas asignadas. No puede quitar voluntarios de un equipo con tareas ya asignadas'); */
    /*   throw new sfValidatorErrorSchema( $validator, array('equipo_id' => $error )); */
    /* } */
    
    return $values;
  }

}
