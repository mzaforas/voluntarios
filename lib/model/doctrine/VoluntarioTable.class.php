<?php

class VoluntarioTable extends Doctrine_Table
{
    public function voluntariosPaisLimitado()
    {
      $q = Doctrine_Query::create()
	->select('v.pais as pais')
	->addSelect('COUNT(v.pais) as voluntarios')
	->from('Voluntario v')
	->where('v.apto IS NULL OR v.apto = 1')
	->groupBy('v.pais')
	->orderBy('voluntarios DESC');
      
      $voluntarios_por_paises_brutos = $q->fetchArray();
      $i18n = sfContext::getInstance()->getI18N();      

      $i = 0;
      $resto_acumulados = 0;
      $paises_mostrados = 10;
      foreach($voluntarios_por_paises_brutos as $voluntarios_por_pais) {
	if ($i < $paises_mostrados) {
	  $voluntarios_por_paises[$i] = array('voluntarios'=>(int)$voluntarios_por_pais['voluntarios'],'pais'=>$i18n->getCountry($voluntarios_por_pais['pais'],'es_ES'));
	  $i++;
	} else {
	  $resto_acumulados += (int)$voluntarios_por_pais['voluntarios'];
	}
      }
      if ($resto_acumulados) {
	$voluntarios_por_paises[$i] = array('voluntarios'=>$resto_acumulados,'pais'=>'Otros paises');
      }
      
      return $voluntarios_por_paises;
    }

    public function voluntariosPais()
    {
      $q = Doctrine_Query::create()
	->select('v.pais as pais')
	->addSelect('COUNT(v.pais) as voluntarios')
	->from('Voluntario v')
	->where('v.apto IS NULL OR v.apto = 1')
	->groupBy('v.pais')
	->orderBy('voluntarios DESC');
      
      $voluntarios_por_paises_brutos = $q->fetchArray();
      $i18n = sfContext::getInstance()->getI18N();      

      $i = 0;
      foreach($voluntarios_por_paises_brutos as $voluntarios_por_pais) {
	$voluntarios_por_paises[$i] = array('voluntarios'=>(int)$voluntarios_por_pais['voluntarios'],'pais'=>$i18n->getCountry($voluntarios_por_pais['pais'],'es_ES'));
	$i++;
      }
      
      return $voluntarios_por_paises;
    }

    public function voluntariosProvincia($movimiento_id = null)
    {
      $q = Doctrine_Query::create()
	->select('p.id, p.nombre')
	->addSelect('COUNT(v.provincia_id) as voluntarios')
	->from('Provincia p')
	->leftJoin('p.Voluntarios v')
	->where('v.apto IS NULL OR v.apto = 1')
	->andWhere('v.pais = "ES"')
	->groupBy('p.id')
	->orderBy('voluntarios DESC');

      if ($movimiento_id) {
	$q->andWhere('v.movimiento_id = '.$movimiento_id);
      }
      
      return $q->fetchArray();
    }

    public function voluntariosSexo()
    {
      $q = Doctrine_Query::create()
	->select('v.sexo as sexo')
	->addSelect('COUNT(v.sexo) as voluntarios')
	->from('Voluntario v')
	->where('v.apto IS NULL OR v.apto = 1')
	->groupBy('v.sexo')
	->orderBy('voluntarios DESC');
      
      $voluntarios_por_sexos_brutos = $q->fetchArray();

      foreach($voluntarios_por_sexos_brutos as $voluntarios_por_sexo) {
	  $voluntarios_por_sexos[] = array('voluntarios'=>(int)$voluntarios_por_sexo['voluntarios'],'sexo'=>$voluntarios_por_sexo['sexo']);
      }
      
      return $voluntarios_por_sexos;
    }

    public function voluntariosPagado()
    {
      $q = Doctrine_Query::create()
	->select('v.pagado as pagado')
	->addSelect('COUNT(v.pagado) as voluntarios')
	->from('Voluntario v')
	->where('v.apto IS NULL OR v.apto = 1')
	->groupBy('v.pagado')
	->orderBy('voluntarios DESC');
      
      $voluntarios_por_pagados_brutos = $q->fetchArray();

      foreach($voluntarios_por_pagados_brutos as $voluntarios_por_pagado) {
	if ($voluntarios_por_pagado['pagado']) {
	  $etiqueta = 'Sí pagado';
	} else {
	  $etiqueta = 'No pagado';
	}
	  $voluntarios_por_pagados[] = array('voluntarios'=>(int)$voluntarios_por_pagado['voluntarios'],'pagado'=>$etiqueta);
      }
      
      return $voluntarios_por_pagados;
    }

    public function voluntariosTalla()
    {
      $q = Doctrine_Query::create()
	->select('v.talla as talla')
	->addSelect('COUNT(v.talla) as voluntarios')
	->from('Voluntario v')
	->where('v.apto IS NULL OR v.apto = 1')
	->groupBy('v.talla')
	->orderBy('voluntarios DESC');
      
      $voluntarios_por_tallas_brutos = $q->fetchArray();

      foreach($voluntarios_por_tallas_brutos as $voluntarios_por_talla) {
	  $voluntarios_por_tallas[] = array('voluntarios'=>(int)$voluntarios_por_talla['voluntarios'],'talla'=>$voluntarios_por_talla['talla']);
      }
      
      return $voluntarios_por_tallas;
    }

    public function voluntariosEdad()
    {
      $edad_voluntarios = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc(
"SELECT COUNT(*) as cantidad,
  CASE
  WHEN edad < 16 THEN 'entre 0 y 16 años'
  WHEN edad < 18 THEN 'entre 16 y 18 años'
  WHEN edad < 20 THEN 'entre 18 y 20 años'
  WHEN edad < 23 THEN 'entre 20 y 23 años'
  WHEN edad < 25 THEN 'entre 23 y 25 años'
  WHEN edad < 28 THEN 'entre 25 y 28 años'
  WHEN edad < 30 THEN 'entre 28 y 30 años'
  WHEN edad < 35 THEN 'entre 30 y 35 años'
  WHEN edad < 40 THEN 'entre 35 y 40 años'
  WHEN edad < 45 THEN 'entre 35 y 45 años'
  WHEN edad < 65 THEN 'entre 45 y 65 años'
  ELSE 'mayor de 65'
  END
  AS grupo_edad
FROM (SELECT v.id, FLOOR(DATEDIFF(CURRENT_DATE(), v.fecha_nacimiento)/365.25) AS edad
      FROM voluntario v WHERE (v.apto IS NULL OR v.apto = 1)) AS v1

GROUP BY grupo_edad");
      return $edad_voluntarios;
    }

    public function voluntariosEdadES()
    {
      $edad_voluntarios = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc(
"SELECT COUNT(*) as cantidad,
  CASE
  WHEN edad < 16 THEN 'entre 0 y 16 años'
  WHEN edad < 18 THEN 'entre 16 y 18 años'
  WHEN edad < 20 THEN 'entre 18 y 20 años'
  WHEN edad < 23 THEN 'entre 20 y 23 años'
  WHEN edad < 25 THEN 'entre 23 y 25 años'
  WHEN edad < 28 THEN 'entre 25 y 28 años'
  WHEN edad < 30 THEN 'entre 28 y 30 años'
  WHEN edad < 35 THEN 'entre 30 y 35 años'
  WHEN edad < 40 THEN 'entre 35 y 40 años'
  WHEN edad < 45 THEN 'entre 35 y 45 años'
  WHEN edad < 65 THEN 'entre 45 y 65 años'
  ELSE 'mayor de 65'
  END
  AS grupo_edad
FROM (SELECT v.id, FLOOR(DATEDIFF(CURRENT_DATE(), v.fecha_nacimiento)/365.25) AS edad FROM voluntario v WHERE (v.apto IS NULL OR v.apto = 1) AND v.pais='ES') AS v1 GROUP BY grupo_edad");
      return $edad_voluntarios;
    }

    public function voluntariosEdadMadrid()
    {
      $edad_voluntarios = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc(
"SELECT COUNT(*) as cantidad,
  CASE
  WHEN edad < 16 THEN 'entre 0 y 16 años'
  WHEN edad < 18 THEN 'entre 16 y 18 años'
  WHEN edad < 20 THEN 'entre 18 y 20 años'
  WHEN edad < 23 THEN 'entre 20 y 23 años'
  WHEN edad < 25 THEN 'entre 23 y 25 años'
  WHEN edad < 28 THEN 'entre 25 y 28 años'
  WHEN edad < 30 THEN 'entre 28 y 30 años'
  WHEN edad < 35 THEN 'entre 30 y 35 años'
  WHEN edad < 40 THEN 'entre 35 y 40 años'
  WHEN edad < 45 THEN 'entre 35 y 45 años'
  WHEN edad < 65 THEN 'entre 45 y 65 años'
  ELSE 'mayor de 65'
  END
  AS grupo_edad
FROM (SELECT v.id, FLOOR(DATEDIFF(CURRENT_DATE(), v.fecha_nacimiento)/365.25) AS edad FROM voluntario v WHERE (v.apto IS NULL OR v.apto = 1) AND v.pais='ES' AND v.provincia_id=32) AS v1 GROUP BY grupo_edad");
      return $edad_voluntarios;
    }

    public function voluntariosMovimiento()
    {
      $q = Doctrine_Query::create()
	->select('m.nombre')
	->addSelect('COUNT(v.movimiento_id) as voluntarios')
	->from('Movimiento m')
	->leftJoin('m.Voluntario v')
	->where('v.apto IS NULL OR v.apto = 1')
       	->groupBy('m.id')
       	->orderBy('voluntarios DESC');

      return $q->fetchArray();
    }

    public function voluntariosParroquia()
    {
      $q = Doctrine_Query::create()
	->select('p.nombre')
	->addSelect('COUNT(v.parroquia_id) as voluntarios')
	->from('Parroquia p')
	->leftJoin('p.Voluntario v')
	->where('v.apto IS NULL OR v.apto = 1')
       	->groupBy('p.id')
       	->orderBy('voluntarios DESC');

      $parroquias_bruto = $q->fetchArray();
      $i = 1;
      $num_detalle = 15;
      $resto = 0;
      foreach($parroquias_bruto as $parroquia) {
	if ($i<$num_detalle) {
	  $parroquias[] = $parroquia;
	  $i++;	  
	} else {
	  $resto += $parroquia['voluntarios'];
	}
      }
      $parroquias[] = array('nombre'=>'Resto parroquias','voluntarios'=>$resto);
      return $parroquias;
    }

    /**
     * Voluntarios por equipos
     */
    public function voluntariosEquipo()
    {
      $q = Doctrine_Query::create()
	->select('e.id, e.nombre')
	->addSelect('COUNT(v.equipo_id) as voluntarios')
	->from('Equipo e')
	->leftJoin('e.Voluntarios v')
	->where('v.apto IS NULL OR v.apto = 1')
       	->groupBy('e.id')
       	->orderBy('voluntarios DESC');

      $equipos = $q->fetchArray();
      return $equipos;
    }

    /**
     * Voluntarios en equipo
     */
    public function voluntariosEnEquipo()
    {
    $equipo_si = Doctrine_Query::create()->select('COUNT(id) as voluntarios, "Asignados a equipo" as equipo')
      ->from('Voluntario')
      ->where('equipo_id IS NOT NULL')
      ->addWhere('apto IS NULL OR apto = 1')
      ->fetchArray();

    $equipo_no = Doctrine_Query::create()->select('COUNT(id) as voluntarios, "Sin asignar a equipo" as equipo')
      ->from('Voluntario')
      ->where('equipo_id IS NULL')
      ->addWhere('apto IS NULL OR apto = 1')
      ->fetchArray();

    return array_merge($equipo_si, $equipo_no);
    }

    /**
     * Voluntarios que han sido seleccionados como jefes de equipo
     */
    public function findJefesEquipo()
    {
      return $this->findByJefeEquipo(true);
    }

    /**
     * Voluntarios de Madrid por nivel de inglés
     */
    public function voluntariosInglesMadrid()
    {
      $q = Doctrine_Query::create()
	->select('v.nivel_ingles as nivel')
	->addSelect('COUNT(nivel_ingles) as voluntarios')
	->from('Voluntario v')
	->where('v.apto IS NULL OR v.apto = 1')
	->andWhere('v.pais = "ES"')
	->andWhere('v.provincia_id = 32')
	->groupBy('nivel_ingles');
      
      $voluntarios_nivel_raw = $q->fetchArray();
      $voluntarios_nivel = array();
      foreach($voluntarios_nivel_raw as $nivel) {
	$voluntarios_nivel[$nivel['nivel']] = $nivel['voluntarios'];
      }
      return $voluntarios_nivel;
    }

    /**
     * Voluntarios de Madrid por nivel de frances
     */
    public function voluntariosFrancesMadrid()
    {
      $q = Doctrine_Query::create()
	->select('v.nivel_frances as nivel')
	->addSelect('COUNT(nivel_frances) as voluntarios')
	->from('Voluntario v')
	->where('v.apto IS NULL OR v.apto = 1')
	->andWhere('v.pais = "ES"')
	->andWhere('v.provincia_id = 32')
	->groupBy('nivel_frances');

      $voluntarios_nivel_raw = $q->fetchArray();
      $voluntarios_nivel = array();
      foreach($voluntarios_nivel_raw as $nivel) {
	$voluntarios_nivel[$nivel['nivel']] = $nivel['voluntarios'];
      }
      return $voluntarios_nivel;
    }

    /**
     * Voluntarios de Madrid por nivel de inglés
     */
    public function voluntariosAlemanMadrid()
    {
      $q = Doctrine_Query::create()
	->select('v.nivel_aleman as nivel')
	->addSelect('COUNT(nivel_aleman) as voluntarios')
	->from('Voluntario v')
	->where('v.apto IS NULL OR v.apto = 1')
	->andWhere('v.pais = "ES"')
	->andWhere('v.provincia_id = 32')
	->groupBy('nivel_aleman');
      
      $voluntarios_nivel_raw = $q->fetchArray();
      $voluntarios_nivel = array();
      foreach($voluntarios_nivel_raw as $nivel) {
	$voluntarios_nivel[$nivel['nivel']] = $nivel['voluntarios'];
      }
      return $voluntarios_nivel;
    }

    /**
     * Devuelve los voluntarios con el join contra equipos, para listado de voluntarios.
     */
    public static function retrieveBackendVoluntarioList(Doctrine_Query $q) {
      $rootAlias = $q->getRootAlias();
      $q->leftJoin($rootAlias.'.Equipo equipo')
	->leftJoin($rootAlias.'.Provincia p')
	->leftJoin('equipo.Perfiles perfiles');
      return $q;
    }

    /**
     * Voluntarios diocesis
     */
    public function voluntariosDiocesis()
    {
      $madrid = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc(
'SELECT "Madrid" AS diocesis, COUNT(*) AS voluntarios
FROM voluntario
WHERE voluntario.provincia_id = 32
AND voluntario.parroquia_id IS NOT NULL
AND voluntario.ciudad IN
  (SELECT DISTINCT parroquia.municipio
   FROM parroquia
   LEFT JOIN arciprestazgo ON parroquia.arciprestazgo_id = arciprestazgo.id
   WHERE arciprestazgo.diocesis_id = 1)');

      $alcala = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc(
'SELECT "Alcalá" AS diocesis, COUNT(*) AS voluntarios
FROM voluntario
WHERE voluntario.provincia_id = 32
AND voluntario.parroquia_id IS NOT NULL
AND voluntario.ciudad IN
  (SELECT DISTINCT parroquia.municipio
   FROM parroquia
   LEFT JOIN arciprestazgo ON parroquia.arciprestazgo_id = arciprestazgo.id
   WHERE arciprestazgo.diocesis_id = 2)');

      $getafe = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc(
'SELECT "Getafe" AS diocesis, COUNT(*) AS voluntarios
FROM voluntario
WHERE voluntario.provincia_id = 32
AND voluntario.parroquia_id IS NOT NULL
AND voluntario.ciudad IN
  (SELECT DISTINCT parroquia.municipio
   FROM parroquia
   LEFT JOIN arciprestazgo ON parroquia.arciprestazgo_id = arciprestazgo.id
   WHERE arciprestazgo.diocesis_id = 3)');

      $sin_parroquia = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc(
'SELECT "Sin parroquia" AS diocesis, COUNT(*) AS voluntarios
FROM voluntario
WHERE voluntario.provincia_id = 32
AND voluntario.parroquia_id IS NULL');

      return array_merge($madrid,$alcala,$getafe,$sin_parroquia);
    }

    /**
     *
     */
    public function voluntariosSeguridad()
    {
      /* Realizar las 12 consultas (una por evento de seguridad) */
      for ($i=1; $i<=12; $i++) {
	$q = Doctrine_Query::create()
	  ->select('v.nivel_seguridad_'.$i)
	  ->addSelect('COUNT(v.nivel_seguridad_'.$i.') as voluntarios')
	  ->from('Voluntario v INDEXBY v.nivel_seguridad_'.$i)
	  ->where('v.apto = 1')
	  ->groupBy('v.nivel_seguridad_'.$i);
	$seguridad_eventos[$i] = $q->fetchArray();
      }
      
      /* Iterar sobre el resultado para agrupar por niveles, no por eventos (es lo que necesita el flash chart) */
      foreach($seguridad_eventos as $id_evento => $seguridad_evento) {
	$seguridad_niveles['Nulo'][] = array_key_exists('Nulo',$seguridad_evento) ? (int)$seguridad_evento['Nulo']['voluntarios'] : 0;
	$seguridad_niveles['Gris'][] = array_key_exists('Gris',$seguridad_evento) ? (int)$seguridad_evento['Gris']['voluntarios'] : 0;
	$seguridad_niveles['Azul'][] = array_key_exists('Azul',$seguridad_evento) ? (int)$seguridad_evento['Azul']['voluntarios'] : 0;
	$seguridad_niveles['Rojo'][] = array_key_exists('Rojo',$seguridad_evento) ? (int)$seguridad_evento['Rojo']['voluntarios'] : 0;
      }
      
      return $seguridad_niveles;
    }

    /**
     *
     */
    public function voluntariosSeguridadEventos()
    {
      /* Realizar las 12 consultas (una por evento de seguridad) */
      for ($i=1; $i<=12; $i++) {
	$q = Doctrine_Query::create()
	  ->select('v.nivel_seguridad_'.$i)
	  ->addSelect('COUNT(v.nivel_seguridad_'.$i.') as voluntarios')
	  ->from('Voluntario v INDEXBY v.nivel_seguridad_'.$i)
	  ->where('v.apto = 1')
	  ->groupBy('v.nivel_seguridad_'.$i);
	$seguridad_eventos[$i] = $q->fetchArray();
      }
      
      return $seguridad_eventos;
    }

    /**
     *
     */
    public function voluntariosSeguridadOrden()
    {
      /* Realizar las 12 consultas (una por evento de seguridad) */
      for ($i=1; $i<=12; $i++) {
	$q = Doctrine_Query::create()
	  ->select('v.nivel_seguridad_'.$i)
	  ->addSelect('COUNT(v.nivel_seguridad_'.$i.') as voluntarios')
	  ->from('Voluntario v INDEXBY v.nivel_seguridad_'.$i)
	  ->leftJoin('v.Equipo e')
	  ->leftJoin('e.Perfiles p')
	  ->where('v.apto IS NULL OR v.apto = 1')
	  ->andWhere('p.nombre = "Orden"')
	  ->groupBy('v.nivel_seguridad_'.$i);
	$seguridad_eventos[$i] = $q->fetchArray();
      }
      
      /* Iterar sobre el resultado para agrupar por niveles, no por eventos (es lo que necesita el flash chart) */
      foreach($seguridad_eventos as $id_evento => $seguridad_evento) {
	$seguridad_niveles['Nulo'][] = array_key_exists('Nulo',$seguridad_evento) ? (int)$seguridad_evento['Nulo']['voluntarios'] : 0;
	$seguridad_niveles['Gris'][] = array_key_exists('Gris',$seguridad_evento) ? (int)$seguridad_evento['Gris']['voluntarios'] : 0;
	$seguridad_niveles['Azul'][] = array_key_exists('Azul',$seguridad_evento) ? (int)$seguridad_evento['Azul']['voluntarios'] : 0;
	$seguridad_niveles['Rojo'][] = array_key_exists('Rojo',$seguridad_evento) ? (int)$seguridad_evento['Rojo']['voluntarios'] : 0;
      }
      
      return $seguridad_niveles;
    }

    /**
     *
     */
    public function voluntariosSeguridadEventosOrden()
    {
      /* Realizar las 12 consultas (una por evento de seguridad) */
      for ($i=1; $i<=12; $i++) {
	$q = Doctrine_Query::create()
	  ->select('v.nivel_seguridad_'.$i)
	  ->addSelect('COUNT(v.nivel_seguridad_'.$i.') as voluntarios')
	  ->from('Voluntario v INDEXBY v.nivel_seguridad_'.$i)
	  ->leftJoin('v.Equipo e')
	  ->leftJoin('e.Perfiles p')
	  ->where('v.apto IS NULL OR v.apto = 1')
	  ->andWhere('p.nombre = "Orden"')
	  ->groupBy('v.nivel_seguridad_'.$i);
	$seguridad_eventos[$i] = $q->fetchArray();
      }
      
      return $seguridad_eventos;
    }

    /**
     *
     */
    public function voluntariosSeguridadAcreditable()
    {
      /* Realizar las 12 consultas (una por evento de seguridad) */
      for ($i=1; $i<=12; $i++) {
	$q = Doctrine_Query::create()
	  ->select('v.nivel_seguridad_'.$i)
	  ->addSelect('COUNT(v.nivel_seguridad_'.$i.') as voluntarios')
	  ->from('Voluntario v INDEXBY v.nivel_seguridad_'.$i)
	  ->leftJoin('v.Equipo e')
	  ->leftJoin('e.Perfiles p')
	  ->where('v.apto IS NULL OR v.apto = 1')
	  ->andWhere('e.acreditable = 1')
	  ->groupBy('v.nivel_seguridad_'.$i);
	$seguridad_eventos[$i] = $q->fetchArray();
      }
      
      /* Iterar sobre el resultado para agrupar por niveles, no por eventos (es lo que necesita el flash chart) */
      foreach($seguridad_eventos as $id_evento => $seguridad_evento) {
	$seguridad_niveles['Nulo'][] = array_key_exists('Nulo',$seguridad_evento) ? (int)$seguridad_evento['Nulo']['voluntarios'] : 0;
	$seguridad_niveles['Gris'][] = array_key_exists('Gris',$seguridad_evento) ? (int)$seguridad_evento['Gris']['voluntarios'] : 0;
	$seguridad_niveles['Azul'][] = array_key_exists('Azul',$seguridad_evento) ? (int)$seguridad_evento['Azul']['voluntarios'] : 0;
	$seguridad_niveles['Rojo'][] = array_key_exists('Rojo',$seguridad_evento) ? (int)$seguridad_evento['Rojo']['voluntarios'] : 0;
      }
      
      return $seguridad_niveles;
    }

    /**
     *
     */
    public function voluntariosSeguridadEventosAcreditable()
    {
      /* Realizar las 12 consultas (una por evento de seguridad) */
      for ($i=1; $i<=12; $i++) {
	$q = Doctrine_Query::create()
	  ->select('v.nivel_seguridad_'.$i)
	  ->addSelect('COUNT(v.nivel_seguridad_'.$i.') as voluntarios')
	  ->from('Voluntario v INDEXBY v.nivel_seguridad_'.$i)
	  ->leftJoin('v.Equipo e')
	  ->leftJoin('e.Perfiles p')
	  ->where('v.apto IS NULL OR v.apto = 1')
	  ->andWhere('e.acreditable = 1')
	  ->groupBy('v.nivel_seguridad_'.$i);
	$seguridad_eventos[$i] = $q->fetchArray();
      }
      
      return $seguridad_eventos;
    }

}
