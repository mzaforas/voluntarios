<?php

/**
 * BaseIdioma
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $nombre
 * @property Doctrine_Collection $IdiomaPais
 * 
 * @method string              getNombre()     Returns the current record's "nombre" value
 * @method Doctrine_Collection getIdiomaPais() Returns the current record's "IdiomaPais" collection
 * @method Idioma              setNombre()     Sets the current record's "nombre" value
 * @method Idioma              setIdiomaPais() Sets the current record's "IdiomaPais" collection
 * 
 * @package    voluntarios
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseIdioma extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('idioma');
        $this->hasColumn('nombre', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('IdiomaPais', array(
             'local' => 'id',
             'foreign' => 'idioma_id'));
    }
}