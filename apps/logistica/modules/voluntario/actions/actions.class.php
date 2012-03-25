<?php

/**
 * voluntario actions.
 *
 * @package    voluntarios
 * @subpackage voluntario
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class voluntarioActions extends sfActions
{
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

}
