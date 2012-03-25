<?php

require_once dirname(__FILE__).'/../lib/equipoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/equipoGeneratorHelper.class.php';

/**
 * equipo actions.
 *
 * @package    voluntarios
 * @subpackage equipo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class equipoActions extends autoEquipoActions
{
  /**
   * Ficha equipo
   */
  public function executeListFicha(sfWebRequest $request)
  {
    $this->forward404Unless($this->equipo = Doctrine::getTable('Equipo')->find($request->getParameter('id')));
    $this->miembros = Doctrine_Query::create()
      ->from('Voluntario v')
      ->leftJoin('v.Movimiento')
      ->where('equipo_id = ?',$this->equipo->getId())
      ->orderBy('primer_apellido')
      ->execute();
    $this->perfiles = $this->equipo->getPerfiles();
    $this->tareas = $this->equipo->getTareas();
    $this->email_form = new EmailForm();
  }

  /**
   * Autocompletado Ajax
   */
  public function executeAutocompletar(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');
   
    $q = $request->getParameter('q');
    $limit = $request->getParameter('limit');
    
    $query = Doctrine_Query::create()
      ->from('Equipo e')
      ->where('e.id LIKE ?', '%'.$q.'%');
    
    $equipos = $query->execute();
    $nombres_equipos = array();
    
    foreach ($equipos as $equipo) {
      $nombres_equipos[$equipo->getId()] = $equipo->__toString();
    }
    return $this->renderText(json_encode($nombres_equipos));
  }

  /**
   * Enviar email
   */
  public function executeEnviarEmail(sfWebRequest $request)
  {
    $form = new EmailForm();
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    $this->forward404Unless($equipo = Doctrine::getTable('Equipo')->find($request->getParameter('equipo_id')));
    $q = Doctrine_Query::create()
      ->from('Voluntario v')
      ->select('v.email')
      ->where('equipo_id = '.$equipo->getId());
    $destinatarios = $q->execute()->toKeyValueArray('id','email');
    $num_destinatarios = MailManager::enviarMail($destinatarios, $form->getValue('asunto'), $form->getValue('cuerpo'), $form->getValue('adjunto'));
    $this->getUser()->setFlash('notice','El correo electrónico ha sido enviado a '.$num_destinatarios.' voluntarios');
    $this->redirect('equipo/ListFicha?id='.$equipo->getId());
  }

  /**
   * Generar PDF
   */
  public function executeGenerarPdf(sfWebRequest $request)
  {
    $this->forward404Unless($this->equipo = Doctrine::getTable('Equipo')->find($request->getParameter('id')));
    $this->miembros = $this->equipo->getVoluntarios();
    $this->tareas = Doctrine_Query::create()
      ->from('Tarea t')
      ->select('t.id, t.nombre, t.fecha, t.franja_horaria, l.nombre, t.descripcion, ev.nombre, v.nombre, v.primer_apellido, v.segundo_apellido')
      ->leftJoin('t.Equipos e')
      ->leftJoin('t.Lugar l')
      ->leftJoin('t.Evento ev')
      ->leftJoin('t.Voluntario v')
      ->where('e.id = '.$this->equipo->getId())
      ->orderBy('t.fecha')
      ->fetchArray();

    $latex_code = myLatex::escapeChar($this->getPartial('pdf'));
    $response = $this->getContext()->getResponse();
    myLatex::generatePdf($response, 'Ficha '.$this->equipo, $latex_code);
    return sfView::NONE;
  }

  /**
   * Exportar datos de equipo a fichero .csv
   */
  public function executeExportarCsv(sfWebRequest $request)
  {
    $filters = $this->getUser()->getAttribute('equipo.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    $filters_form = new EquipoFormFilter();
    $query = $filters_form->buildQuery($filters);
    
    $this->equipos = $query->execute();
    $response = $this->getContext()->getResponse();
    $response->setContentType('application/csv');
    $response->addHttpMeta('cache-control', 'no-cache');
    $response->addHttpMeta('Expires', gmdate("D, d M Y H:i:s") . " GMT",time());
    $response->setHttpHeader('Content-Disposition', 'attachment; filename="Equipos.csv"');
    $response->setContent($this->getPartial('csv'));
        
    return sfView::NONE;
  }

  /**
   * Esta accion solo puede ser ejecutada por el admin.
   * Se puede reprogramar sobre ella para ajecutar acciones ad-hoc puntuales sobre un conjunto de equipos filtrados
   */
  public function executeAdmin(sfWebRequest $request)
  {
    $filters = $this->getUser()->getAttribute('equipo.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    $filters_form = new EquipoFormFilter();
    $query = $filters_form->buildQuery($filters);
    
    $equipos = $query->execute();
    
    $i=0;
    foreach ($equipos as $e) {
      foreach ($e->getVoluntarios() as $v) {
	$v->setRegistrado(true);
	$v->save(); 
      }
      //    $e->setAcreditable(true); 
      /* $ep = new PerfilEquipo(); */
      /* $ep->setEquipoId($e->getId()); */
      /* $ep->setPerfilId(5); */
      /* $ep->save(); */
	      //    $e->save(); 
    } 
    $this->redirect('equipo/index');
  }
}
