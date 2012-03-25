<?php

/**
 * Turno
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    voluntarios
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Turno extends BaseTurno
{
  public function __toString() {
    return $this->getNombre();
  } 

  public function getVoluntariosDisponibles() {
    $connection = Doctrine_Manager::getInstance()->getCurrentConnection();
    return $connection->fetchAssoc('
      SELECT * FROM voluntario
      WHERE equipo_id = 19 AND id NOT IN
        (SELECT tv.voluntario_id FROM turno_voluntario tv
           WHERE tv.turno_id = '.$this->getId().')
      ORDER BY voluntario.primer_apellido');
  }

  public function getVoluntariosAsignados() {
    $connection = Doctrine_Manager::getInstance()->getCurrentConnection();
    return $connection->fetchAssoc('
      SELECT * FROM voluntario
      WHERE equipo_id = 19 AND id IN
        (SELECT tv.voluntario_id FROM turno_voluntario tv
           WHERE tv.turno_id = '.$this->getId().')
      ORDER BY voluntario.primer_apellido');
  }

}