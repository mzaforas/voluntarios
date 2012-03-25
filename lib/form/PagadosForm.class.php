<?php

/**
 * Pagados
 */
class PagadosForm extends BaseForm
{
  public function configure()
  {

    $this->setWidget('csv', new sfWidgetFormInputFile(array('label'=>'Fichero csv')));
    $this->setValidator('csv', new sfValidatorFile(array('required' => true,)));

    $this->widgetSchema->setNameFormat('pagados[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    $this->widgetSchema->setFormFormatterName('Admin');
  }
}
