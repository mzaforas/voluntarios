<?php

require_once dirname(__FILE__).'/../lib/eventoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/eventoGeneratorHelper.class.php';

/**
 * evento actions.
 *
 * @package    voluntarios
 * @subpackage evento
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eventoActions extends autoEventoActions
{
  public function executeCalendario(sfWebRequest $request) {
    $calendario = new sfiCalCalendar();
    $calendario->setConfig( "unique_id", "voluntariosjmj2011.archimadrid.eu/evento" );
    $calendario->setProperty( "X-WR-CALNAME", "Calendario de eventos" );
    $calendario->setProperty( "X-WR-CALDESC", "Calendario de eventos de la JMJ" );
    $calendario->setProperty( "X-WR-TIMEZONE", "Etc/GMT+1" );

    $q = Doctrine_Query::create()->from('Evento e');
    $eventos = $q->execute();

    foreach ($eventos as $evento) {
      $e = new sfiCalEvent();                             
      $e->setProperty( 'summary', $evento->getNombre());
      $comienzo = $evento->getDateTimeObject('comienzo');
      $year = $comienzo->format('Y');
      $month = $comienzo->format('m');
      $day = $comienzo->format('d');
      $hour = $comienzo->format('H');
      $minute = $comienzo->format('i');
      $second = $comienzo->format('s');
      $e->setProperty( 'dtstart',  $year, $month, $day, $hour, $minute, $second );  
      $duration = (strtotime($evento->getFin())-strtotime($evento->getComienzo())) / 60; // in minutes
      $duration_days = intval(intval($duration / 60) / 24);
      $duration_hours = (intval($duration / 60) % 60);
      $duration_minutes = $duration % 60;
      $e->setProperty( 'duration', 0, $duration_days, $duration_hours, $duration_minutes);                   
      $e->setProperty( 'description', $evento->getDescripcion());
      $e->setProperty( 'location', $evento->getLugar());   
      $calendario->addComponent( $e );                    
    }

    /* alt. production */
    $calendario->returnCalendar();               // generate and redirect output to user browser

    /* alt. dev. and test */
    $this->ical = $calendario->createCalendar(); // generate and get output in string, for testing?
    dieh($this->ical);
    return sfView::NONE;
  }

}
