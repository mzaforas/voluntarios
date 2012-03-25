<?php

require_once dirname(__FILE__).'/../lib/radioportatilGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/radioportatilGeneratorHelper.class.php';

/**
 * radioportatil actions.
 *
 * @package    voluntarios
 * @subpackage radioportatil
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class radioportatilActions extends autoRadioportatilActions
{
  /**
   * Ficha Radio Portatil
   */
  public function executeListFicha(sfWebRequest $request)
  {
    $this->forward404Unless($this->radioportatil = Doctrine::getTable('Radioportatil')->find($request->getParameter('id')));
    $this->radioportatil_tareas = $this->radioportatil->getRadioportatilTareas();
  }

  public function executeAsignar(sfWebRequest $request)
  {
    $this->forward404Unless($this->radioportatil = Doctrine::getTable('Radioportatil')->find($request->getParameter('radioportatil_id')));
    $this->forward404Unless($this->tarea = Doctrine::getTable('Tarea')->find($request->getParameter('tarea_id')));

    if ($request->hasParameter('voluntario_id')) {
      $this->forward404Unless($this->voluntario = Doctrine::getTable('Voluntario')->find($request->getParameter('voluntario_id')));
      $tarea_radioportatil = new TareaRadioportatil();
      $tarea_radioportatil->setRadioportatilId($this->radioportatil->getId());
      $tarea_radioportatil->setTareaId($this->tarea->getId());
      $tarea_radioportatil->setVoluntarioId($this->voluntario->getId());
      $tarea_radioportatil->save();
      $this->getUser()->setFlash('notice','El radioportatil '.$this->radioportatil.' ha sido asignado a la tarea '.$this->tarea.' bajo la responsabilidad de '.$this->voluntario);
      $this->redirect('radioportatil/index');
    } else {
      $this->voluntarios = $this->tarea->getVoluntarios();
    }
  }

  public function executeDesasignar(sfWebRequest $request)
  {
    $this->forward404Unless($tarea_radioportatil = Doctrine::getTable('TareaRadioportatil')->findOneByTareaIdAndRadioportatilId($request->getParameter('tarea_id'), $request->getParameter('radioportatil_id')));
    $radioportatil = $tarea_radioportatil->getRadioportatil();
    $tarea = $tarea_radioportatil->getTarea();
    $tarea_radioportatil->delete();
    $this->getUser()->setFlash('notice','El radioportatil '.$radioportatil.' ha sido desasignado de la tarea '.$tarea);
    $this->redirect('tarea/ListFicha?id='.$request->getParameter('tarea_id').'#radioportatiles');
  }

  public function executeDisponibilidad(sfWebRequest $request)
  {
    $this->dia = $request->getParameter('dia',8);
    $this->radioportatiles =  Doctrine_Query::create()
      ->from('Radioportatil r')
      ->leftJoin('r.RadioportatilTareas rt')
      ->leftJoin('rt.Tarea t')
      ->execute();
  }

  public function executeFirmas(sfWebRequest $request)
  {
    if ($request->hasParameter('evento_id')) {
      $this->evento = Doctrine::getTable('Evento')->find($request->getParameter('evento_id'));
      $this->tareas = $this->evento->getTareas();
      $latex_code = myLatex::escapeChar($this->getPartial('firmas'));
      $response = $this->getContext()->getResponse();
      myLatex::generatePdf($response, 'Hoja de firmas '.$this->evento, $latex_code);
      return sfView::NONE;
    } else {
      $this->eventos = Doctrine_Query::create()->from('Evento')->execute();
    }
  }

}
