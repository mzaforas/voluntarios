<?php

/**
 * Lugar form.
 *
 * @package    voluntarios
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LugarForm extends BaseLugarForm
{
  public function configure()
  {
    $this->widgetSchema['arciprestazgo_id']->setOption('order_by', array('nombre','asc'));
  }
}
