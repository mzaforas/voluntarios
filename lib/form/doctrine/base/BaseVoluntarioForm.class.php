<?php

/**
 * Voluntario form base class.
 *
 * @method Voluntario getObject() Returns the current form's model object
 *
 * @package    voluntarios
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVoluntarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                                => new sfWidgetFormInputHidden(),
      'deleted_at'                        => new sfWidgetFormDateTime(),
      'nombre'                            => new sfWidgetFormInputText(),
      'primer_apellido'                   => new sfWidgetFormInputText(),
      'segundo_apellido'                  => new sfWidgetFormInputText(),
      'tipo_documento_identificativo'     => new sfWidgetFormChoice(array('choices' => array('NIF' => 'NIF', 'Pasaporte' => 'Pasaporte', 'NIE' => 'NIE', 'Otro documento' => 'Otro documento'))),
      'numero_documento_identificativo'   => new sfWidgetFormInputText(),
      'sexo'                              => new sfWidgetFormChoice(array('choices' => array('Masculino' => 'Masculino', 'Femenino' => 'Femenino'))),
      'talla'                             => new sfWidgetFormChoice(array('choices' => array('S' => 'S', 'M' => 'M', 'L' => 'L', 'XL' => 'XL', 'XXL' => 'XXL', 'XXXL' => 'XXXL'))),
      'nacionalidad'                      => new sfWidgetFormInputText(),
      'fecha_nacimiento'                  => new sfWidgetFormDate(),
      'pais'                              => new sfWidgetFormInputText(),
      'provincia_id'                      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Provincia'), 'add_empty' => true)),
      'codigo_postal'                     => new sfWidgetFormInputText(),
      'ciudad'                            => new sfWidgetFormInputText(),
      'tipo_via'                          => new sfWidgetFormInputText(),
      'direccion'                         => new sfWidgetFormInputText(),
      'numero_via'                        => new sfWidgetFormInputText(),
      'escalera'                          => new sfWidgetFormInputText(),
      'piso'                              => new sfWidgetFormInputText(),
      'puerta'                            => new sfWidgetFormInputText(),
      'telefono_fijo'                     => new sfWidgetFormInputText(),
      'telefono_movil'                    => new sfWidgetFormInputText(),
      'fax'                               => new sfWidgetFormInputText(),
      'email'                             => new sfWidgetFormInputText(),
      'nivel_estudios'                    => new sfWidgetFormChoice(array('choices' => array('Sin estudios' => 'Sin estudios', 'Estudios básicos' => 'Estudios básicos', 'Bachillerato' => 'Bachillerato', 'Formación profesional' => 'Formación profesional', 'Diplomatura o Ingeniería Técnica' => 'Diplomatura o Ingeniería Técnica', 'Licenciatura o Ingeniería Superior' => 'Licenciatura o Ingeniería Superior'))),
      'especialidad'                      => new sfWidgetFormInputText(),
      'otros_estudios'                    => new sfWidgetFormInputText(),
      'nivel_ingles'                      => new sfWidgetFormChoice(array('choices' => array('No' => 'No', 'Bajo' => 'Bajo', 'Medio' => 'Medio', 'Alto' => 'Alto'))),
      'nivel_frances'                     => new sfWidgetFormChoice(array('choices' => array('No' => 'No', 'Bajo' => 'Bajo', 'Medio' => 'Medio', 'Alto' => 'Alto'))),
      'nivel_aleman'                      => new sfWidgetFormChoice(array('choices' => array('No' => 'No', 'Bajo' => 'Bajo', 'Medio' => 'Medio', 'Alto' => 'Alto'))),
      'otro_idioma'                       => new sfWidgetFormInputText(),
      'nivel_otro_idioma'                 => new sfWidgetFormChoice(array('choices' => array('No' => 'No', 'Bajo' => 'Bajo', 'Medio' => 'Medio', 'Alto' => 'Alto'))),
      'experiencia_administracion'        => new sfWidgetFormInputCheckbox(),
      'experiencia_turismo'               => new sfWidgetFormInputCheckbox(),
      'experiencia_informatica'           => new sfWidgetFormInputCheckbox(),
      'experiencia_seguridad'             => new sfWidgetFormInputCheckbox(),
      'experiencia_educacion'             => new sfWidgetFormInputCheckbox(),
      'experiencia_sanitario'             => new sfWidgetFormInputCheckbox(),
      'experiencia_traduccion'            => new sfWidgetFormInputCheckbox(),
      'experiencia_recursos_humanos'      => new sfWidgetFormInputCheckbox(),
      'experiencia_otro'                  => new sfWidgetFormInputCheckbox(),
      'experiencia_otro_campo'            => new sfWidgetFormInputText(),
      'experiencia_voluntario'            => new sfWidgetFormInputCheckbox(),
      'experiencia_voluntario_donde'      => new sfWidgetFormInputText(),
      'experiencia_trato_discapacitados'  => new sfWidgetFormInputCheckbox(),
      'carnet_conducir'                   => new sfWidgetFormInputCheckbox(),
      'parroquia_id'                      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Parroquia'), 'add_empty' => true)),
      'compromiso_religioso'              => new sfWidgetFormChoice(array('choices' => array('Básico' => 'Básico', 'Laico comprometido' => 'Laico comprometido', 'Catequista' => 'Catequista', 'Ministro de la comunión' => 'Ministro de la comunión'))),
      'movimiento_id'                     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Movimiento'), 'add_empty' => true)),
      'disponibilidad_dias'               => new sfWidgetFormChoice(array('choices' => array('Fines de semana' => 'Fines de semana', 'De lunes a viernes' => 'De lunes a viernes', 'Toda la semana' => 'Toda la semana'))),
      'disponibilidad_horas'              => new sfWidgetFormChoice(array('choices' => array('Mañana' => 'Mañana', 'Tarde' => 'Tarde', 'Indiferente' => 'Indiferente'))),
      'colaborar_acogida'                 => new sfWidgetFormInputCheckbox(),
      'colaborar_viacrucis'               => new sfWidgetFormInputCheckbox(),
      'colaborar_vigilia'                 => new sfWidgetFormInputCheckbox(),
      'colaborar_despedida'               => new sfWidgetFormInputCheckbox(),
      'colaborar_ambientacion'            => new sfWidgetFormInputCheckbox(),
      'colaborar_protocolo'               => new sfWidgetFormInputCheckbox(),
      'colaborar_ministro_comunion'       => new sfWidgetFormInputCheckbox(),
      'autorizacion_boletin'              => new sfWidgetFormInputCheckbox(),
      'autorizacion_diocesis'             => new sfWidgetFormInputCheckbox(),
      'aceptacion_condiciones'            => new sfWidgetFormInputCheckbox(),
      'alojamiento'                       => new sfWidgetFormChoice(array('choices' => array('' => '', 'Domicilio personal' => 'Domicilio personal', 'IFEMA' => 'IFEMA', 'Polideportivo' => 'Polideportivo', 'Albergue' => 'Albergue', 'Otro domicilio' => 'Otro domicilio'))),
      'apto'                              => new sfWidgetFormInputCheckbox(),
      'revisado_policia'                  => new sfWidgetFormInputCheckbox(),
      'jefe_equipo'                       => new sfWidgetFormInputCheckbox(),
      'notas'                             => new sfWidgetFormTextarea(),
      'reunion_inicial'                   => new sfWidgetFormInputCheckbox(),
      'equipo_id'                         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Equipo'), 'add_empty' => true)),
      'foto'                              => new sfWidgetFormInputText(),
      'pagado'                            => new sfWidgetFormInputCheckbox(),
      'entrevista_seleccion'              => new sfWidgetFormInputCheckbox(),
      'abono_transporte'                  => new sfWidgetFormChoice(array('choices' => array('Primera y segunda semana' => 'Primera y segunda semana', 'Sólo segunda semana' => 'Sólo segunda semana'))),
      'numero_acreditacion'               => new sfWidgetFormInputText(),
      'registrado'                        => new sfWidgetFormInputCheckbox(),
      'documento_identificacion_personal' => new sfWidgetFormInputText(),
      'documento_acreditacion'            => new sfWidgetFormInputText(),
      'documento_compromiso'              => new sfWidgetFormInputText(),
      'documento_antecedentes_penales'    => new sfWidgetFormInputText(),
      'documento_autorizacion_paterna'    => new sfWidgetFormInputText(),
      'medio_transporte'                  => new sfWidgetFormChoice(array('choices' => array('Ninguno' => 'Ninguno', 'Avión' => 'Avión', 'Tren' => 'Tren', 'Autobús' => 'Autobús', 'Coche' => 'Coche'))),
      'fecha_llegada'                     => new sfWidgetFormDateTime(),
      'fecha_salida'                      => new sfWidgetFormDateTime(),
      'datos_transporte'                  => new sfWidgetFormTextarea(),
      'nivel_seguridad_1'                 => new sfWidgetFormChoice(array('choices' => array('Nulo' => 'Nulo', 'Gris' => 'Gris', 'Azul' => 'Azul', 'Rojo' => 'Rojo'))),
      'nivel_seguridad_2'                 => new sfWidgetFormChoice(array('choices' => array('Nulo' => 'Nulo', 'Gris' => 'Gris', 'Azul' => 'Azul', 'Rojo' => 'Rojo'))),
      'nivel_seguridad_3'                 => new sfWidgetFormChoice(array('choices' => array('Nulo' => 'Nulo', 'Gris' => 'Gris', 'Azul' => 'Azul', 'Rojo' => 'Rojo'))),
      'nivel_seguridad_4'                 => new sfWidgetFormChoice(array('choices' => array('Nulo' => 'Nulo', 'Gris' => 'Gris', 'Azul' => 'Azul', 'Rojo' => 'Rojo'))),
      'nivel_seguridad_5'                 => new sfWidgetFormChoice(array('choices' => array('Nulo' => 'Nulo', 'Gris' => 'Gris', 'Azul' => 'Azul', 'Rojo' => 'Rojo'))),
      'nivel_seguridad_6'                 => new sfWidgetFormChoice(array('choices' => array('Nulo' => 'Nulo', 'Gris' => 'Gris', 'Azul' => 'Azul', 'Rojo' => 'Rojo'))),
      'nivel_seguridad_7'                 => new sfWidgetFormChoice(array('choices' => array('Nulo' => 'Nulo', 'Gris' => 'Gris', 'Azul' => 'Azul', 'Rojo' => 'Rojo'))),
      'nivel_seguridad_8'                 => new sfWidgetFormChoice(array('choices' => array('Nulo' => 'Nulo', 'Gris' => 'Gris', 'Azul' => 'Azul', 'Rojo' => 'Rojo'))),
      'nivel_seguridad_9'                 => new sfWidgetFormChoice(array('choices' => array('Nulo' => 'Nulo', 'Gris' => 'Gris', 'Azul' => 'Azul', 'Rojo' => 'Rojo'))),
      'nivel_seguridad_10'                => new sfWidgetFormChoice(array('choices' => array('Nulo' => 'Nulo', 'Gris' => 'Gris', 'Azul' => 'Azul', 'Rojo' => 'Rojo'))),
      'nivel_seguridad_11'                => new sfWidgetFormChoice(array('choices' => array('Nulo' => 'Nulo', 'Gris' => 'Gris', 'Azul' => 'Azul', 'Rojo' => 'Rojo'))),
      'nivel_seguridad_12'                => new sfWidgetFormChoice(array('choices' => array('Nulo' => 'Nulo', 'Gris' => 'Gris', 'Azul' => 'Azul', 'Rojo' => 'Rojo'))),
      'datos_alojamiento'                 => new sfWidgetFormTextarea(),
      'acreditado'                        => new sfWidgetFormInputCheckbox(),
      'idioma_documentacion'              => new sfWidgetFormChoice(array('choices' => array('Español' => 'Español', 'Inglés' => 'Inglés', 'Francés' => 'Francés', 'Italiano' => 'Italiano', 'Portugués' => 'Portugués', 'Polaco' => 'Polaco'))),
      'tickets_comida'                    => new sfWidgetFormInputCheckbox(),
      'acreditacion_entregada'            => new sfWidgetFormInputCheckbox(),
      'created_at'                        => new sfWidgetFormDateTime(),
      'updated_at'                        => new sfWidgetFormDateTime(),
      'turnos_list'                       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Turno')),
    ));

    $this->setValidators(array(
      'id'                                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'deleted_at'                        => new sfValidatorDateTime(array('required' => false)),
      'nombre'                            => new sfValidatorString(array('max_length' => 255)),
      'primer_apellido'                   => new sfValidatorString(array('max_length' => 255)),
      'segundo_apellido'                  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'tipo_documento_identificativo'     => new sfValidatorChoice(array('choices' => array(0 => 'NIF', 1 => 'Pasaporte', 2 => 'NIE', 3 => 'Otro documento'))),
      'numero_documento_identificativo'   => new sfValidatorString(array('max_length' => 255)),
      'sexo'                              => new sfValidatorChoice(array('choices' => array(0 => 'Masculino', 1 => 'Femenino'))),
      'talla'                             => new sfValidatorChoice(array('choices' => array(0 => 'S', 1 => 'M', 2 => 'L', 3 => 'XL', 4 => 'XXL', 5 => 'XXXL'), 'required' => false)),
      'nacionalidad'                      => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'fecha_nacimiento'                  => new sfValidatorDate(),
      'pais'                              => new sfValidatorString(array('max_length' => 2)),
      'provincia_id'                      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Provincia'), 'required' => false)),
      'codigo_postal'                     => new sfValidatorString(array('max_length' => 255)),
      'ciudad'                            => new sfValidatorString(array('max_length' => 255)),
      'tipo_via'                          => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'direccion'                         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'numero_via'                        => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'escalera'                          => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'piso'                              => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'puerta'                            => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'telefono_fijo'                     => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'telefono_movil'                    => new sfValidatorString(array('max_length' => 20)),
      'fax'                               => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'email'                             => new sfValidatorString(array('max_length' => 255)),
      'nivel_estudios'                    => new sfValidatorChoice(array('choices' => array(0 => 'Sin estudios', 1 => 'Estudios básicos', 2 => 'Bachillerato', 3 => 'Formación profesional', 4 => 'Diplomatura o Ingeniería Técnica', 5 => 'Licenciatura o Ingeniería Superior'), 'required' => false)),
      'especialidad'                      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'otros_estudios'                    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nivel_ingles'                      => new sfValidatorChoice(array('choices' => array(0 => 'No', 1 => 'Bajo', 2 => 'Medio', 3 => 'Alto'), 'required' => false)),
      'nivel_frances'                     => new sfValidatorChoice(array('choices' => array(0 => 'No', 1 => 'Bajo', 2 => 'Medio', 3 => 'Alto'), 'required' => false)),
      'nivel_aleman'                      => new sfValidatorChoice(array('choices' => array(0 => 'No', 1 => 'Bajo', 2 => 'Medio', 3 => 'Alto'), 'required' => false)),
      'otro_idioma'                       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nivel_otro_idioma'                 => new sfValidatorChoice(array('choices' => array(0 => 'No', 1 => 'Bajo', 2 => 'Medio', 3 => 'Alto'), 'required' => false)),
      'experiencia_administracion'        => new sfValidatorBoolean(array('required' => false)),
      'experiencia_turismo'               => new sfValidatorBoolean(array('required' => false)),
      'experiencia_informatica'           => new sfValidatorBoolean(array('required' => false)),
      'experiencia_seguridad'             => new sfValidatorBoolean(array('required' => false)),
      'experiencia_educacion'             => new sfValidatorBoolean(array('required' => false)),
      'experiencia_sanitario'             => new sfValidatorBoolean(array('required' => false)),
      'experiencia_traduccion'            => new sfValidatorBoolean(array('required' => false)),
      'experiencia_recursos_humanos'      => new sfValidatorBoolean(array('required' => false)),
      'experiencia_otro'                  => new sfValidatorBoolean(array('required' => false)),
      'experiencia_otro_campo'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'experiencia_voluntario'            => new sfValidatorBoolean(array('required' => false)),
      'experiencia_voluntario_donde'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'experiencia_trato_discapacitados'  => new sfValidatorBoolean(array('required' => false)),
      'carnet_conducir'                   => new sfValidatorBoolean(array('required' => false)),
      'parroquia_id'                      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Parroquia'), 'required' => false)),
      'compromiso_religioso'              => new sfValidatorChoice(array('choices' => array(0 => 'Básico', 1 => 'Laico comprometido', 2 => 'Catequista', 3 => 'Ministro de la comunión'), 'required' => false)),
      'movimiento_id'                     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Movimiento'), 'required' => false)),
      'disponibilidad_dias'               => new sfValidatorChoice(array('choices' => array(0 => 'Fines de semana', 1 => 'De lunes a viernes', 2 => 'Toda la semana'), 'required' => false)),
      'disponibilidad_horas'              => new sfValidatorChoice(array('choices' => array(0 => 'Mañana', 1 => 'Tarde', 2 => 'Indiferente'), 'required' => false)),
      'colaborar_acogida'                 => new sfValidatorBoolean(array('required' => false)),
      'colaborar_viacrucis'               => new sfValidatorBoolean(array('required' => false)),
      'colaborar_vigilia'                 => new sfValidatorBoolean(array('required' => false)),
      'colaborar_despedida'               => new sfValidatorBoolean(array('required' => false)),
      'colaborar_ambientacion'            => new sfValidatorBoolean(array('required' => false)),
      'colaborar_protocolo'               => new sfValidatorBoolean(array('required' => false)),
      'colaborar_ministro_comunion'       => new sfValidatorBoolean(array('required' => false)),
      'autorizacion_boletin'              => new sfValidatorBoolean(array('required' => false)),
      'autorizacion_diocesis'             => new sfValidatorBoolean(array('required' => false)),
      'aceptacion_condiciones'            => new sfValidatorBoolean(),
      'alojamiento'                       => new sfValidatorChoice(array('choices' => array(0 => '', 1 => 'Domicilio personal', 2 => 'IFEMA', 3 => 'Polideportivo', 4 => 'Albergue', 5 => 'Otro domicilio'), 'required' => false)),
      'apto'                              => new sfValidatorBoolean(array('required' => false)),
      'revisado_policia'                  => new sfValidatorBoolean(array('required' => false)),
      'jefe_equipo'                       => new sfValidatorBoolean(array('required' => false)),
      'notas'                             => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'reunion_inicial'                   => new sfValidatorBoolean(array('required' => false)),
      'equipo_id'                         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Equipo'), 'required' => false)),
      'foto'                              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'pagado'                            => new sfValidatorBoolean(array('required' => false)),
      'entrevista_seleccion'              => new sfValidatorBoolean(array('required' => false)),
      'abono_transporte'                  => new sfValidatorChoice(array('choices' => array(0 => 'Primera y segunda semana', 1 => 'Sólo segunda semana'), 'required' => false)),
      'numero_acreditacion'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'registrado'                        => new sfValidatorBoolean(array('required' => false)),
      'documento_identificacion_personal' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'documento_acreditacion'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'documento_compromiso'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'documento_antecedentes_penales'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'documento_autorizacion_paterna'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'medio_transporte'                  => new sfValidatorChoice(array('choices' => array(0 => 'Ninguno', 1 => 'Avión', 2 => 'Tren', 3 => 'Autobús', 4 => 'Coche'), 'required' => false)),
      'fecha_llegada'                     => new sfValidatorDateTime(array('required' => false)),
      'fecha_salida'                      => new sfValidatorDateTime(array('required' => false)),
      'datos_transporte'                  => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'nivel_seguridad_1'                 => new sfValidatorChoice(array('choices' => array(0 => 'Nulo', 1 => 'Gris', 2 => 'Azul', 3 => 'Rojo'), 'required' => false)),
      'nivel_seguridad_2'                 => new sfValidatorChoice(array('choices' => array(0 => 'Nulo', 1 => 'Gris', 2 => 'Azul', 3 => 'Rojo'), 'required' => false)),
      'nivel_seguridad_3'                 => new sfValidatorChoice(array('choices' => array(0 => 'Nulo', 1 => 'Gris', 2 => 'Azul', 3 => 'Rojo'), 'required' => false)),
      'nivel_seguridad_4'                 => new sfValidatorChoice(array('choices' => array(0 => 'Nulo', 1 => 'Gris', 2 => 'Azul', 3 => 'Rojo'), 'required' => false)),
      'nivel_seguridad_5'                 => new sfValidatorChoice(array('choices' => array(0 => 'Nulo', 1 => 'Gris', 2 => 'Azul', 3 => 'Rojo'), 'required' => false)),
      'nivel_seguridad_6'                 => new sfValidatorChoice(array('choices' => array(0 => 'Nulo', 1 => 'Gris', 2 => 'Azul', 3 => 'Rojo'), 'required' => false)),
      'nivel_seguridad_7'                 => new sfValidatorChoice(array('choices' => array(0 => 'Nulo', 1 => 'Gris', 2 => 'Azul', 3 => 'Rojo'), 'required' => false)),
      'nivel_seguridad_8'                 => new sfValidatorChoice(array('choices' => array(0 => 'Nulo', 1 => 'Gris', 2 => 'Azul', 3 => 'Rojo'), 'required' => false)),
      'nivel_seguridad_9'                 => new sfValidatorChoice(array('choices' => array(0 => 'Nulo', 1 => 'Gris', 2 => 'Azul', 3 => 'Rojo'), 'required' => false)),
      'nivel_seguridad_10'                => new sfValidatorChoice(array('choices' => array(0 => 'Nulo', 1 => 'Gris', 2 => 'Azul', 3 => 'Rojo'), 'required' => false)),
      'nivel_seguridad_11'                => new sfValidatorChoice(array('choices' => array(0 => 'Nulo', 1 => 'Gris', 2 => 'Azul', 3 => 'Rojo'), 'required' => false)),
      'nivel_seguridad_12'                => new sfValidatorChoice(array('choices' => array(0 => 'Nulo', 1 => 'Gris', 2 => 'Azul', 3 => 'Rojo'), 'required' => false)),
      'datos_alojamiento'                 => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'acreditado'                        => new sfValidatorBoolean(array('required' => false)),
      'idioma_documentacion'              => new sfValidatorChoice(array('choices' => array(0 => 'Español', 1 => 'Inglés', 2 => 'Francés', 3 => 'Italiano', 4 => 'Portugués', 5 => 'Polaco'), 'required' => false)),
      'tickets_comida'                    => new sfValidatorBoolean(array('required' => false)),
      'acreditacion_entregada'            => new sfValidatorBoolean(array('required' => false)),
      'created_at'                        => new sfValidatorDateTime(),
      'updated_at'                        => new sfValidatorDateTime(),
      'turnos_list'                       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Turno', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('voluntario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Voluntario';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['turnos_list']))
    {
      $this->setDefault('turnos_list', $this->object->Turnos->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveTurnosList($con);

    parent::doSave($con);
  }

  public function saveTurnosList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['turnos_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Turnos->getPrimaryKeys();
    $values = $this->getValue('turnos_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Turnos', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Turnos', array_values($link));
    }
  }

}
