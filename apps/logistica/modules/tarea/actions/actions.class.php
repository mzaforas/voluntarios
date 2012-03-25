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
    $this->radioportatiles_asignados = RadioportatilTable::asignados($this->tarea);
    $this->radioportatiles_disponibles = RadioportatilTable::disponibles($this->tarea);
  }

}
