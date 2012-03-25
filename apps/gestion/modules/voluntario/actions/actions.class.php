<?php

require_once dirname(__FILE__).'/../lib/voluntarioGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/voluntarioGeneratorHelper.class.php';

/**
 * voluntario actions.
 *
 * @package    voluntarios
 * @subpackage voluntario
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class voluntarioActions extends autoVoluntarioActions
{

  /**
   * Enviar mail a un conjunto de voluntarios
   */
  public function executeEnviarEmail(sfWebRequest $request)
  {
    $this->form = new EmailForm();
    $filters = $this->getUser()->getAttribute('voluntario.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    $filters_form = new VoluntarioFormFilter();
    $query = $filters_form->buildQuery($filters);

    if ($request->hasParameter('email')) {
      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
      if ($this->form->isValid()) {
	$query->select('email');
	$destinatarios = $query->execute()->toKeyValueArray('id','email');
	$num = MailManager::enviarMail($destinatarios, $this->form->getValue('asunto'), $this->form->getValue('cuerpo'), $this->form->getValue('adjunto'), 
                                       array($this->form->getValue('remitente') => $this->form->getValue('remitente')));
	$this->getUser()->setFlash('notice','El correo electrónico ha sido enviado a '.$num.' voluntarios');
	$this->redirect('voluntario/index');
      }
    }

    $query->select('nombre, primer_apellido, segundo_apellido, email');
    $this->voluntarios_num = $query->count();
    if ($this->voluntarios_num < 20) {
      $voluntarios = $query->fetchArray();
      foreach($voluntarios as $v) {
	$voluntarios_array[] = $v['nombre'].' '.$v['primer_apellido'].' '.$v['segundo_apellido'].' ('.$v['email'].')';
      }
      $this->voluntarios = implode($voluntarios_array,', ');
    }

  }

  /**
   * Exportar datos de voluntario a fichero .csv
   */
  public function executeExportarCsv(sfWebRequest $request)
  {
    $filters = $this->getUser()->getAttribute('voluntario.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    $filters_form = new VoluntarioFormFilter();
    $query = $filters_form->buildQuery($filters);
    
    $this->voluntarios = $query->fetchArray();

    $query = Doctrine_Query::create()
    ->select('id, nombre, arciprestazgo_id')
    ->from('Parroquia p INDEXBY p.id');
    $this->parroquias = $query->fetchArray(); 

    $query = Doctrine_Query::create()
    ->select('id, nombre, diocesis_id')
    ->from('arciprestazgo a INDEXBY a.id');
    $this->arciprestazgos = $query->fetchArray();

    $query = Doctrine_Query::create()
    ->select('id, nombre')
    ->from('diocesis d INDEXBY d.id');
    $this->diocesis = $query->fetchArray();

    $query = Doctrine_Query::create()
    ->select('id, nombre')
    ->from('Movimiento m INDEXBY m.id');
    $this->movimientos = $query->fetchArray();

    $query = Doctrine_Query::create()
    ->select('id')
    ->from('Equipo e INDEXBY e.id');
    $this->equipos = $query->fetchArray(); 

    $query = Doctrine_Query::create()
    ->select('id, nombre')
    ->from('Provincia p INDEXBY p.id');
    $this->provincias = $query->fetchArray(); 

    $response = $this->getContext()->getResponse();
    $response->setContentType('application/csv');
    $response->addHttpMeta('cache-control', 'no-cache');
    $response->addHttpMeta('Expires', gmdate("D, d M Y H:i:s") . " GMT",time());
    $response->setHttpHeader('Content-Disposition', 'attachment; filename="Voluntarios.csv"');
    $response->setContent($this->getPartial('csv'));
        
    return sfView::NONE;
  }

  /**
   * Exportar datos de voluntario a fichero .csv para policía
   */
  public function executeExportarCsvPolicia(sfWebRequest $request)
  {
    $filters = $this->getUser()->getAttribute('voluntario.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    $filters_form = new VoluntarioFormFilter();
    $query = $filters_form->buildQuery($filters);
    
    $this->voluntarios = $query->execute();

    $response = $this->getContext()->getResponse();
    $response->setContentType('application/csv');
    $response->addHttpMeta('cache-control', 'no-cache');
    $response->addHttpMeta('Expires', gmdate("D, d M Y H:i:s") . " GMT",time());
    $response->setHttpHeader('Content-Disposition', 'attachment; filename="Voluntarios_Policia.csv"');

    $response->setContent($this->getPartial('csv_policia'));
    
    return sfView::NONE;
  }

  /**
   * Exportar datos de voluntario a fichero .csv para pago pasarela Banco Santander
   */
  public function executeExportarCsvPago(sfWebRequest $request)
  {
    $filters = $this->getUser()->getAttribute('voluntario.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    $filters_form = new VoluntarioFormFilter();
    $query = $filters_form->buildQuery($filters);
    
    $this->voluntarios = $query->execute();

    $response = $this->getContext()->getResponse();
    $response->setContentType('application/csv');
    $response->addHttpMeta('cache-control', 'no-cache');
    $response->addHttpMeta('Expires', gmdate("D, d M Y H:i:s") . " GMT",time());
    $response->setHttpHeader('Content-Disposition', 'attachment; filename="Voluntarios_Pago.csv"');

    $response->setContent($this->getPartial('csv_pago'));
    
    return sfView::NONE;
  }

  /**
   * Exportar datos de voluntario a fichero .csv para acreditaciones
   */
  public function executeExportarCsvAcreditacion(sfWebRequest $request)
  {
    $filters = $this->getUser()->getAttribute('voluntario.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    $filters_form = new VoluntarioFormFilter();
    $query = $filters_form->buildQuery($filters);
      
    $this->voluntarios = $query->fetchArray();

    $response = $this->getContext()->getResponse();
    $response->setContentType('application/csv');
    $response->addHttpMeta('cache-control', 'no-cache');
    $response->addHttpMeta('Expires', gmdate("D, d M Y H:i:s") . " GMT",time());
    $response->setHttpHeader('Content-Disposition', 'attachment; filename="Voluntarios_Acreditacion.csv"');

    $response->setContent($this->getPartial('csv_acreditacion'));

    return sfView::NONE;
  }

  /**
   * Ficha Voluntario
   */
  public function executeListFicha(sfWebRequest $request) {
    $this->forward404Unless($this->voluntario = Doctrine::getTable('Voluntario')->find($request->getParameter('id'))); 
    
    /* Construcción de objeto tagging */
    $tagging = new Tagging();
    $tagging->setTaggableModel('Voluntario');
    $tagging->setTaggableId($this->voluntario->getId());
    
    /* Construcción forms */
    $this->gestion_form = new GestionVoluntarioForm($this->voluntario);
    $this->seguridad_form = new SeguridadVoluntarioForm($this->voluntario);
    $this->registro_form = new RegistroVoluntarioForm($this->voluntario);
    $this->alojamiento_form = new AlojamientoVoluntarioForm($this->voluntario);
    $this->transporte_form = new TransporteVoluntarioForm($this->voluntario);
    $this->formacion_form = new EtiquetableForm($tagging);
    $this->tic_form = new TICVoluntarioForm($this->voluntario);

    /* Otros datos varios */
    $this->etiquetas_eventos_seguridad = sfConfig::get('app_etiquetas_eventos_seguridad');
    $this->foto_path = $this->voluntario->getFoto() ? '/uploads/fotos/'.$this->voluntario->getFoto() : '/uploads/fotos/generica.png';
    $this->tareas = $this->voluntario->getTareas();
  }

  /**
   * Función auxiliar para procesar los formularios de la ficha
   */
  private function procesarForm(sfWebRequest $request, $seccion) {
    $params = $request->getParameter('voluntario_'.$seccion); 
    $this->forward404Unless($this->voluntario = Doctrine::getTable('Voluntario')->find($params['id']));
    $form_class = $seccion.'VoluntarioForm';
    $this->form = new $form_class($this->voluntario);
    $this->form->bind($params,$request->getFiles('voluntario_'.$seccion));
    if ($this->form->isValid()) {
      $this->form->save();
      $this->getUser()->setFlash('notice','Los datos de '.$seccion.' de '.$this->voluntario->getNombreCompleto().' han sido actualizados');
      $this->redirect('voluntario/ListFicha?id='.$this->voluntario->getId().'#'.$seccion);
    }
    $this->seccion = $seccion;
    $this->setTemplate('fichaErrorForm');
  }

  /**
   * Ficha Voluntario: Gestión
   */
  public function executeFichaGestion(sfWebRequest $request) {
    if(( $handle=fopen(sfConfig::get('sf_log_dir').'/gestionVoluntario.csv', 'a')) != FALSE ) {

      $postParams = $request->getPostParameters();
      $oldEquipo = Doctrine::getTable('Voluntario')->findOneById($postParams['voluntario_gestion']['id'])->getEquipoId();

      $newEquipo = $postParams['voluntario_gestion']['equipo_id'];
      
      if( $newEquipo != $oldEquipo ) {
        fputcsv($handle, array(sfContext::getInstance()->getUser(), date('d.m.y-G:i'), $postParams['voluntario_gestion']['id'], $oldEquipo, $newEquipo), ';');
        fclose($handle);
      }
    }
    $this->procesarForm($request, 'gestion');
  }

  /**
   * Ficha Voluntario: Seguridad
   */
  public function executeFichaSeguridad(sfWebRequest $request) {
    $this->procesarForm($request, 'seguridad');
  }

  /**
   * Ficha Voluntario: Registro
   */
  public function executeFichaRegistro(sfWebRequest $request) {
    $this->procesarForm($request, 'registro');
  }

  /**
   * Ficha Voluntario: TIC
   */
  public function executeFichaTIC(sfWebRequest $request) {
    $this->procesarForm($request, 'tic');
  }

  /**
   * Ficha Voluntario: Alojamiento
   */
  public function executeFichaAlojamiento(sfWebRequest $request) {
    $this->procesarForm($request, 'alojamiento');
  }

  /**
   * Ficha Voluntario: Transporte
   */
  public function executeFichaTransporte(sfWebRequest $request) {
    $this->procesarForm($request, 'transporte');
  }

  /**
   * Ficha Voluntario: Formación
   */
  public function executeFichaFormacion(sfWebRequest $request) {
    $params = $request->getParameter('tagging');
    $this->forward404Unless($this->voluntario = Doctrine::getTable('Voluntario')->find($params['taggable_id']));
    $this->formacion_form = new EtiquetableForm();
    $this->formacion_form->bind($params);
    if ($this->formacion_form->isValid()) {
      $this->formacion_form->save();
      $this->getUser()->setFlash('notice','Los datos de '.$this->voluntario->getNombreCompleto().' han sido actualizados');
      $this->redirect('voluntario/ListFicha?id='.$this->voluntario->getId().'#formacion');
    }
  }

  /**
   * Eliminar un tag de un voluntario
   */
  public function executeDeleteTag(sfWebRequest $request)
  {
    $this->forward404Unless($this->tagging = Doctrine::getTable('Tagging')->find($request->getParameter('tagging_id')));
    $voluntario_id = $this->tagging->getTaggableId();
    $name = $this->tagging->getTag()->getName();
    $this->tagging->delete();
    $this->getUser()->setFlash('notice', 'Ha sido eliminado: '.$name);
    $this->redirect('voluntario/ListFicha?id='.$voluntario_id);
  }

  /**
   * Marcar que varios voluntarios son No Aptos
   */
  public function executeBatchNoApto(sfWebRequest $request) {
    $ids = $request->getParameter('ids');
    $q = Doctrine_Query::create()->from('Voluntario v')->andWhereIn('v.id',$ids);
    $voluntarios = $q->execute();

    $i=0;
    foreach ($voluntarios as $voluntario) {
      $voluntario->setApto(false);
      $voluntario->save();
      $i++;
    }
    $this->getUser()->setFlash('notice','Se guardó la información de que '.$i.' voluntarios son no aptos');
  }

  /**
   * Exportar e-mail de voluntarios a fichero .txt para utilizar aplicación externa en el envio
   */
  public function executeExportarEmails(sfWebRequest $request)
  {
    $filters = $this->getUser()->getAttribute('voluntario.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    $filters_form = new VoluntarioFormFilter();
    $query = $filters_form->buildQuery($filters);
    $voluntarios = $query->fetchArray();

    foreach($voluntarios as $v){
      $this->emails[] = $v['email'];
    }

    $response = $this->getContext()->getResponse();
    $response->setContentType('application/txt');
    $response->addHttpMeta('cache-control', 'no-cache');
    $response->addHttpMeta('Expires', gmdate("D, d M Y H:i:s") . " GMT",time());
    $response->setHttpHeader('Content-Disposition', 'attachment; filename="emails.txt"');
    $response->setContent($this->getPartial('txt'));
        
    return sfView::NONE;
  }
 
  /**
   * Autocompletar
   */
  public function executeAutocompletar(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');
    
    $q = $request->getParameter('q');
    $limit = $request->getParameter('limit');
    
    $query = Doctrine_Query::create()
      ->from('Voluntario v')
      ->andwhere('v.nombre LIKE ? OR v.primer_apellido LIKE ? OR v.segundo_apellido LIKE ?', array('%'.$q.'%','%'.$q.'%','%'.$q.'%'))
      ->limit($limit);

    $voluntarios = $query->fetchArray();
    $nombres_voluntarios = array();
    
    foreach ($voluntarios as $voluntario) {
      $nombres_voluntarios[$voluntario['id']] = $voluntario['nombre'].' '.$voluntario['primer_apellido'].' '.$voluntario['segundo_apellido'];
    }
    return $this->renderText(json_encode($nombres_voluntarios));
  }

  /**
   * Autocompletar potenciales Jefes de Equipo
   */
  public function executeAutocompletarJefesEquipo(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');
    
    $q = $request->getParameter('q');
    $limit = $request->getParameter('limit');
    
    $query = Doctrine_Query::create()
      ->from('Voluntario v')
      ->where('v.jefe_equipo = ?', true)
      ->andwhere('v.equipo_id IS NULL')
      ->andwhere('v.nombre LIKE ? OR v.primer_apellido LIKE ? OR v.segundo_apellido LIKE ?', array('%'.$q.'%','%'.$q.'%','%'.$q.'%'))
      ->limit($limit);

    $jefes = $query->fetchArray();
    $nombres_jefes = array();
    
    foreach ($jefes as $jefe) {
      $nombres_jefes[$jefe['id']] = $jefe['nombre'].' '.$jefe['primer_apellido'].' '.$voluntario['segundo_apellido'];
    }
    return $this->renderText(json_encode($nombres_jefes));
  }

  /**
   * Generar PDF hoja registro
   */
  public function executeHojaRegistro(sfWebRequest $request) 
  {
    $this->forward404Unless($this->voluntario = Doctrine::getTable('Voluntario')->find($request->getParameter('id')));
    $this->tareas = Doctrine_Query::create()
      ->from('Tarea t INDEXBY t.fecha')
      ->select('t.id, t.nombre, t.fecha, t.franja_horaria, l.nombre, t.descripcion, ev.nombre, v.nombre, v.primer_apellido, v.segundo_apellido')
      ->leftJoin('t.Equipos e')
      ->leftJoin('t.Lugar l')
      ->leftJoin('t.Evento ev')
      ->leftJoin('t.Voluntario v')
      ->where('e.id = '.$this->voluntario->getEquipoId())
      ->orderBy('t.fecha')
      ->fetchArray();

    $latex_code = myLatex::escapeChar($this->getPartial('registro'));
    $response = $this->getContext()->getResponse();
    myLatex::generatePdf($response, 'Hoja registro '.$this->voluntario, $latex_code);
    return sfView::NONE;
  }

  /**
   * Generar PDF
   */
  public function executeHojaTurnos(sfWebRequest $request) 
  {
    $this->forward404Unless($this->voluntario = Doctrine::getTable('Voluntario')->find($request->getParameter('id')));
    $latex_code = myLatex::escapeChar($this->getPartial('turnos'));
    $response = $this->getContext()->getResponse();
    myLatex::generatePdf($response, 'Hoja turnos '.$this->voluntario, $latex_code);
    return sfView::NONE;
  }

  /**
   * Descargar documento de voluntario
   */
  public function executeDescargarDocumento(sfWebRequest $request) 
  {
    $this->forward404Unless($voluntario = Doctrine::getTable('Voluntario')->find($request->getParameter('id')));
    $tipo_documento = $request->getParameter('tipo');
    $documentos_soportados = array('documento_identificacion_personal','documento_acreditacion','documento_compromiso','documento_antecedentes_penales','documento_autorizacion_paterna');
    $this->forward404Unless(in_array($tipo_documento,$documentos_soportados));
    $documento = $voluntario->{'get'.sfInflector::camelize($tipo_documento)}();
    $pathinfo = pathinfo($documento) ;
    $extension = $pathinfo['extension'];
    $response = $this->getContext()->getResponse();
    $response->setContentType('application/'.$extension);
    $response->addHttpMeta('cache-control', 'no-cache');
    $response->addHttpMeta('Expires', gmdate("D, d M Y H:i:s") . " GMT",time());
    $response->setHttpHeader('Content-Disposition', 'attachment; filename="'.$tipo_documento.'-'.$voluntario->getNombreCompleto().'.'.$extension.'"');
    $response->setContent(file_get_contents(sfConfig::get('sf_data_dir').'/documentos/'.$tipo_documento.'/'.$documento));
    return sfView::NONE;
  }

  /**
   * Sobrecarga de new
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new InscripcionVoluntarioForm();
  }

  /**
   * Sobrecarga de create
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new InscripcionVoluntarioForm();

    $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
    if ($this->form->isValid()) {
      $this->voluntario = $this->form->save();
      $this->getUser()->setFlash('notice','El voluntario ha sido inscrito correctamente.');
      $this->redirect('voluntario/index');
    } else {
      $this->setTemplate('new');
    }
  }

  /**
   * Chequear "numero_documento_identificativo" de un csv con voluntarios
   */
  public function executeTestCsv(sfWebRequest $request)
  {
    $this->form = new TestCsvForm();

    if ($request->hasParameter('test_csv')) {
      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
      if ($this->form->isValid()) {
	$fichero = $this->form->getValue('csv');
	$fichero->save('/tmp/'.$fichero->getOriginalName());
	$separador = $this->form->getValue('separador') == '0' ? ';' : ',';
	$columna_id = $this->form->getValue('columna_numero_documento_identificativo') - 1;
	$this->analisis = array();

	if (($handle = fopen('/tmp/'.$fichero->getOriginalName(), "r")) !== FALSE) {
	  if ($this->form->getValue('ignorar_primera_fila')) {
	    fgetcsv($handle, 0, $separador);
	  }
	  while (($data = fgetcsv($handle, 0, $separador)) !== FALSE) {
	    $id = utf8_decode( $data[$columna_id] );
	    $voluntarios = Doctrine::getTable('Voluntario')->findByNumeroDocumentoIdentificativo($id);  
	    $num_voluntarios = $voluntarios->count();
	    if ($num_voluntarios == 0) {
	      $this->analisis[] = 'NO: El voluntario con número identificativo '.$id.' NO existe en la aplicación';
	    } elseif ($num_voluntarios == 1) {
	      $grabar = false;
	      //$grabar = true;
	      if($this->getUser()->getUserName() == 'mzaforas' && $grabar) {
	    	$v = $voluntarios->getFirst();
	    	$v->setPagado(true);
	    	$v->save();
	      }
	      // $this->analisis[] = 'OK: El voluntario '.$id.' SÍ existe en la aplicación y está en equipo '.$voluntarios->getFirst()->getEquipo();
	    } elseif ($num_voluntarios >= 1) {
	      $this->analisis[] = 'REPETIDO: Hay registrados más de un voluntario con el número identificativo "'.$id.'" en la aplicación!';
	    }
	  }
	  if (count($this->analisis) == 0) {$this->analisis[] = 'Todo OK';}
	}
      }
    }
  }

  /**
   * Actualizar datos de pagados
   */
  public function executeActualizarPagados(sfWebRequest $request)
  {
    $this->form = new PagadosForm();
    if ($request->hasParameter('pagados')) {
      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
      if ($this->form->isValid()) {
	$fichero = $this->form->getValue('csv');
	$fichero->save('/tmp/'.$fichero->getOriginalName());

	if (($handle = fopen('/tmp/'.$fichero->getOriginalName(), "r")) !== FALSE) {
	  $line = fgets($handle); // first line
	  while (($data = fgetcsv($handle, 0, "\t")) !== FALSE) {
	    if ($data[2]) {
	      $ids[] = $data[2];
	    } else {
	      $dnis[] = str_replace('=','',str_replace('"','',$data[1]));
	    }
	  }
	}

	$query = Doctrine_Query::create()
	  ->from('Voluntario v')
	  ->whereIn('id', $ids)
	  ->andWhere('pagado = 0');

	$voluntarios = $query->execute();
	$num_voluntarios = $voluntarios->count();

	foreach ($voluntarios as $v) {
	  $v->setPagado(true);
	  $v->save();
	}
	if( isset($dnis) )
	{
	  $query = Doctrine_Query::create()
	    ->from('Voluntario v')
	    ->whereIn('numero_documento_identificativo', $dnis)
	    ->andWhere('pagado = 0');

	  $voluntarios = $query->execute();
	  $num_voluntarios += $voluntarios->count();

	  foreach ($voluntarios as $v) {
	    $v->setPagado(true);
	    $v->save();
	  }
	}
	$this->getUser()->setFlash('notice', "Se han fijado como pagados $num_voluntarios nuevos voluntarios");
	$this->redirect('voluntario/index');
      }
    }
  }

  /**
   * Esta accion solo puede ser ejecutada por el admin.
   * Se puede reprogramar sobre ella para ajecutar acciones ad-hoc puntuales sobre un conjunto de voluntarios filtrados
   */
  public function executeAdmin(sfWebRequest $request)
  {
    $filters = $this->getUser()->getAttribute('voluntario.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    $filters_form = new VoluntarioFormFilter();
    $query = $filters_form->buildQuery($filters);
    
    $voluntarios = $query->execute();

    foreach($voluntarios as $v) {
      
      copy('/mnt/newDisk/fotos/'.$v->getFoto(), '/mnt/newDisk/fotos_para_dnet/'.$v->getFoto());
      //$v->save();
    }

      //      $v->setPagado(true);
      
      //      $v->setRegistrado(false);
      //      $v->setNumeroDocumentoIdentificativo(str_replace(' ','',$v->getNumeroDocumentoIdentificativo()));
    $this->redirect('voluntario/index');
  }

  public function executeEnviarEncuesta(sfWebRequest $request) 
  {
    $filters = $this->getUser()->getAttribute('voluntario.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    $filters_form = new VoluntarioFormFilter();
    $query = $filters_form->buildQuery($filters);
    
    $destinatarios = $query->execute()->toKeyValueArray('id','email');
    //dieh($destinatarios);

    foreach($destinatarios as $k => $v) {
    //  $destinatarios[] = $v->getEmail();
      $cuerpo = "<p>Estimados amigos,</p><p>Nos ponemos en contacto de nuevo  con vosotros para animaros a participar  en esta encuesta que nos propone la Universidad Católica de Valencia. Es una encuesta muy breve que se rellena en 10 minutos. El objetivo de la misma es obtener el perfil de los voluntarios de la Jornada Mundial de la Juventud así como su percepción de la experiencia de voluntariado. La encuesta consta de dos partes: una previa a la Jornada que recoge las expectativas de los voluntarios  y que ya habéis  realizado y esta encuesta  posterior que refleja la experiencia que se ha tenido. En este correo os incluimos el <a href='http://encuestavoluntariosjmj.net/es?vol=".$k."'>enlace</a> para la segunda de ellas.</p><p>Muchas gracias por vuestra colaboración en esta iniciativa tan interesante!</p><p>Atentamente,</p><p>Departamento de Voluntariado JMJ</p><hr><p>Dear friends,</p><p>We contact you again  to invite you all to participate in this survey carried out by the Catholic University from Valencia. It is a very brief survey, just 10 minutes to fill in. Its objective is to obtain the WYD volunteers profile as well as their perception of the experience of volunteering. The survey consists of two parts: one before the WYD to gather the expectations of the volunteers and another one after the WYD that reflects the final experience. In this mail we include the <a href='http://encuestavoluntariosjmj.net/es?vol=".$k."'>link</a> for the second  one.</p><p>Thank you very much for your cooperation in this interesting initiative.</p><p>Yours faithfully,</p><p>WYD Volunteering Department.</p>";
    //if( $v->getIdIdioma() == 1 ) {
      $header = "Encuesta 2 de voluntarios - Volunteers survey 2";
      //$cuerpo = "<p>Estimados amigos,</p><p>Nos ponemos en contacto con vosotros para animaros a participar en esta encuesta que nos propone la Universidad Católica de Valencia. Es una encuesta muy breve que se rellena en 10 minutos. El objetivo de la misma es obtener el perfil de los voluntarios de la Jornada Mundial de la Juventud así como su percepción de la experiencia de voluntariado. La encuesta consta de dos partes: una previa a la Jornada que recoge las expectativas de los voluntarios y una posterior que refleja la experiencia que se ha tenido. En este correo os incluimos el <a href='http://encuestavoluntariosjmj.net/es?vol=".$k."'>enlace</a> para la primera de ellas.</p><p>Muchas gracias por vuestra colaboración en esta iniciativa tan interesante!</p><p>Atentamente,</p><p>Departamento de Voluntariado JMJ</p>";

    //    MailManager::enviarMail(array($v), $header, $cuerpo);
    //} else {
      //$cuerpo2 = "<p>Dear friends,</p><p>We contact you to invite you all to participate in this survey carried out by the Catholic University from Valencia. It is a very brief survey, just 10 minutes to fill in. Its objective is to obtain the WYD volunteers profile as well as their perception of the experience of volunteering. The survey consists of two parts: one before the WYD to gather the expectations of the volunteers and another one after the WYD that reflects the final experience. In this mail we include the <a href='http://encuestavoluntariosjmj.net/es?vol=".$k."'>link</a> for the first one.</p><p>Thank you very much for your cooperation in this interesting initiative.</p><p>Yours faithfully,</p><p>WYD Volunteering Department.</p>";
    //}
    MailManager::enviarMail(array($v), $header, $cuerpo);
    }
    $this->redirect('voluntario/index');
  }
}
