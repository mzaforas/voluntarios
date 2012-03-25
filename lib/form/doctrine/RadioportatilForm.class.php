<?php

/**
 * Radioportatil form.
 *
 * @package    voluntarios
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RadioportatilForm extends BaseRadioportatilForm
{
  public function configure()
  {
    $this->useFields(array('numero_serie'));
  }
}
