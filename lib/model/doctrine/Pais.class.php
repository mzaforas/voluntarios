<?php

/**
 * Pais
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    voluntarios
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Pais extends BasePais
{
  public function getIdIdioma() {
    $idioma_pais = Doctrine::getTable('IdiomaPais')->findOneBy('pais_id',$this->getId());
    if ($idioma_pais) {
      return $idioma_pais->getIdiomaId();
    } else {
      return null;
    }
  }
}
