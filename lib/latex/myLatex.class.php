<?php

class myLatex
{
  /**
   * Escapa los caracteres LaTeX del string que recibe
   */
  public static function escapeChar($text) 
  {
    return str_replace("_","\_",$text);
  }


  /**
   * Generate PDF
   * @param $response Objeto de la respuesta para fijar que se devolverá un documento pdf
   * @param $fileName Nombre del fichero que se quiere devolver
   * @param $latexCode Código LaTeX que se quiere compilar a pdf
   */
  public static function generatePdf($response, $fileName, $latexCode)
  {
    /* Crear fichero temporal en /tmp para código LaTeX */
    $tempfile = tempnam("/tmp","tex");    
    $fp  = fopen ($tempfile.'.tex',"w");
    if (!$fp)
      {
        die ("Could not open ".$tempfile);
      }
    /* Volcar código LaTeX en fichero */
    fwrite($fp, $latexCode);
    fclose($fp);
    /* Compilar LaTeX a PDF*/
    exec("cd /tmp; pdflatex -output-directory /tmp -interaction nonstopmode $tempfile.tex 2>&1");

    /* Chequear que la compilacion haya ido bien */
    if (file_exists($tempfile.'.log'))
      {
        $log = file_get_contents("$tempfile.log");
        if (strpos($log, 'Fatal error'))
          {
            //unlink($tempfile.'.pdf');
          }
      }

    /* Devolver pdf o error */
    if (file_exists($tempfile.'.pdf'))
      {
        $response->setContentType('application/pdf');
        $response->addHttpMeta('cache-control', 'no-cache');
        $response->addHttpMeta('Expires', gmdate("D, d M Y H:i:s") . " GMT",time());
        $response->setHttpHeader('Content-Disposition', 'attachment; filename="'.$fileName.'.pdf"');                                                                                                         
        $response->setContent(file_get_contents($tempfile.'.pdf'));
      }
    else 
      {
        $msg = '<h1>Ha ocurrido un error al generar su documento pdf:</h1>';
        $msg .= '<h2>Log</h2><pre>'.$log.'</pre>';
        $msg .= '<h2>Tex-Source:</h2><pre>'.file_get_contents("$tempfile.tex").'</pre>';
        echo $msg;
      }
  }

  /**
   * Generate PDF
   * @param $response Objeto de la respuesta para fijar que se devolverá un documento pdf
   * @param $fileName Nombre del fichero que se quiere devolver
   * @param $latexCode Código LaTeX que se quiere compilar a pdf
   */
  public static function mergePdf($response, $fileName, $pdf_1, $pdf_2)
  {
    exec("cd /tmp; pdftk ".$pdf_1." ".$pdf_2." cat output /tmp/".$fileName." 2>&1");
    /* Devolver pdf o error */
    if (file_exists('/tmp/'.$fileName)) {
      $response->setContentType('application/pdf');
      $response->addHttpMeta('cache-control', 'no-cache');
      $response->addHttpMeta('Expires', gmdate("D, d M Y H:i:s") . " GMT",time());
      $response->setHttpHeader('Content-Disposition', 'attachment; filename="'.$fileName);                                                                                                         
      $response->setContent(file_get_contents('/tmp/'.$fileName));
    } else {
      echo '<h1>Ha ocurrido un error al generar su documento pdf</h1>';
    }
  }

  /**
   * Generate PDF
   * @param $response Objeto de la respuesta para fijar que se devolverá un documento pdf
   * @param $fileName Nombre del fichero que se quiere devolver
   * @param $latexCode Código LaTeX que se quiere compilar a pdf
   */
  public static function generateTmpPdf($latexCode)
  {
    /* Crear fichero temporal en /tmp para código LaTeX */
    $tempfile = tempnam("/tmp","tex");    
    $fp  = fopen ($tempfile.'.tex',"w");
    if (!$fp)
      {
        die ("Could not open ".$tempfile);
      }
    /* Volcar código LaTeX en fichero */
    fwrite($fp, $latexCode);
    fclose($fp);
    /* Compilar LaTeX a PDF*/
    exec("cd /tmp; pdflatex -output-directory /tmp -interaction nonstopmode $tempfile.tex 2>&1");

    /* Chequear que la compilacion haya ido bien */
    if (file_exists($tempfile.'.log'))
      {
        $log = file_get_contents("$tempfile.log");
        if (strpos($log, 'Fatal error'))
          {
            //unlink($tempfile.'.pdf');
          }
      }

    /* Devolver pdf o error */
    if (file_exists($tempfile.'.pdf')) {
      return $tempfile.'.pdf';
    }else {
      return -1;
    }
  }

  /**
   * Generate RTF
   * @param $response Objeto de la respuesta para fijar que se devolverá un documento pdf
   * @param $fileName Nombre del fichero que se quiere devolver
   * @param $latexCode Código LaTeX que se quiere compilar a pdf
   */
  public static function generateRtf($response, $fileName, $latexCode)
  {
    /* Crear fichero temporal en /tmp para código LaTeX */
    $tempfile = tempnam("/tmp","tex");    
    $fp  = fopen ($tempfile.'.tex',"w");
    if (!$fp)
      {
        die ("Could not open ".$tempfile);
      }
    /* Volcar código LaTeX en fichero */
    fwrite($fp, $latexCode);
    fclose($fp);
    /* Compilar LaTeX a RTF*/
    exec("cd /tmp; latex2rtf $tempfile.tex 2>&1");

    /* Devolver rtf o error */
    if (file_exists($tempfile.'.rtf'))
      {
        $response->setContentType('application/rtf');
        $response->addHttpMeta('cache-control', 'no-cache');
        $response->addHttpMeta('Expires', gmdate("D, d M Y H:i:s") . " GMT",time());
        $response->setHttpHeader('Content-Disposition', 'attachment; filename="'.$fileName.'.rtf"');                                                                                                         
        $response->setContent(file_get_contents($tempfile.'.rtf'));
      }
    else 
      {
        $msg = '<h1>Ha ocurrido un error al generar su documento rtf:</h1>';
        $msg .= '<h2>Tex-Source:</h2><pre>'.file_get_contents("$tempfile.tex").'</pre>';
        echo $msg;
      }
  }

}
