<?php

// this check prevents access to debug front controllers that are deployed by accident to production servers.
// feel free to remove this, extend it or make something more sophisticated.
// if (!in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1')))
// {
//   die('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
// }

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('gestion', 'dev', true);
sfContext::createInstance($configuration)->dispatch();

/* Funciones para facilitar depurado */

/**
 * @return mixed
 * @param mixed $var Variable to export
 * @param string $name Name of the variable
 * @param bool $echo Weather print it, or return it
 * @desc Highlights exported variable
 **/
function printh($var, $name='$var', $echo=TRUE) {
  $str = highlight_string("<?php\n$name = ".var_export($var, 1).";\n?>\n", 1);
  if ($echo) {
    echo $str;
  } else {
    return $str;
  }
}

/**
 * @return none
 * @param mixed $var Variable to export
 * @param string $name Name of the variable
 * @param bool $echo Weather print it, or return it
 * @desc Die Highlighting exported variable
 */
function dieh($var, $name='$var', $echo=TRUE){
  die(stripslashes(printh($var, $name, $echo)));
}
