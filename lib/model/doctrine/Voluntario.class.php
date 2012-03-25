<?php

/**
 * Voluntario
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    voluntarios
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class Voluntario extends BaseVoluntario
{
  public function __toString() {
    return $this->getNombreCompleto();
  } 

  public function getNombreCompleto() {
    return $this->getNombre().' '.$this->getPrimerApellido().' '.$this->getSegundoApellido();
  }

  public function getDiocesis() {
    return $this->getParroquiaId() ? $this->getParroquia()->getDiocesis() : "";
  }

  public function getTieneFoto() {
    return ($this->getFoto() != '');
  }

  public function getIdIdioma() {
    $id_ingles = 4;
    $codigo_pais = $this->getPais();

    if ($codigo_pais) {
      $pais = Doctrine::getTable('Pais')->findOneBy('codigo',$codigo_pais);
    } else {
      return $id_ingles;
    }

    if ($pais) {
      $id_idioma = $pais->getIdIdioma();
    } else {
      return $id_ingles;
    }

    if ($id_idioma) {
      return $id_idioma;
    } else {
      return $id_ingles;
    }
  }
}