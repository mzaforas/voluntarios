<?php

require_once dirname(__FILE__).'/../lib/tareaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/tareaGeneratorHelper.class.php';

/**
 * tarea actions.
 *
 * @package    voluntarios
 * @subpackage tarea
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tareaActions extends autoTareaActions
{
  public function executeCalendario(sfWebRequest $request) {
    $calendario = new sfiCalCalendar();
    $calendario->setConfig( "unique_id", "voluntariosjmj2011.archimadrid.eu/tarea" );
    $calendario->setProperty( "X-WR-CALNAME", "Calendario de tareas" );
    $calendario->setProperty( "X-WR-CALDESC", "Calendario de tareas a realizar por los voluntarios de la JMJ" );
    $calendario->setProperty( "X-WR-TIMEZONE", "Etc/GMT+1" );

    $q = Doctrine_Query::create()->from('Tarea t');
    $tareas = $q->execute();

    foreach ($tareas as $tarea) {
      $e = new sfiCalEvent();                             
      $e->setProperty( 'summary', $tarea->getNombre());
      $comienzo = $tarea->getDateTimeObject('fecha');
      $year = $comienzo->format('Y');
      $month = $comienzo->format('m');
      $day = $comienzo->format('d');
      $hora_comienzo = $tarea->getHoraComienzo();
      $hora_fin = $tarea->getHoraFin();
      if ($hora_comienzo && $hora_fin) {
	$hora_comienzo_descompuesta = explode(':',$hora_comienzo);
	$hour = (int)$hora_comienzo_descompuesta[0];
	$minute = (int)$hora_comienzo_descompuesta[1];
	$second = (int)$hora_comienzo_descompuesta[2];
	$duration = strtotime($hora_fin) - strtotime($hora_comienzo);
	$duration_horas = floor($duration / 3600);
	$duration_minutos = floor(($duration % 3600) / 60);
      } else {
	switch ($tarea->getFranjaHoraria()) {
	case 'Mañana':
	  $hour = 9;
	  $duration_horas = 6;
	  break;
	case 'Tarde':
	  $hour = 15;
	  $duration_horas = 6;
	  break;
	case 'Mañana y Tarde':
	  $hour = 9;
	  $duration_horas = 12;
	  break;
	case 'Noche':
	  $hour = 21;
	  $duration_horas = 6;
	  break;
	default:
	  $hour = 0;
	  $duration_horas = 0;
	}
	$minute = 0;
	$second = 0;
	$duration_minutos = 0;
      }
      $e->setProperty( 'categories', $tarea->getEvento() );     
      $e->setProperty( 'dtstart',  $year, $month, $day, $hour, $minute, $second );  

      $duration_hours = 6;
      $e->setProperty( 'duration', 0, 0, $duration_horas, $duration_minutos);
      $e->setProperty( 'description', $tarea->getDescripcion().'\nResponsable: '.$tarea->getVoluntario().'\nPerfil: '.$tarea->getPerfil());
      $e->setProperty( 'location', $tarea->getLugar());   
      $calendario->addComponent( $e );                    
    }

    /* alt. production */
    $calendario->returnCalendar();               // generate and redirect output to user browser

    /* alt. dev. and test */
    $this->ical = $calendario->createCalendar(); // generate and get output in string, for testing?
    dieh($this->ical);
    return sfView::NONE;
  }

  /**
   * Ficha de tarea
   */
  public function executeListFicha(sfWebRequest $request) {
    $this->forward404Unless($this->tarea = Doctrine::getTable('Tarea')->find($request->getParameter('id')));    
    $q = Doctrine_Query::create()
      ->from('Equipo e')
      ->leftJoin('e.Tareas t')
      ->leftJoin('e.Perfiles p')
      ->leftJoin('e.Voluntarios v')
      ->where('t.id = '.$this->tarea->getId());
    $this->equipos_asignados = $q->execute();
    $this->equipos_disponibles = EquipoTable::getDisponibles($this->tarea);
  }

  /**
   * Desasignar equipo de tarea
   */
  public function executeDesasignarEquipo(sfWebRequest $request) {
    $this->forward404Unless($this->tarea_equipo = Doctrine::getTable('TareaEquipo')->findOneByTareaIdAndEquipoId($request->getParameter('tarea_id'),$request->getParameter('equipo_id')));
    $this->getUser()->setFlash('notice','El '.$this->tarea_equipo->getEquipo().' ha sido desasignado de la Tarea '.$this->tarea_equipo->getTareaId());
    $tarea = $this->tarea_equipo->getTarea();
    $this->tarea_equipo->delete();
    $tarea->actualizarEstado();
    $this->redirect('tarea/ListFicha?id='.$request->getParameter('tarea_id').'#equipos');
  }

  /**
   * Asignar equipo a tarea
   */
  public function executeAsignarEquipo(sfWebRequest $request) {
    $this->tarea_equipo = new TareaEquipo();
    $this->tarea_equipo->setEquipoId($request->getParameter('equipo_id'));
    $this->tarea_equipo->setTareaId($request->getParameter('tarea_id'));
    $this->tarea_equipo->save();
    $this->tarea_equipo->getTarea()->actualizarEstado();
    $this->getUser()->setFlash('notice','El '.$this->tarea_equipo->getEquipo().' ha sido asignado a la Tarea '.$this->tarea_equipo->getTareaId());
    $this->redirect('tarea/ListFicha?id='.$request->getParameter('tarea_id').'#equipos');
  }

  /**
   * Generar PDF
   */
  public function executeGenerarPdf(sfWebRequest $request)
  {
    $this->forward404Unless($this->tarea = Doctrine::getTable('Tarea')->find($request->getParameter('id')));
    $q = Doctrine_Query::create()
      ->from('Equipo e')
      ->leftJoin('e.Tareas t')
      ->leftJoin('e.Perfiles p')
      ->leftJoin('e.Voluntarios v')
      ->where('t.id = '.$this->tarea->getId());
    $this->equipos_asignados = $q->execute();

    $latex_code = myLatex::escapeChar($this->getPartial('pdf'));
    $response = $this->getContext()->getResponse();
    myLatex::generatePdf($response, 'Ficha tarea '.$this->tarea->getId(), $latex_code);
    return sfView::NONE;
  }

  /**
   * Esta accion solo puede ser ejecutada por el admin.
   * Se puede reprogramar sobre ella para ajecutar acciones ad-hoc puntuales sobre un conjunto de tareas filtrados
   */
  public function executeAdmin(sfWebRequest $request)
  {
    $filters = $this->getUser()->getAttribute('tarea.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    $filters_form = new TareaFormFilter();
    $query = $filters_form->buildQuery($filters);
    
    $tareas = $query->execute();
    
    $descripcion = '8.00 h, punto de encuentro Acceso 1';
    foreach ($tareas as $t) {
      if ($t->getDescripcion()) {
	$t->setDescripcion($t->getDescripcion().'. '.$descripcion);
      } else {
	$t->setDescripcion($descripcion);
      }
      //      $t->save(); 
    } 
    $this->redirect('tarea/index');
  }

  public function executeEnviarMail(sfWebRequest $request)
  {
    $filters = $this->getUser()->getAttribute('tarea.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    $filters_form = new TareaFormFilter();
    $query = $filters_form->buildQuery($filters);

    $tareas = $query->execute();
    
    foreach ($tareas as $t) {
      foreach($t->getEquipos() as $e){
	foreach($e->getVoluntarios() as $v) {
	  $destinatarios[] = $v->getEmail();
	}
      }
    }
    dieh($destinatarios);
    $header="";
    $body="";
    MailManager::enviarEmail($destinatarios,$header,$body);
  }

}
