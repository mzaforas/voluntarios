<?php

/**
 * voluntario actions.
 *
 * @package    voluntarios
 * @subpackage voluntario
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class voluntarioActions extends sfActions
{
  public function executeNew(sfWebRequest $request)
  {
    $this->getUser()->setCulture($request->getParameter('idioma','es'));
    $this->setTemplate('message');
    /*
    if(sfContext::getInstance()->getUser()->getCulture() != 'es') {
      $this->setTemplate('message');
    } else {
      $this->form = new InscripcionVoluntarioForm();
    }
    */
  }

  /* public function executeCreate(sfWebRequest $request) */
  /* { */
  /*   $this->setTemplate('message');   */
    /*
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new InscripcionVoluntarioForm();

    $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
    if ($this->form->isValid()) {
      // testear si es pais != ES
      if( $this->form->getValue('pais') != 'ES' ) {
	$this->setTemplate('message');
      }	else {
	$this->voluntario = $this->form->save();
	// Enviar email de confirmación
	$this->getMailer()->composeAndSend(array('voluntarios@jmj2011madrid.com'=>'Voluntarios JMJ Madrid 2011'),
					   str_replace(';','',$this->voluntario->getEmail()),
					   'Confirmación inscripción JMJ Madrid 2011',
					   "Querido amigo:\n\nQueda formalizada tu inscripción como voluntario para la JMJ Madrid 2011. En estos momentos nos encontramos en una etapa de inscripción y de selección de los voluntarios de carácter permanente. Posteriormente, se contactará con el resto de los voluntarios para indicaros las funciones y tareas que llevaréis a cabo.\n\nTe mantendremos informado a través de la Revista Voluntarios. La recibirás cada mes a través de tu correo electrónico.\n\nDios cuenta contigo. ¡Gracias por tu ilusión!\n\n\n\nDear friend,\n\nThis is to confirm that you have been registered as Volunteer for WYDMadrid 2011. At present we are still processing the applications for “Permanent Volunteers”. In due course a task will be assigned to each of the other volunteers.\n\nEvery month The Volunteers´ Gazette will be sent to you by e-mail to keep you updated.\n\nGod counts on you. Thanks you for your enthusiasm!\n\nBest greetings,\n\nTus datos de contacto/Your contact information:\n\t".$this->voluntario->getNombre()." ".$this->voluntario->getPrimer_apellido()."\n\t".$this->voluntario->getEmail()."\n\t".$this->voluntario->getTelefono_movil());
      }
    } else {
      $this->setTemplate('new');
    }
    */
  /*  } */
}