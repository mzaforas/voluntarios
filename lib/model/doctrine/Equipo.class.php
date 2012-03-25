<?php

/**
 * Equipo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    voluntarios
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Equipo extends BaseEquipo
{

  public function __toString() {
    return $this->getId() ? 'Equipo '.$this->getId() : '';
  }

  public function getNombreCompleto() {
    return $this->getId() ? $this->getId().' - '.$this->getNombre() : '';
  }

  /**
   * El jefe del equipo
   */
  public function getJefe() {
    return Doctrine_Query::create()
      ->from('Voluntario v')
      ->where('v.equipo_id = ?',$this->getId())
      ->andwhere('v.jefe_equipo = ?',true)
      ->fetchOne();
  }

  /**
   * Numero de miembros asignadas al equipo
   */
  public function getNumeroMiembros()
  {
    $q = Doctrine_Query::create()
      ->from('Voluntario v')
      ->select('COUNT(id)')
      ->where('v.equipo_id = ?',$this->getId());
    return $q->fetchOne()->get('COUNT');
  }

  /**
   * Numero de tareas asignadas al equipo
   */
  public function getNumeroTareas()
  {
    return $this->getTareas()->count();
  }

  /**
   *
   * Como opción se le puede pasar una tarea, la cual no será tenida en
   * cuenta a la hora de comprabar la disponibilidad (Caso de editar una
   * Tarea que tiene asignados equipos)
   */
  public function estaDisponible($fecha, $franja, $tarea_referencia=null)
  {
    foreach($this->getTareas() as $tarea) {
      // Para que cuando se edita una tarea no la tenga en cuenta en computos de disponibilidad (va a cambiar)
      if( $tarea_referencia and $tarea_referencia->getId() == $tarea->getId() )
        continue;
      
      if($tarea->getFecha() == $fecha) {
        if($fecha == '2011-08-20' //and $tarea->getFecha() == $fecha
         and !EquipoTable::coincideFranjaHoraria($franja,$tarea->getFranjaHoraria())) {
          continue;
        } else       // Para el resto de dias. Coincidir en fecha es no estarlo
          return false;
      }
        /*
      if($tarea->getFecha() == $fecha) {
        return false;
        }*/
    }
    return true;
  }
  //	if (($tarea->getFranjaHoraria() != $nueva_franja) && (!EquipoTable::isEquipoDisponible($equipo, $nueva_fecha, $nueva_tarea))) {

  /**
   * Devuelve true si el equipo esta libre para dicha fecha y franaja.
   * Como opción se le puede pasar una tarea, la cual no será tenida en
   * cuenta a la hora de comprabar la disponibilidad (Caso de editar una
   * Tarea que tiene asignados equipos)
   */
  /* public function isEquipoDisponible($fecha, $franja, $tarea_referencia=null) */
  /* { */
  /*   $tareas = $this->getTareas(); */
  /*   $tarea_ref = ''; */
  /*   if( isset($tarea_referencia) ) */
  /*   { */
  /*     $tarea_ref = $tarea_referencia; */
  /*   } */
  /*   foreach($tareas as $tarea) { */
  /*     if( isset($tarea_referencia) and  */
  /*         $tarea->getId() == $tarea_referencia->getId()) */
  /*       continue; // Si es la tarea de referencia, lo salta */
  /*     //      if( $tarea->getFecha() == $fecha  and EquipoTable::coincideFranjaHoraria($franja,$tarea->getFranjaHoraria())) { */
  /*     if($tarea->getFecha() == $fecha) { */
  /*       return false; */
  /*     } */
  /*   } */
  /*   return true; */
  /* } */

  /**
   * Contains 
   */
  public function tienePerfil($perfil_id)
  {
    foreach($this->getPerfiles() as $p)
    {
      if( $p->getId() == $perfil_id)
        return true;
    }
    return false;
  }

  public function getPerfilesString() {
    $perfiles = array();
    foreach($this->getPerfiles() as $perfil) {
      $perfiles[] = $perfil->__toString();
    }
    return implode(', ',$perfiles);
  }

  public function getPagados() 
  {
    $q = Doctrine_Query::create()
      ->from('Voluntario v')
      ->select('COUNT(id)')
      ->where('v.equipo_id = ?',$this->getId())
      ->andWhere('v.pagado = 1');
    return $q->fetchOne()->get('COUNT');
  }

  public function getFotos() 
  {
    $q = Doctrine_Query::create()
      ->from('Voluntario v')
      ->select('COUNT(id)')
      ->where('v.equipo_id = ?',$this->getId())
      ->andWhere('v.foto != ""');
    return $q->fetchOne()->get('COUNT');
  }

  public function getAcreditados() 
  {
    $q = Doctrine_Query::create()
      ->from('Voluntario v')
      ->select('COUNT(id)')
      ->where('v.equipo_id = ?',$this->getId())
      ->andWhere('v.acreditado = 1');
    return $q->fetchOne()->get('COUNT');
  }
}