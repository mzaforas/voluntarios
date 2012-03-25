<?php

require_once dirname(__FILE__).'/../lib/turnoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/turnoGeneratorHelper.class.php';

/**
 * turno actions.
 *
 * @package    voluntarios
 * @subpackage turno
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class turnoActions extends autoTurnoActions
{
  /**
   * Ficha Turno
   */
  public function executeListFicha(sfWebRequest $request)
  {
    $this->forward404Unless($this->turno = Doctrine::getTable('Turno')->find($request->getParameter('id')));
    $this->voluntarios_asignados = $this->turno->getVoluntariosAsignados();
    $this->voluntarios_disponibles = $this->turno->getVoluntariosDisponibles();
  }

  public function executeAsignar(sfWebRequest $request)
  {
    $this->forward404Unless($turno = Doctrine::getTable('Turno')->find($request->getParameter('turno_id')));
    $this->forward404Unless($voluntario = Doctrine::getTable('Voluntario')->find($request->getParameter('voluntario_id')));
    $tv = new TurnoVoluntario();
    $tv->setTurnoId($turno->getId());
    $tv->setVoluntarioId($voluntario->getId());
    $tv->save();
    $this->redirect('turno/ListFicha?id='.$turno->getId().'#voluntarios');
  }

  public function executeDesasignar(sfWebRequest $request)
  {
    $this->forward404Unless($turno_voluntario = Doctrine::getTable('TurnoVoluntario')->findOneByTurnoIdAndVoluntarioId($request->getParameter('turno_id'), $request->getParameter('voluntario_id')));
    $turno = $turno_voluntario->getTurno();
    $voluntario = $turno_voluntario->getVoluntario();
    $turno_voluntario->delete();
    $this->redirect('turno/ListFicha?id='.$turno->getId().'#voluntarios');
  }

}
