<?php

class myGrafica
{
  public static function getTarta($valores,$clave,$valor) {
    require_once(sfConfig::get('sf_lib_dir').'/vendor/php-ofc-library/open-flash-chart.php');
    sfConfig::set('sf_web_debug', false);

    /* Tarta */
    $pie = new pie();
    $pie->set_alpha(0.6);
    $pie->set_start_angle(35);
    $pie->add_animation(new pie_fade());
    $pie->set_tooltip('#val# de #total#<br>#percent# de 100%');
    $pie->set_colours(array('#0000ff','#ff0000','80ff00','#ff8000','#ff00ff','#00ffff','#8000ff','#0080ff','#00ff80','#ff0080','#00ff00','#ffff00'));
    $funcion = create_function('$elemento','$value = new pie_value((int)$elemento["'.$clave.'"],$elemento["'.$valor.'"]);return $value;');
    $pie->set_values(array_map($funcion,$valores));
    
    /* Gráfico */
    $chart = new open_flash_chart();
    $chart->add_element( $pie );
    $chart->set_bg_colour('#eeeeee');

    return $chart->toPrettyString();
  }

  public static function getBarras($valores, $etiquetas, $maximo) {
    require_once(sfConfig::get('sf_lib_dir').'/vendor/php-ofc-library/open-flash-chart.php');
    sfConfig::set('sf_web_debug', false);

    $bar = new bar_glass();

    $bar->set_alpha(0.6);
    $bar->set_tooltip('#val# voluntarios'); //'de #x_label# años <br>#top# #bottom#'); // Esto debería ser más informativo, pero no hay maenra ...
    
    $bar->set_values($valores);
    //    $bar->set_on_show(new bar_on_show('grow-up', 0.5, 0)); // Animación de

    /* Gráfico */
    $x = new x_axis();
    $x_labels = new x_axis_labels();
    $x_labels->set_vertical();
    $x_labels->set_labels( $etiquetas );
    $x->set_labels( $x_labels );

    $y = new y_axis(); 
    $y->set_range( 0, 1.05*$maximo, (int)($maximo/40) );

    $chart = new open_flash_chart();
    $chart->add_element( $bar );
    $chart->set_bg_colour('#eeeeee');
    $chart->set_x_axis( $x );
    $chart->set_y_axis( $y );

    return $chart->toPrettyString();
  }

  public static function getMultiBarras($valores, $etiquetas, $maximo) {
    require_once(sfConfig::get('sf_lib_dir').'/vendor/php-ofc-library/open-flash-chart.php');
    sfConfig::set('sf_web_debug', false);

    $data2 = $valores['Gris'];
    $bar2 = new bar();
    $bar2->colour( '#666666' );
    $bar2->key('Gris', 12);
    $bar2->set_values( $data2 );

    $data3 = $valores['Azul'];
    $bar3 = new bar();
    $bar3->colour( '#0000ff' );
    $bar3->key('Azul', 12);
    $bar3->set_values( $data3 );

    $data4 = $valores['Rojo'];
    $bar4 = new bar();
    $bar4->colour( '#ff0000' );
    $bar4->key('Rojo', 12);
    $bar4->set_values( $data4 );

    $chart = new open_flash_chart();
    $chart->add_element( $bar2 );
    $chart->add_element( $bar3 );
    $chart->add_element( $bar4 );

    /* Gráfico */
    $x = new x_axis();
    $x_labels = new x_axis_labels();
    $x_labels->set_vertical();
    $x_labels->set_labels( $etiquetas );
    $x->set_labels( $x_labels );
    
    $y = new y_axis();  
    $y->set_range( 0, $maximo, $maximo/10 ); 
         
    $chart->set_bg_colour('#eeeeee');
    $chart->set_x_axis( $x );
    $chart->set_y_axis( $y );
    
    return $chart->toPrettyString();
  }

}