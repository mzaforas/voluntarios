<?php

require_once dirname(__FILE__).'/../lib/lugarGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/lugarGeneratorHelper.class.php';

/**
 * lugar actions.
 *
 * @package    voluntarios
 * @subpackage lugar
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class lugarActions extends autoLugarActions
{
  /**
   * Ficha lugar
   */
  public function executeListFicha(sfWebRequest $request)
  {
    $this->forward404Unless($this->lugar = Doctrine::getTable('Lugar')->find($request->getParameter('id')));
  }

}
