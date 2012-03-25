<?php

/**
 * Test csv
 */
class TestCsvForm extends BaseForm
{
  public function configure()
  {
    $this->setWidget('separador', new sfWidgetFormSelectRadio(array('choices'=>array('";"','","'))));
    $this->widgetSchema['separador']->setDefault(0);
    $this->setValidator('separador', new sfValidatorPass());

    $this->setWidget('ignorar_primera_fila', new sfWidgetFormInputCheckbox());
    $this->setValidator('ignorar_primera_fila', new sfValidatorBoolean(array('required' => false)));

    $this->setWidget('columna_numero_documento_identificativo', new sfWidgetFormInputText());
    $this->setValidator('columna_numero_documento_identificativo', new sfValidatorString(array('required' => true)));

    $this->setWidget('csv', new sfWidgetFormInputFile(array('label'=>'Fichero csv')));
    $this->setValidator('csv', new sfValidatorFile(array('required' => true,)));

    $this->widgetSchema->setNameFormat('test_csv[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    $this->widgetSchema->setFormFormatterName('Admin');

  }

}
