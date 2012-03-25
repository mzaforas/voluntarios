<?php

/**
 * Voluntario form.
 *
 * @package    voluntarios
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VoluntarioForm extends BaseVoluntarioForm
{
  public function configure()
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));

    /* Campos */
    $this->useFields(array('nombre','primer_apellido','segundo_apellido','tipo_documento_identificativo','numero_documento_identificativo','sexo','talla',
			   'nacionalidad','fecha_nacimiento','pais','provincia_id','codigo_postal','ciudad','tipo_via','direccion','numero_via','escalera',
			   'piso','puerta','telefono_fijo','telefono_movil','fax','email','nivel_estudios','especialidad','otros_estudios','nivel_ingles',
			   'nivel_frances','nivel_aleman','otro_idioma','nivel_otro_idioma','experiencia_administracion','experiencia_turismo',
			   'experiencia_informatica','experiencia_seguridad','experiencia_educacion','experiencia_sanitario','experiencia_traduccion',
			   'experiencia_recursos_humanos','experiencia_otro','experiencia_otro_campo','experiencia_voluntario',
			   'experiencia_voluntario_donde','experiencia_trato_discapacitados','carnet_conducir','parroquia_id','compromiso_religioso',
			   'movimiento_id','disponibilidad_dias','disponibilidad_horas','colaborar_acogida','colaborar_viacrucis','colaborar_vigilia',
			   'colaborar_despedida','colaborar_ambientacion','colaborar_protocolo','colaborar_ministro_comunion','autorizacion_boletin',
			   'autorizacion_diocesis','pagado'));

    /* Redeclaración de widgets */
    for($i=1910; $i<=2000; $i++) { $años[$i] = $i; }
    $this->widgetSchema['fecha_nacimiento'] = new sfWidgetFormDate(array('format'=>'%day%/%month%/%year%','years'=>$años), array('class'=>'hora_corta'));
    $this->widgetSchema['pais'] = new sfWidgetFormI18nChoiceCountry(array('culture'=>sfContext::getInstance()->getUser()->getCulture(),'add_empty'=>true));
    $this->widgetSchema['nacionalidad'] = new sfWidgetFormI18nChoiceCountry(array('culture'=>sfContext::getInstance()->getUser()->getCulture(),'add_empty'=>true));
    $this->widgetSchema['parroquia_id']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
    $this->widgetSchema['parroquia_id']->setOption('renderer_options', array('model' => 'Parroquia', 'url' => url_for('parroquia/autocompletar')));

    /* Redeclaración de validadores */
    $this->validatorSchema['pais'] = new sfValidatorI18nChoiceCountry(array('required'=>true));
    $this->validatorSchema['nacionalidad'] = new sfValidatorI18nChoiceCountry(array('required'=>false));
    $this->validatorSchema['email'] = new sfValidatorEmail(array('required'=>true));
    $EmailPattern = '/^([-_a-z0-9\.]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/i';
    $this->validatorSchema['email']->setOption('pattern', $EmailPattern);
  }
}
