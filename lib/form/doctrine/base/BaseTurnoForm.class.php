<?php

/**
 * Turno form base class.
 *
 * @method Turno getObject() Returns the current form's model object
 *
 * @package    voluntarios
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTurnoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'nombre'           => new sfWidgetFormInputText(),
      'descripcion'      => new sfWidgetFormTextarea(),
      'lugar_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lugar'), 'add_empty' => true)),
      'fecha'            => new sfWidgetFormDate(),
      'hora_comienzo'    => new sfWidgetFormTime(),
      'hora_fin'         => new sfWidgetFormTime(),
      'voluntarios_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Voluntario')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'           => new sfValidatorString(array('max_length' => 255)),
      'descripcion'      => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'lugar_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lugar'), 'required' => false)),
      'fecha'            => new sfValidatorDate(),
      'hora_comienzo'    => new sfValidatorTime(array('required' => false)),
      'hora_fin'         => new sfValidatorTime(array('required' => false)),
      'voluntarios_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Voluntario', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('turno[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Turno';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['voluntarios_list']))
    {
      $this->setDefault('voluntarios_list', $this->object->Voluntarios->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveVoluntariosList($con);

    parent::doSave($con);
  }

  public function saveVoluntariosList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['voluntarios_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Voluntarios->getPrimaryKeys();
    $values = $this->getValue('voluntarios_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Voluntarios', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Voluntarios', array_values($link));
    }
  }

}
