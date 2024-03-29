<?php

/**
 * BaseIdiomaPais
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $pais_id
 * @property integer $idioma_id
 * @property Pais $Pais
 * @property Idioma $Idioma
 * 
 * @method integer    getPaisId()    Returns the current record's "pais_id" value
 * @method integer    getIdiomaId()  Returns the current record's "idioma_id" value
 * @method Pais       getPais()      Returns the current record's "Pais" value
 * @method Idioma     getIdioma()    Returns the current record's "Idioma" value
 * @method IdiomaPais setPaisId()    Sets the current record's "pais_id" value
 * @method IdiomaPais setIdiomaId()  Sets the current record's "idioma_id" value
 * @method IdiomaPais setPais()      Sets the current record's "Pais" value
 * @method IdiomaPais setIdioma()    Sets the current record's "Idioma" value
 * 
 * @package    voluntarios
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseIdiomaPais extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('idioma_pais');
        $this->hasColumn('pais_id', 'integer', 8, array(
             'type' => 'integer',
             'length' => 8,
             ));
        $this->hasColumn('idioma_id', 'integer', 8, array(
             'type' => 'integer',
             'length' => 8,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Pais', array(
             'local' => 'pais_id',
             'foreign' => 'id'));

        $this->hasOne('Idioma', array(
             'local' => 'idioma_id',
             'foreign' => 'id'));
    }
}