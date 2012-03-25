<?php
class MailManager
{
  public static function shutdown()
  {
    
    global $initial_time;
    global $isSending;
    
    $error = error_get_last();
    echo "Script execution halted ({$error['message']})<BR>";
    if( $isSending )
      {
	$end_time = date(time());
	echo "Eliminando los mails aún no enviados en la franja ['$initial_time' - '$end_time'] ";
	foreach( glob("/home/jmjadmin/voluntariosjmj_mail/*.message") as $filename ){
	  $t=filemtime($filename);
	  if( $initial_time <= $t and $end_time >= $t ){
	    echo "<BR>REMOVE '$filename'";
	    unlink($filename);
	  }
	}
        $isSending = false;
      }
  }

  public static function beginEnviarMail()
  {
    //**** DELETING FILES *******///
    /*
      Este código se encarga de recoger las excepciones del servidor que pudiera haber.
      En caso de haberla, elimina los mails que se hayan generado en un lapso de tiempo.
    */
    
    /* error_reporting(E_ALL); */
    /* ini_set('display_errors', 0); */

    register_shutdown_function('MailManager::shutdown');
    //**** END DELETING FILES *******///

    // Recuperar el tiempo en el que se inicia el envio de mails para 
    // borrarlos  en caso de que haya problemas durante el envio
    global $initial_time;
    global $isSending;
    $isSending = true;
    $initial_time=time();
    // Desactivar el envio de mails mientras se realiza el envio para
    // que no haya posibles envios pertenecientes a la petición en curso
    exec('cd /home/jmjadmin/voluntariosjmj_mail && ln -fs enviar_desactivado.py enviar.py');
  }

  public static function endEnviarMail()
  {
    global $isSending;
    $isSending = false;
    // Reactivar el envio de mails
    exec('cd /home/jmjadmin/voluntariosjmj_mail && ln -fs enviar_activado.py enviar.py');
  }

  /**
   * Enviar un mail sencillo a un grupo de personas. Por refactorización
   */
  public static function enviarMail($destinatarios, $asunto, $cuerpo, $fichero=null, $remitente=null)
  {
    if (!$remitente) {
      $remitente = array('voluntarios@jmj2011madrid.com'=>'Voluntarios JMJ Madrid 2011');
    }
    MailManager::beginEnviarMail();
    //$fd = fopen('/tmp/emails_generados','w');

    foreach($destinatarios as $destinatario) {
      //fwrite($fd,$destinatario."\n");
      $mailer = sfContext::getInstance()->getMailer();
      $message = $mailer->compose($remitente,
				  $destinatario,
				  $asunto);
      $cid = $message->embed(Swift_Image::fromPath(sfConfig::get('sf_web_dir').'/images/encabezado.png'));
      $message->setBody('<img src="'. $cid .'"><br/>'/*<br/>'.str_replace( "\n", "<br/>",*/.$cuerpo, 'text/html');
      $message->addPart($cuerpo, 'text/plain');
      if ($fichero != null) { 
	//	$fichero->save(sfConfig::get('sf_upload_dir').'/'.$fichero->getOriginalName());
	//	$message->attach(Swift_Attachment::fromPath(sfConfig::get('sf_upload_dir').'/'.$fichero->getOriginalName()));
       	$message->attach(Swift_Attachment::fromPath($fichero));
      } 
      $mailer->send($message);
    }

    MailManager::endEnviarMail();
    return count($destinatarios);
  }
}