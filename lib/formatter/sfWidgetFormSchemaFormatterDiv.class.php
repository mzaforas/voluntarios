<?php

class sfWidgetFormSchemaFormatterDiv extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat             = "<div class='fila'>\n	%error% %label%\n	%field%%help%%hidden_fields%\n</div>\n\n",
    $rowFormatError        = "<div class='fila fila_error'>\n	%error% %label%\n	%field%%help%%hidden_fields%\n</div>\n\n",
    $helpFormat            = '<br />%help%',
    $requiredTemplate      = '<pow class="requiredFormItem">*</pow>',
    $validatorSchema       = null,
    $errorListFormatInARow = "  <ul class=\"lista_errores\">\n%errors%  </ul>\n";

  public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
  {
    if($errors)
      $row_format=$this->rowFormatError;
    else
      $row_format=$this->rowFormat;

    return strtr($row_format, array(
      '%label%'         => $label,
      '%field%'         => $field,
      '%error%'         => $this->formatErrorsForRow($errors),
      '%help%'          => $this->formatHelp($help),
      '%hidden_fields%' => null === $hiddenFields ? '%hidden_fields%' : $hiddenFields,
    ));
  }
  
  public function generateLabelName($name)
  {
    $label = parent::generateLabelName($name);

    if ($this->validatorSchema)
      {
        $fields = $this->validatorSchema->getFields();
        if(isset($fields[$name]) && $fields[$name] != null) {
          $field = $fields[$name];
          if($field->hasOption('required') && $field->getOption('required')) {
            $label = $this->requiredTemplate.$label;
          }
        }
      }
    return $label;
  }
  
  public function setValidatorSchema(sfValidatorSchema $validatorSchema)
  {
    $this->validatorSchema = $validatorSchema;
  }

}
