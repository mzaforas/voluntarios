<?php

class EtiquetableForm extends BaseTaggingForm
{
  public function configure()
  {
    $this->widgetSchema['taggable_model'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['taggable_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['tag_id']->setLabel('Formación');

    $this->widgetSchema->setFormFormatterName('Admin');
  }
}
