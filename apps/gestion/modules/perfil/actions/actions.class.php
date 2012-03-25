<?php

require_once dirname(__FILE__).'/../lib/perfilGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/perfilGeneratorHelper.class.php';

/**
 * perfil actions.
 *
 * @package    voluntarios
 * @subpackage perfil
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class perfilActions extends autoPerfilActions
{
  /**
   * Ficha perfil
   */
  public function executeListFicha(sfWebRequest $request)
  {
    $this->forward404Unless($this->perfil = Doctrine::getTable('Perfil')->find($request->getParameter('id')));
    $this->equipos = $this->perfil->getEquipos();
  }
}
