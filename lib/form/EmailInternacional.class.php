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
class EmailInternacionalForm extends BaseForm
{
  public function setup()
  {
    $idiomas = Doctrine::getTable('Idioma')->createQuery()->execute();
    
    foreach($idiomas as $idioma) {
      $id = $idioma->getId();
      $nombre_idioma = $idioma->getNombre();
      $this->setWidget('asunto_'.$id, new sfWidgetFormInputText());
      $this->widgetSchema['asunto_'.$id]->setLabel('Asunto en '.$nombre_idioma);
      $this->setWidget('cuerpo_'.$id, new sfWidgetFormTextarea(array(),array('style'=>'width: 100%')));
      $this->widgetSchema['cuerpo_'.$id]->setLabel('Cuerpo en '.$nombre_idioma);
      
      $this->setValidator('asunto_'.$id, new sfValidatorString(array('max_length' => 255, 'required' => false)));
      $this->setValidator('cuerpo_'.$id, new sfValidatorString(array('max_length' => 4000, 'required' => false)));
    }

    $this->widgetSchema->setNameFormat('email[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    /* Formato */
    $this->widgetSchema->setFormFormatterName('Div');

    parent::setup();
  }

}
