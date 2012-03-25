<?php

/**
 * BaseEvento
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $nombre
 * @property string $descripcion
 * @property integer $lugar_id
 * @property timestamp $comienzo
 * @property timestamp $fin
 * @property Lugar $Lugar
 * @property Doctrine_Collection $Tareas
 * 
 * @method string              getNombre()      Returns the current record's "nombre" value
 * @method string              getDescripcion() Returns the current record's "descripcion" value
 * @method integer             getLugarId()     Returns the current record's "lugar_id" value
 * @method timestamp           getComienzo()    Returns the current record's "comienzo" value
 * @method timestamp           getFin()         Returns the current record's "fin" value
 * @method Lugar               getLugar()       Returns the current record's "Lugar" value
 * @method Doctrine_Collection getTareas()      Returns the current record's "Tareas" collection
 * @method Evento              setNombre()      Sets the current record's "nombre" value
 * @method Evento              setDescripcion() Sets the current record's "descripcion" value
 * @method Evento              setLugarId()     Sets the current record's "lugar_id" value
 * @method Evento              setComienzo()    Sets the current record's "comienzo" value
 * @method Evento              setFin()         Sets the current record's "fin" value
 * @method Evento              setLugar()       Sets the current record's "Lugar" value
 * @method Evento              setTareas()      Sets the current record's "Tareas" collection
 * 
 * @package    voluntarios
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEvento extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('evento');
        $this->hasColumn('nombre', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('descripcion', 'string', 4000, array(
             'type' => 'string',
             'length' => 4000,
             ));
        $this->hasColumn('lugar_id', 'integer', 8, array(
             'type' => 'integer',
             'length' => 8,
             ));
        $this->hasColumn('comienzo', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             ));
        $this->hasColumn('fin', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Lugar', array(
             'local' => 'lugar_id',
             'foreign' => 'id'));

        $this->hasMany('Tarea as Tareas', array(
             'local' => 'id',
             'foreign' => 'evento_id'));
    }
}