<?php

/**
 * Perfil form.
 *
 * @package    voluntarios
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PerfilForm extends BasePerfilForm
{
  public function configure()
  {
    unset($this['equipos_list']);
  }
}
