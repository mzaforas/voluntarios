<?php

/**
 * parroquia actions.
 *
 * @package    voluntarios
 * @subpackage parroquia
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class parroquiaActions extends sfActions
{
  public function executeAutocompletar(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');
    
    $q = $request->getParameter('q');
    $limit = $request->getParameter('limit');
    
    $query = Doctrine_Query::create()
      ->from('Parroquia p')
      ->where('p.nombre LIKE ?', '%'.$q.'%');
    
    $parroquias = $query->fetchArray();
    $nombres_parroquias = array();
    
    foreach ($parroquias as $parroquia) {
      $nombres_parroquias[$parroquia['id']] = $parroquia['nombre'].' ('.$parroquia['municipio'].')';
    }
    return $this->renderText(json_encode($nombres_parroquias));
  }
}
