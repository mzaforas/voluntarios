<?php

/**
 * Voluntario filter form.
 *
 * @package    voluntarios
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VoluntarioFormFilter extends BaseVoluntarioFormFilter
{
  public function configure()
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
    $this->setWidget('id', new sfWidgetFormFilterInput(array('with_empty' => false)));
    $this->setValidator('id', new sfValidatorPass(array('required' => false)));
    $this->setWidget('formacion', new sfWidgetFormDoctrineChoice(array('model' => 'Tag', 'add_empty' => true, 'key_method' => 'getName')));
    $this->setValidator('formacion', new  sfValidatorPass());
    $this->setWidget('diocesis', new sfWidgetFormDoctrineChoice(array('model' => 'Diocesis', 'add_empty' => true, 'method' => 'getNombre'))); 
    $this->setValidator('diocesis', new  sfValidatorPass());
    $years = range(1910, 2000);
    $this->setWidget('fecha_nacimiento', new sfWidgetFormFilterDate(array(
									  'from_date' => new sfWidgetFormI18nDate(array('culture'=>'es','years'=>array_combine($years,$years))),
									  'to_date' => new sfWidgetFormI18nDate(array('culture'=>'es','years'=>array_combine($years,$years))),
									  'with_empty' => false)));
    $this->widgetSchema['parroquia_id']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
    $this->widgetSchema['parroquia_id']->setOption('renderer_options', array('model' => 'Parroquia', 'url' => url_for('parroquia/autocompletar')));
    $this->widgetSchema['perteneciente_a_parroquia'] = new sfWidgetFormChoice(array('choices' => array('' => 'sí o no', 1 => 'sí', 0 => 'no')));
    $this->validatorSchema['perteneciente_a_parroquia'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0,'null')));
    $this->widgetSchema['perteneciente_a_movimiento'] = new sfWidgetFormChoice(array('choices' => array('' => 'sí o no', 1 => 'sí', 0 => 'no')));
    $this->validatorSchema['perteneciente_a_movimiento'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0,'null')));
    $this->widgetSchema['perteneciente_a_gran_movimiento'] = new sfWidgetFormChoice(array('choices' => array('' => 'sí o no', 1 => 'sí', 0 => 'no')));
    $this->validatorSchema['perteneciente_a_gran_movimiento'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0,'null')));
    $this->widgetSchema['telefono_fijo']->setOption('with_empty',false);
    $this->widgetSchema['equipo_id']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
    $this->widgetSchema['equipo_id']->setOption('renderer_options', array('model' => 'Equipo', 'url' => url_for('equipo/autocompletar')));
    $this->widgetSchema['apto'] = new sfWidgetFormChoice(array('choices' => array('' => 'sí, no o sin definir', 1 => 'sí', 0 => 'no','null'=>'sin definir')));
    $this->validatorSchema['apto'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0,'null')));
    $this->widgetSchema['asignado_a_equipo'] = new sfWidgetFormChoice(array('choices' => array('' => 'sí o no', 1 => 'sí', 0 => 'no')));
    $this->validatorSchema['asignado_a_equipo'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0,'null')));
    $this->widgetSchema['asignado_a_equipo_acreditable'] = new sfWidgetFormChoice(array('choices' => array('' => 'sí o no', 1 => 'sí', 0 => 'no')));
    $this->validatorSchema['asignado_a_equipo_acreditable'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0,'null')));
    $this->widgetSchema['asignado_a_equipo_orden'] = new sfWidgetFormChoice(array('choices' => array('' => 'sí o no', 1 => 'sí', 0 => 'no')));
    $this->validatorSchema['asignado_a_equipo_orden'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0,'null')));
    $this->widgetSchema['pais_españa'] = new sfWidgetFormChoice(array('choices' => array('' => 'sí o no', 1 => 'sí', 0 => 'no')));
    $this->validatorSchema['pais_españa'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0,'null')));
    $this->widgetSchema['provincia_madrid'] = new sfWidgetFormChoice(array('choices' => array('' => 'sí o no', 1 => 'sí', 0 => 'no')));
    $this->validatorSchema['provincia_madrid'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0,'null')));
    $this->widgetSchema['foto'] = new sfWidgetFormChoice(array('choices' => array('' => 'sí o no', 1 => 'sí', 0 => 'no')));
    $this->validatorSchema['foto'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0,'null')));
    $this->widgetSchema['documento_identificacion_personal'] = new sfWidgetFormChoice(array('choices' => array('' => 'sí o no', 1 => 'sí', 0 => 'no')));
    $this->validatorSchema['documento_identificacion_personal'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0,'null')));
    $this->widgetSchema['documento_acreditacion'] = new sfWidgetFormChoice(array('choices' => array('' => 'sí o no', 1 => 'sí', 0 => 'no')));
    $this->validatorSchema['documento_acreditacion'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0,'null')));
    $this->widgetSchema['documento_compromiso'] = new sfWidgetFormChoice(array('choices' => array('' => 'sí o no', 1 => 'sí', 0 => 'no')));
    $this->validatorSchema['documento_compromiso'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0,'null')));
    $this->widgetSchema['documento_antecedentes_penales'] = new sfWidgetFormChoice(array('choices' => array('' => 'sí o no', 1 => 'sí', 0 => 'no')));
    $this->validatorSchema['documento_antecedentes_penales'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0,'null')));
    $this->widgetSchema['documento_autorizacion_paterna'] = new sfWidgetFormChoice(array('choices' => array('' => 'sí o no', 1 => 'sí', 0 => 'no')));
    $this->validatorSchema['documento_autorizacion_paterna'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0,'null')));
  }
    
  public function getFields()
  {
    $fields = parent::getFields();
    $fields['formacion'] = 'Text';
    $fields['diocesis'] = 'Text';    
    return $fields;
  }

  public function addFormacionColumnQuery(Doctrine_Query $query, $field, $value)
  {
    foreach (PluginTagTable::getObjectTaggedWith(array($value)) as $taggings) {
      $ids[] = $taggings->getId();
    }

    if (!isset($ids)) {
      $query->where('false');
    } else {
      $query->andWhereIn($query->getRootAlias().'.id', $ids);
    }
  }

  public function addDiocesisColumnQuery(Doctrine_Query $query, $field, $value)
  {
    $q = Doctrine_Query::create()
      ->select('a.id')
      ->from('Arciprestazgo a')
      ->addWhere('a.diocesis_id = ?', $value);

    $arciprestazgos = $q->fetchArray();

    foreach($arciprestazgos as $arciprestazgo) {
      $arciprestazgos_ids[] = $arciprestazgo['id'];
    }

    $q = Doctrine_Query::create()
      ->select('p.id')
      ->from('Parroquia p')
      ->andWhereIn('p.arciprestazgo_id', $arciprestazgos_ids);

    $parroquias = $q->fetchArray();

    foreach($parroquias as $parroquia) {
      $parroquias_ids[] = $parroquia['id'];
    }

    if (!isset($parroquias_ids)) {
      $query->where('false');
    } else {
      $query->andWhereIn($query->getRootAlias().'.parroquia_id', $parroquias_ids);
    }
  }

  public function addAptoColumnQuery(Doctrine_Query $query, $field, $value)
  {
    switch($value) {
    case "null":
      $query->andWhere($query->getRootAlias().'.apto IS NULL');
      break;
    case "":
      break;
    default:
      $query->andWhereIn($query->getRootAlias().'.apto', $value);
    }
  }

  public function addAsignadoAEquipoColumnQuery(Doctrine_Query $query, $field, $value)
  {
    if ($value == 1) {
      $query->andWhere($query->getRootAlias().'.equipo_id IS NOT NULL');
    } elseif ($value == 0) {
      $query->andWhere($query->getRootAlias().'.equipo_id IS NULL');
    }
  }

  public function addAsignadoAEquipoAcreditableColumnQuery(Doctrine_Query $query, $field, $value)
  {
    if ($value == 1) {
      $query->andWhere($query->getRootAlias().'.equipo_id IS NOT NULL')->andWhere('equipo.acreditable = 1');
    } elseif ($value == 0) {
      $query->andWhere($query->getRootAlias().'.equipo_id IS NULL')
	->orWhere($query->getRootAlias().'.equipo_id IS NOT NULL AND equipo.acreditable = 0');
    }
  }

  public function addAsignadoAEquipoOrdenColumnQuery(Doctrine_Query $query, $field, $value)
  {
    $q = Doctrine_Query::create()->select('id')->from('Equipo e INDEXBY e.id')->leftJoin('e.Perfiles p')->where('p.nombre = "Orden"');
    $equipos_orden_raw = $q->fetchArray();
    foreach($equipos_orden_raw as $equipo) {
      $equipos_orden[] = $equipo['id'];
    }

    if ($value == 1) {
      $query->andWhereIn($query->getRootAlias().'.equipo_id', $equipos_orden);
    } elseif ($value == 0) {
      $query->andWhere($query->getRootAlias().'.equipo_id IS NULL')
	->orWhereNotIn('equipo_id', $equipos_orden);
    }
  }

  public function addPertenecienteAMovimientoColumnQuery(Doctrine_Query $query, $field, $value)
  {
    if ($value == 1) {
      $query->andWhere($query->getRootAlias().'.movimiento_id IS NOT NULL');
    } elseif ($value == 0) {
      $query->andWhere($query->getRootAlias().'.movimiento_id IS NULL');
    }
  }

  public function addPertenecienteAGranMovimientoColumnQuery(Doctrine_Query $query, $field, $value)
  {
    $grandes_movimientos_raw = Doctrine_Query::create()
      ->select('id')
      ->from('Movimiento')
      ->where('grande = 1')->fetchArray();

    foreach($grandes_movimientos_raw as $gmr) {
      $grandes_movimientos[] = $gmr['id'];
    }

    if ($value == 1) {
      $query->andWhereIn($query->getRootAlias().'.movimiento_id',$grandes_movimientos);
    } elseif ($value == 0) {
      $query->andWhere($query->getRootAlias().".movimiento_id NOT IN (".implode(',',$grandes_movimientos).") OR ".$query->getRootAlias().".movimiento_id IS NULL");
    }
  }

  public function addPertenecienteAParroquiaColumnQuery(Doctrine_Query $query, $field, $value)
  {
    if ($value == 1) {
      $query->andWhere($query->getRootAlias().'.parroquia_id IS NOT NULL');
    } elseif ($value == 0) {
      $query->andWhere($query->getRootAlias().'.parroquia_id IS NULL');
    }
  }

  public function addPaisEspañaColumnQuery(Doctrine_Query $query, $field, $value)
  {
    if ($value == 1) {
      $query->andWhere($query->getRootAlias().'.pais = "ES"');
    } elseif ($value == 0) {
      $query->andWhere($query->getRootAlias().'.pais != "ES"');
    }
  }

  public function addProvinciaMadridColumnQuery(Doctrine_Query $query, $field, $value)
  {
    if ($value == 1) {
      $query->andWhere($query->getRootAlias().'.provincia_id = 32');
    } elseif ($value == 0) {
      $query->andWhere($query->getRootAlias().'.provincia_id != 32 OR '.$query->getRootAlias().'.provincia_id IS NULL');
    }
  }

  public function addFotoColumnQuery(Doctrine_Query $query, $field, $value)
  {
    if ($value == 1) {
      $query->andWhere($query->getRootAlias().'.foto != ""');
    } elseif ($value == 0) {
      $query->andWhere($query->getRootAlias().'.foto = ""');
    }
  }

  public function addDocumentoIdentificacionPersonalColumnQuery(Doctrine_Query $query, $field, $value)
  {
    if ($value == 1) {
      $query->andWhere($query->getRootAlias().'.documento_identificacion_personal IS NOT NULL');
    } elseif ($value == 0) {
      $query->andWhere($query->getRootAlias().'.documento_identificacion_personal IS NULL');
    }
  }
  public function addDocumentoAcreditacionColumnQuery(Doctrine_Query $query, $field, $value)
  {
    if ($value == 1) {
      $query->andWhere($query->getRootAlias().'.documento_acreditacion IS NOT NULL');
    } elseif ($value == 0) {
      $query->andWhere($query->getRootAlias().'.documento_acreditacion IS NULL');
    }
  }
  public function addDocumentoCompromisoColumnQuery(Doctrine_Query $query, $field, $value)
  {
    if ($value == 1) {
      $query->andWhere($query->getRootAlias().'.documento_compromiso IS NOT NULL');
    } elseif ($value == 0) {
      $query->andWhere($query->getRootAlias().'.documento_compromiso IS NULL');
    }
  }
  public function addDocumentoAntecedentesPenalesColumnQuery(Doctrine_Query $query, $field, $value)
  {
    if ($value == 1) {
      $query->andWhere($query->getRootAlias().'.documento_antecedentes_penales IS NOT NULL');
    } elseif ($value == 0) {
      $query->andWhere($query->getRootAlias().'.documento_antecedentes_penales IS NULL');
    }
  }
  public function addDocumentoAutorizacionPaternaColumnQuery(Doctrine_Query $query, $field, $value)
  {
    if ($value == 1) {
      $query->andWhere($query->getRootAlias().'.documento_autorizacion_paterna IS NOT NULL');
    } elseif ($value == 0) {
      $query->andWhere($query->getRootAlias().'.documento_autorizacion_paterna IS NULL');
    }
  }

}
