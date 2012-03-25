<?php

/**
 * estadistica actions.
 *
 * @package    voluntarios
 * @subpackage estadistica
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class estadisticaActions extends sfActions
{

  public function executePais(sfWebRequest $request)
  {
    $this->voluntarios_paises = Doctrine::getTable('Voluntario')->voluntariosPais();
  }

  public function executePaisDatos(sfWebRequest $request)
  {
    $datos = Doctrine::getTable('Voluntario')->voluntariosPaisLimitado();
    $this->getResponse()->setContent(myGrafica::getTarta($datos,'voluntarios','pais'));
    return sfView::NONE;
  }

  public function executeSexo(sfWebRequest $request)
  {
    $this->voluntarios_sexos = Doctrine::getTable('Voluntario')->voluntariosSexo();
  }

  public function executeSexoDatos(sfWebRequest $request)
  {
    $datos = Doctrine::getTable('Voluntario')->voluntariosSexo();
    $this->getResponse()->setContent(myGrafica::getTarta($datos,'voluntarios','sexo'));
    return sfView::NONE;
  }

  public function executeTalla(sfWebRequest $request)
  {
    $this->voluntarios_tallas = Doctrine::getTable('Voluntario')->voluntariosTalla();
  }

  public function executeTallaDatos(sfWebRequest $request)
  {
    $datos = Doctrine::getTable('Voluntario')->voluntariosTalla();
    $this->getResponse()->setContent(myGrafica::getTarta($datos,'voluntarios','talla'));
    return sfView::NONE;
  }

  public function executeEdad(sfWebRequest $request)
  {
    $this->voluntarios_edades = Doctrine::getTable('Voluntario')->voluntariosEdad();
  }

  public function executeEdadDatos(sfWebRequest $request)
  {
    $edades_voluntarios = Doctrine::getTable('Voluntario')->voluntariosEdad();
    $edades = array(); // La lista con el conjunto de las edades de voluntarios 
    $cantidades = array(); // Cantidad de voluntarios por cada una de las edades
    $max_cantidad = 0; 
    
    foreach ($edades_voluntarios as $edad_voluntarios){
      $cantidad = (int)$edad_voluntarios['cantidad']; 
      if ($cantidad > $max_cantidad) {
        $max_cantidad  = $cantidad;
      }
      $cantidades[] = $cantidad;
      $edades[] = $edad_voluntarios['grupo_edad'];
    }
    
    $this->getResponse()->setContent(myGrafica::getBarras($cantidades,$edades,$max_cantidad));
    return sfView::NONE;
  }

  public function executeMovimiento(sfWebRequest $request)
  {
    $this->voluntarios_movimientos = Doctrine::getTable('Voluntario')->voluntariosMovimiento();
  }

  public function executeMovimientoDatos(sfWebRequest $request)
  {
    $datos = Doctrine::getTable('Voluntario')->voluntariosMovimiento();
    $this->getResponse()->setContent(myGrafica::getTarta($datos,'voluntarios','nombre'));
    return sfView::NONE;
  }

  public function executeParroquia(sfWebRequest $request)
  {
    $this->voluntarios_parroquias = Doctrine::getTable('Voluntario')->voluntariosParroquia();
  }

  public function executeParroquiaDatos(sfWebRequest $request)
  {
    $datos = Doctrine::getTable('Voluntario')->voluntariosParroquia();
    $this->getResponse()->setContent(myGrafica::getTarta($datos,'voluntarios','nombre'));
    return sfView::NONE;
  }

  public function executeEquipo(sfWebRequest $request)
  {
    $this->voluntarios_equipos = Doctrine::getTable('Voluntario')->voluntariosEquipo();
    $resto_equipos = array_slice($this->voluntarios_equipos,20,-1);
    $resto_acumulados = 0;
    foreach ($resto_equipos as $equipo) {
      $resto_acumulados += $equipo['voluntarios'];
    }
    $this->voluntarios_equipos = array_slice($this->voluntarios_equipos,0,20,true);
    $this->voluntarios_equipos[] = array('voluntarios'=>$resto_acumulados,'id'=>'Otros','nombre'=>'El resto de los equipos');

  }

  public function executeEquipoDatos(sfWebRequest $request)
  {
    $datos = Doctrine::getTable('Voluntario')->voluntariosEquipo();
    $resto_equipos = array_slice($datos,10,-1);
    $resto_acumulados = 0;
    foreach ($resto_equipos as $equipo) {
      $resto_acumulados += $equipo['voluntarios'];
    }
    $datos = array_slice($datos,0,10,true);
    $datos[] = array('voluntarios'=>$resto_acumulados,'id'=>'Otros equipos');
    $this->getResponse()->setContent(myGrafica::getTarta($datos,'voluntarios','id'));
    return sfView::NONE;
  }

  public function executeEnEquipoDatos(sfWebRequest $request)
  {
    $datos = Doctrine::getTable('Voluntario')->voluntariosEnEquipo();
    $this->getResponse()->setContent(myGrafica::getTarta($datos,'voluntarios','equipo'));
    return sfView::NONE;
  }

  public function executeProvincia(sfWebRequest $request)
  {
    $this->voluntarios_provincias = Doctrine::getTable('Voluntario')->voluntariosProvincia();
  }

  public function executeProvinciaDatos(sfWebRequest $request)
  {
    $datos = Doctrine::getTable('Voluntario')->voluntariosProvincia();
    $resto_provincias = array_slice($datos,10,-1);
    $resto_acumulados = 0;
    foreach ($resto_provincias as $provincia) {
      $resto_acumulados += $provincia['voluntarios'];
    }
    $datos = array_slice($datos,0,10,true);
    $datos[] = array('voluntarios'=>$resto_acumulados,'nombre'=>'Otras provincias');
    $this->getResponse()->setContent(myGrafica::getTarta($datos,'voluntarios','nombre'));
    return sfView::NONE;
  }

  public function executeDiocesis(sfWebRequest $request)
  {
    $this->voluntarios_diocesis = Doctrine::getTable('Voluntario')->voluntariosDiocesis();
  }

  public function executeDiocesisDatos(sfWebRequest $request)
  {
    $datos = Doctrine::getTable('Voluntario')->voluntariosDiocesis();
    $this->getResponse()->setContent(myGrafica::getTarta($datos,'voluntarios','diocesis'));
    return sfView::NONE;
  }

  public function executePagado(sfWebRequest $request)
  {
    $this->voluntarios_pagados = Doctrine::getTable('Voluntario')->voluntariosPagado();
    $madrid = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')->where('apto IS NULL OR apto = 1')->andWhere('pagado = 1')->andWhere('provincia_id = 32')->fetchArray();
    $this->pagados_madrid = array_shift($madrid);
    $nacional = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')->where('apto IS NULL OR apto = 1')->andWhere('pagado = 1')->andWhere('provincia_id != 32')->andWhere('pais = "ES"')->fetchArray();
    $this->pagados_nacionales = array_shift($nacional);
     $internacional = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')->where('apto IS NULL OR apto = 1')->andWhere('pagado = 1')->andWhere('pais != "ES"')->fetchArray();
    $this->pagados_internacionales = array_shift($internacional);
;
  }

  public function executePagadoDatos(sfWebRequest $request)
  {
    $datos = Doctrine::getTable('Voluntario')->voluntariosPagado();
    $this->getResponse()->setContent(myGrafica::getTarta($datos,'voluntarios','pagado'));
    return sfView::NONE;
  }

  public function executeSeguridad(sfWebRequest $request)
  {
    $this->voluntarios_seguridad_eventos_brutos = Doctrine::getTable('Voluntario')->voluntariosSeguridadEventos();
    $etiquetas_eventos = sfConfig::get('app_etiquetas_eventos_seguridad');
    $this->voluntarios_seguridad_eventos = array();

    foreach($this->voluntarios_seguridad_eventos_brutos as $id_evento => $evento) {
      $nulo = array_key_exists('Nulo',$evento) ? $evento['Nulo']['voluntarios']: 0;
      $gris = array_key_exists('Gris',$evento) ? $evento['Gris']['voluntarios']: 0;
      $azul = array_key_exists('Azul',$evento) ? $evento['Azul']['voluntarios']: 0;
      $rojo = array_key_exists('Rojo',$evento) ? $evento['Rojo']['voluntarios']: 0;
      $this->voluntarios_seguridad_eventos[$id_evento.'. '.$etiquetas_eventos[$id_evento]] = array('Nulo'=>$nulo, 'Gris'=>$gris, 'Azul'=>$azul, 'Rojo'=>$rojo);
    }
  }

  public function executeSeguridadDatos(sfWebRequest $request)
  {
    $datos = Doctrine::getTable('Voluntario')->voluntariosSeguridad();
    unset($datos['Nulo']);
    $this->getResponse()->setContent(myGrafica::getMultiBarras($datos,array_values(sfConfig::get('app_etiquetas_eventos_seguridad')),8500));
    return sfView::NONE;
  }

  public function executeSeguridadOrden(sfWebRequest $request)
  {
    $this->voluntarios_seguridad_eventos_brutos = Doctrine::getTable('Voluntario')->voluntariosSeguridadEventosOrden();
    $etiquetas_eventos = sfConfig::get('app_etiquetas_eventos_seguridad');
    $this->voluntarios_seguridad_eventos = array();

    foreach($this->voluntarios_seguridad_eventos_brutos as $id_evento => $evento) {
      $nulo = array_key_exists('Nulo',$evento) ? $evento['Nulo']['voluntarios']: 0;
      $gris = array_key_exists('Gris',$evento) ? $evento['Gris']['voluntarios']: 0;
      $azul = array_key_exists('Azul',$evento) ? $evento['Azul']['voluntarios']: 0;
      $rojo = array_key_exists('Rojo',$evento) ? $evento['Rojo']['voluntarios']: 0;
      $this->voluntarios_seguridad_eventos[$id_evento.'. '.$etiquetas_eventos[$id_evento]] = array('Nulo'=>$nulo, 'Gris'=>$gris, 'Azul'=>$azul, 'Rojo'=>$rojo);
    }
  }

  public function executeSeguridadDatosOrden(sfWebRequest $request)
  {
    $datos = Doctrine::getTable('Voluntario')->voluntariosSeguridadOrden();
    unset($datos['Nulo']);
    $this->getResponse()->setContent(myGrafica::getMultiBarras($datos,array_values(sfConfig::get('app_etiquetas_eventos_seguridad')),8500));
    return sfView::NONE;
  }

  public function executeSeguridadAcreditable(sfWebRequest $request)
  {
    $this->voluntarios_seguridad_eventos_brutos = Doctrine::getTable('Voluntario')->voluntariosSeguridadEventosAcreditable();
    $etiquetas_eventos = sfConfig::get('app_etiquetas_eventos_seguridad');
    $this->voluntarios_seguridad_eventos = array();

    foreach($this->voluntarios_seguridad_eventos_brutos as $id_evento => $evento) {
      $nulo = array_key_exists('Nulo',$evento) ? $evento['Nulo']['voluntarios']: 0;
      $gris = array_key_exists('Gris',$evento) ? $evento['Gris']['voluntarios']: 0;
      $azul = array_key_exists('Azul',$evento) ? $evento['Azul']['voluntarios']: 0;
      $rojo = array_key_exists('Rojo',$evento) ? $evento['Rojo']['voluntarios']: 0;
      $this->voluntarios_seguridad_eventos[$id_evento.'. '.$etiquetas_eventos[$id_evento]] = array('Nulo'=>$nulo, 'Gris'=>$gris, 'Azul'=>$azul, 'Rojo'=>$rojo);
    }
  }

  public function executeSeguridadDatosAcreditable(sfWebRequest $request)
  {
    $datos = Doctrine::getTable('Voluntario')->voluntariosSeguridadAcreditable();
    unset($datos['Nulo']);
    $this->getResponse()->setContent(myGrafica::getMultiBarras($datos,array_values(sfConfig::get('app_etiquetas_eventos_seguridad')),8500));
    return sfView::NONE;
  }

  public function executeResumen(sfWebRequest $request)
  {
    $this->apto_si = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')->where('apto = 1')->fetchOne()->get('COUNT');;
    $this->apto_no = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')->where('apto = 0')->fetchOne()->get('COUNT');
    $this->apto_sin_definir = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')->where('apto IS NULL')->fetchOne()->get('COUNT');
    $this->policia_si = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')->where('revisado_policia = 1')->fetchOne()->get('COUNT');
    $this->policia_no = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')->where('revisado_policia = 0')->fetchOne()->get('COUNT');
    $this->pagado_si = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')->where('pagado = 1')->fetchOne()->get('COUNT');
    $this->pagado_no = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')->where('pagado = 0')->fetchOne()->get('COUNT');
    $this->equipo_si = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')->where('equipo_id IS NOT NULL')->fetchOne()->get('COUNT');
    $this->equipo_no = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')->where('equipo_id IS NULL')->fetchOne()->get('COUNT');
    $this->equipo_acreditable_si = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario v')
      ->leftJoin('v.Equipo e')->where('equipo_id IS NOT NULL AND e.acreditable = 1')->fetchOne()->get('COUNT');
    $this->equipo_acreditable_no = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario v')
      ->leftJoin('v.Equipo e')->where('equipo_id IS NULL OR (equipo_id IS NOT NULL AND e.acreditable = 0)')->fetchOne()->get('COUNT');
    $this->foto_si = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')->where('foto != ""')->fetchOne()->get('COUNT');
    $this->foto_no = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')->where('foto = ""')->fetchOne()->get('COUNT');
    $this->equipo_pagado_policia_apto_si = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario v')
      ->leftJoin('v.Equipo e')
      ->where('equipo_id IS NOT NULL AND e.acreditable = 1 AND pagado = 1 AND revisado_policia = 1 AND apto = 1')
      ->fetchOne()->get('COUNT');
    $this->equipo_pagado_policia_apto_no = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario v')
      ->leftJoin('v.Equipo e')
      ->where('(equipo_id IS NULL) OR (equipo_id IS NOT NULL AND e.acreditable = 0) OR (pagado = 0) OR (revisado_policia = 0) OR (apto = 0) OR (apto IS NULL)')
      ->fetchOne()->get('COUNT');
    $this->foto_si_pagado_si = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')
      ->where('pagado = 1 AND foto != ""')->fetchOne()->get('COUNT');
    $this->foto_no_pagado_si = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')
      ->where('pagado = 1 AND foto = ""')->fetchOne()->get('COUNT');
    $this->foto_si_pagado_no = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')
      ->where('pagado = 0 AND foto != ""')->fetchOne()->get('COUNT');
    $this->foto_no_pagado_no = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')
      ->where('pagado = 0 AND foto = ""')->fetchOne()->get('COUNT');
  }

  public function executeFoto(sfWebRequest $request)
  {
    $this->grandes_movimientos_fotos = array();
    $grandes_movimientos = Doctrine_Query::create()->from('Movimiento')->where('grande = 1')->execute();
    foreach ($grandes_movimientos as $movimiento) {
      $con_foto = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')->where('movimiento_id = '.$movimiento->getId().' AND foto != "" AND apto=1')->fetchOne()->get('COUNT');
      $sin_foto = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')->where('movimiento_id = '.$movimiento->getId().' AND foto = "" AND apto=1')->fetchOne()->get('COUNT');
      $this->grandes_movimientos_fotos[$movimiento->getNombre()] = array($con_foto, $sin_foto);
      $grandes_movimientos_ids[] = $movimiento->getId();
    }

    $this->internacional_foto_si = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')
      ->where('foto!="" AND apto=1')
      ->andWhere("movimiento_id NOT IN (".implode(',',$grandes_movimientos_ids).") OR movimiento_id IS NULL")
      ->andWhere('pais != "ES"')
      ->fetchOne()->get('COUNT');
    $this->internacional_foto_no = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')
      ->where('foto="" AND apto=1')
      ->andWhere("movimiento_id NOT IN (".implode(',',$grandes_movimientos_ids).") OR movimiento_id IS NULL")
      ->andWhere('pais != "ES"')
      ->fetchOne()->get('COUNT');  
    $this->nacional_foto_si = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')
      ->where('foto!="" AND apto=1')
      ->andWhere("movimiento_id NOT IN (".implode(',',$grandes_movimientos_ids).") OR movimiento_id IS NULL")
      ->andWhere('pais = "ES"')
      ->andWhere('provincia_id != 32')
      ->fetchOne()->get('COUNT');
    $this->nacional_foto_no = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')
      ->where('foto="" AND apto=1')
      ->andWhere("movimiento_id NOT IN (".implode(',',$grandes_movimientos_ids).") OR movimiento_id IS NULL")
      ->andWhere('pais = "ES"')
      ->andWhere('provincia_id != 32')
      ->fetchOne()->get('COUNT');  
    $this->madrid_foto_si = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')
      ->where('foto!="" AND apto=1')
      ->andWhere("movimiento_id NOT IN (".implode(',',$grandes_movimientos_ids).") OR movimiento_id IS NULL")
      ->andWhere('pais = "ES"')
      ->andWhere('provincia_id = 32')
      ->fetchOne()->get('COUNT');
    $this->madrid_foto_no = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')
      ->where('foto="" AND apto=1')
      ->andWhere("movimiento_id NOT IN (".implode(',',$grandes_movimientos_ids).") OR movimiento_id IS NULL")
      ->andWhere('pais = "ES"')
      ->andWhere('provincia_id = 32')
      ->fetchOne()->get('COUNT');  

    $this->etiquetas_eventos = sfConfig::get('app_etiquetas_eventos_seguridad');
    $this->fotos_seguridad = array();
    for($i=1; $i<=12; $i++) {
      $this->fotos_seguridad[$i]['Rojo'] = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')
	->where('foto=""')->andWhere('nivel_seguridad_'.$i.' = "Rojo"')->andWhere('apto=1')->andWhere('pagado=1')->fetchOne()->get('COUNT');  
      $this->fotos_seguridad[$i]['Azul'] = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')
	->where('foto=""')->andWhere('nivel_seguridad_'.$i.' = "Azul"')->andWhere('apto=1')->andWhere('pagado=1')->fetchOne()->get('COUNT');  
    }
    $this->fotos_seguridad[11]['Gris'] = Doctrine_Query::create()->select('COUNT(id)')->from('Voluntario')
      ->where('foto=""')->andWhere('nivel_seguridad_11 = "Gris"')->andWhere('apto=1')->andWhere('pagado=1')->fetchOne()->get('COUNT');  
  }

  public function executeRegistro(sfWebRequest $request)
  {
    $this->registrados = Doctrine_Query::create()->select('COUNT(*)')->from('Voluntario')->where('registrado="1"')->fetchOne()->get('COUNT');
    $this->prevision_registros = Doctrine_Query::create()->select('COUNT(*)')->from('Voluntario')->where('apto="1"')->fetchOne()->get('COUNT');
    $this->registrados_ifema = Doctrine_Query::create()->select('COUNT(*)')
      ->from('Voluntario')->where('registrado="1"')->andWhere('alojamiento="IFEMA"')->fetchOne()->get('COUNT');
    $this->prevision_ifema = Doctrine_Query::create()->select('COUNT(*)')
      ->from('Voluntario')->where('apto="1"')->andWhere('alojamiento="IFEMA"')->fetchOne()->get('COUNT');
    $this->abonos_transporte_repartidos = Doctrine_Query::create()->select('COUNT(*)')
      ->from('Voluntario')->where('registrado="1"')->andWhere('alojamiento="IFEMA"')->andWhere('pais!="ES"')
      ->fetchOne()->get('COUNT') * 2 
      + Doctrine_Query::create()->select('COUNT(*)')->from('Voluntario')->where('registrado="1"')->andWhere('alojamiento!="IFEMA" OR pais="ES"')
      ->fetchOne()->get('COUNT');
    $this->tickets_comida_repartidos = Doctrine_Query::create()->select('COUNT(*)')
      ->from('Voluntario')->where('registrado="1"')->andWhere('alojamiento="IFEMA"')->andWhere('pais!="ES"')->fetchOne()->get('COUNT');
    $this->tickets_comida_segunda_semana_repartidos = Doctrine_Query::create()->select('COUNT(*)')
      ->from('Voluntario')->where('tickets_comida="1"')->fetchOne()->get('COUNT');

  }

  public function executeInformeCsv(sfWebRequest $request)
  {
    $this->edades_mundo = Doctrine::getTable('Voluntario')->voluntariosEdad();
    $this->edades_españa = Doctrine::getTable('Voluntario')->voluntariosEdadES();
    $this->edades_madrid = Doctrine::getTable('Voluntario')->voluntariosEdadMadrid();
    $this->paises = Doctrine::getTable('Voluntario')->voluntariosPais();
    $this->provincias = Doctrine::getTable('Voluntario')->voluntariosProvincia();
    $this->provincias_ciong = Doctrine::getTable('Voluntario')->voluntariosProvincia(13);
    $this->provincias_camino = Doctrine::getTable('Voluntario')->voluntariosProvincia(5);
    $this->ingles = Doctrine::getTable('Voluntario')->voluntariosInglesMadrid();
    $this->frances = Doctrine::getTable('Voluntario')->voluntariosFrancesMadrid();
    $this->aleman = Doctrine::getTable('Voluntario')->voluntariosAlemanMadrid();
    $response = $this->getContext()->getResponse();
    $response->setContentType('application/csv');
    $response->addHttpMeta('cache-control', 'no-cache');
    $response->addHttpMeta('Expires', gmdate("D, d M Y H:i:s") . " GMT",time());
    $response->setHttpHeader('Content-Disposition', 'attachment; filename="Informe voluntarios.csv"');
    $response->setContent($this->getPartial('csv'));
        
    return sfView::NONE;
  }

  public function executeInformePdf(sfWebRequest $request)
  {
    $this->edades_mundo = Doctrine::getTable('Voluntario')->voluntariosEdad();
    $this->edades_españa = Doctrine::getTable('Voluntario')->voluntariosEdadES();
    $this->edades_madrid = Doctrine::getTable('Voluntario')->voluntariosEdadMadrid();
    $this->paises = Doctrine::getTable('Voluntario')->voluntariosPais();
    $this->provincias = Doctrine::getTable('Voluntario')->voluntariosProvincia();
    $this->provincias_ciong = Doctrine::getTable('Voluntario')->voluntariosProvincia(13);
    $this->provincias_camino = Doctrine::getTable('Voluntario')->voluntariosProvincia(5);
    $this->ingles = Doctrine::getTable('Voluntario')->voluntariosInglesMadrid();
    $this->frances = Doctrine::getTable('Voluntario')->voluntariosFrancesMadrid();
    $this->aleman = Doctrine::getTable('Voluntario')->voluntariosAlemanMadrid();
    $this->logo = '/var/www/web/images/encabezado.png';

    $latexCode = myLatex::escapeChar($this->getPartial('pdf'));
    $response = $this->getContext()->getResponse();
    myLatex::generatePdf($response, 'Informe voluntarios', $latexCode);
    return sfView::NONE;
  }

}
