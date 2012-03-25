<?php

/**
 * ayuda actions.
 *
 * @package    voluntarios
 * @subpackage ayuda
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ayudaActions extends sfActions
{
  /**
   * Contactar: usuarios pueden enviar mail a desarrolladores
   */
  public function executeContactarDesarrolladores(sfWebRequest $request)
  {
    $this->form = new EmailForm(null,array('asunto'=>false,'adjunto'=>false,'remitente'=>false));
    if ($request->hasParameter('email')) {
      $this->form->bind($request->getParameter('email'));
      $destinatarios = array('mzaforas@gmail.com','jaimefma@gmail.com','anabcuk@yahoo.es');
      MailManager::enviarMail($destinatarios,
			      '[JMJ 2011] Mensaje de usuario de la aplicación de voluntarios',
			      "El usuario ".$this->getUser()->getName()." ha enviado el siguiente mensaje:\n\n".$this->form->getValue('cuerpo'));
      $this->getUser()->setFlash('notice','El mensaje ha sido enviado correctamente al equipo de desarrolladores. ¡Muchas gracias!');
      $this->redirect('voluntario/index');
    }
  }

  /**
   * Contactar: desarrolladores pueden enviar mail a usuarios
   */
  public function executeContactarUsuarios(sfWebRequest $request)
  {
    $this->form = new EmailForm(array('asunto'=>'[JMJ 2011 App Voluntarios] '),array('adjunto'=>false,'remitente'=>false));

    if ($request->hasParameter('email')) {
      $this->form->bind($request->getParameter('email'));
      if ($this->form->isValid()) {
	$query = Doctrine_Query::create()->select('email_address')->from('sfGuardUser');
	$destinatarios = $query->execute()->toKeyValueArray('id','email_address');
	MailManager::enviarMail($destinatarios,
				$this->form->getValue('asunto'),
				$this->form->getValue('cuerpo'),
				null,
				array('mzaforas@gmail.com'=>'Informática Voluntarios JMJ Madrid 2011'));
	$this->getUser()->setFlash('notice','El mensaje ha sido enviado correctamente a los usuarios del sistema');
	$this->redirect('voluntario/index');
      }
    }
  }

  /**
   * Ver preguntas frecuentes
   */
  public function executePreguntasFrecuentes(sfWebRequest $request)
  {
  }

}
