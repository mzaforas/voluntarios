<?php

/**
 * Equipo form.
 *
 * @package    voluntarios
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */


class EquipoForm extends BaseEquipoForm
{
  public function configure()
  {
    unset($this['tareas_list'],$this['fecha_revisado_policia']);
    $this->widgetSchema['perfiles_list']->setOption('renderer_class', 'sfWidgetFormSelectDoubleList');
    $this->widgetSchema['perfiles_list']->setOption('renderer_options', array('label_unassociated'=>'No asociado','label_associated'=>'Asociado'));
    $this->widgetSchema['perfiles_list']->setLabel('Perfiles');

    $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback'=>array($this, 'postValidator'))));
  }

  public function postValidator($validator, $values)
  {
    if( !$this->isNew() )
    {
        $perfiles = $values['perfiles_list'];
        $equipo = Doctrine::getTable('Equipo')->find($values['id']);
        $tareas = $equipo->getTareas();
        foreach($tareas as $tarea)
        {
          $perfil_tarea = $tarea->getPerfilId();
          if( isset($perfil_tarea) )
          {
            $cumplePerfil = False;
            foreach($perfiles as $perfil)
            {
              if( $perfil == $perfil_tarea ){
                $cumplePerfil = True;
                break;
              }
            }
            if( !$cumplePerfil )
            {
              $error_msg = 'El nuevo perfil del equipo no cumple con el perfil de la tarea '.$tarea;
              throw new sfValidatorError($validator, $error_msg);
            }
          }
        }
    }
    return $values;
  }
}
