<?php
class sfWidgetFormTrilean extends sfWidgetForm
{
  public function configure($options = array(), $attributes = array())
  {
    $this->addOption('choices', array(
				      'null' => 'Sin definir',
				      'no' => 'No',
				      'yes' => 'Sí',
				      ));
  }
  
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    if ($value === null) {
      $value =  'null';
    } elseif ($value === false) {
      $value = 'no';
    } elseif ($value === true) {
      $value = 'yes';
    }

    $options = array();
    foreach ($this->getOption('choices') as $key => $option)
      {
	$attributes_option = array('value' => self::escapeOnce($key));
	if ($key == $value) {
	  $attributes_option['selected'] = 'selected';
	}
	$options[] = $this->renderContentTag('option', self::escapeOnce($option), $attributes_option);
      }
    return $this->renderContentTag('select', "\n".implode("\n", $options)."\n", array_merge(array('name' => $name), $attributes));
  }
}