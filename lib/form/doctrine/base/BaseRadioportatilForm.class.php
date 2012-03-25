<?php

/**
 * Radioportatil form base class.
 *
 * @method Radioportatil getObject() Returns the current form's model object
 *
 * @package    voluntarios
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRadioportatilForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'numero_serie' => new sfWidgetFormInputText(),
      'tareas_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tarea')),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'numero_serie' => new sfValidatorString(array('max_length' => 255)),
      'tareas_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tarea', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('radioportatil[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Radioportatil';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['tareas_list']))
    {
      $this->setDefault('tareas_list', $this->object->Tareas->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveTareasList($con);

    parent::doSave($con);
  }

  public function saveTareasList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['tareas_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Tareas->getPrimaryKeys();
    $values = $this->getValue('tareas_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Tareas', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Tareas', array_values($link));
    }
  }

}
