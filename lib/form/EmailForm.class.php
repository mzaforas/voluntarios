<?php

/**
 * Email form base class.
 *
 * @method Email getObject() Returns the current form's model object
 *
 * @package    emails
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
class EmailForm extends BaseForm
{
  public function configure()
  {
    // Cuentas desde las que se pueden enviar las cosas
    if($this->getOption('remitente', true)) 
    {
      $cuentas = array('voluntarios@jmj2011madrid.com' =>'voluntarios@jmj2011madrid.com',
                       'voluntariosanitariojmj@gmail.com' => 'voluntariosanitariojmj@gmail.com',
		       'coordinacionacionalvoluntario@gmail.com' => 'coordinacionacionalvoluntario@gmail.com',
		       'voluntariosjmj2011@yahoo.es' => 'voluntariosjmj2011@yahoo.es',
		       'gestion.voluntariosjmj@gmail.com' => 'gestion.voluntariosjmj@gmail.com',
                       'voluntariojmj.foto@gmail.com' => 'voluntariojmj.foto@gmail.com',
		       'fotovoluntariosjmj@gmail.com' => 'fotovoluntariosjmj@gmail.com',
		       'voluntariadoafrica@gmail.com' => 'voluntariadoafrica@gmail.com',
		       'voluntariadoamericadelnorte@gmail.com' => 'voluntariadoamericadelnorte@gmail.com',
		       'voluntariadoamericacentral@gmail.com' => 'voluntariadoamericacentral@gmail.com',
		       'voluntariadoamericadelsur@gmail.com' => 'voluntariadoamericadelsur@gmail.com',
		       'voluntariadoasia@gmail.com' => 'voluntariadoasia@gmail.com',
		       'voluntariadoeuropa@gmail.com' => 'voluntariadoeuropa@gmail.com',
		       'voluntariadooceania@gmail.com' => 'voluntariadooceania@gmail.com'
                       //'pagovoluntariosjmj@gmail.com' => 'pagovoluntariosjmj@gmail.com',
                       );
      $this->setWidget('remitente', new sfWidgetFormChoice(array('choices' => $cuentas,)) );
      $this->setValidator('remitente', new sfValidatorChoice(array('choices' => $cuentas,)) );
    }
    if ($this->getOption('asunto',true)) {
      $this->setWidget('asunto', new sfWidgetFormInputText(array(),array('style'=>'width: 500px')));
      $this->setValidator('asunto', new sfValidatorString(array('max_length' => 255, 'required' => false)));
    }

    if ($this->getOption('cuerpo',true)) {
      $this->setWidget('cuerpo', new sfWidgetFormTextareaTinyMCE(array(),array('style'=>'width: 100%; height:500px')));
      $this->setValidator('cuerpo', new sfValidatorString(array('max_length' => 4000, 'required' => false)));
    }

    if ($this->getOption('adjunto',true)) {
      $this->setWidget('adjunto', new sfWidgetFormInputFile(array('label'=>'Fichero adjunto')));
      $this->setValidator('adjunto', new sfValidatorFile(array('path' => sfConfig::get('sf_upload_dir').'/', 'required' => false,)));
    }

    $this->widgetSchema->setNameFormat('email[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    $this->widgetSchema->setFormFormatterName('Admin');
  }

}
