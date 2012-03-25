<?php use_helper('Latex') ?>
\documentclass[a4paper]{article}

\usepackage[activeacute,spanish]{babel}
\usepackage[utf8]{inputenc}
\usepackage{graphicx}
\usepackage[margin=0.5cm]{geometry}
\usepackage{tabularx}
\usepackage{eurosym}
\usepackage{multirow}
\usepackage{longtable}

\begin{document}
\pagestyle{empty}

\begin{center}
\textbf{{\huge Informe estadístico voluntarios}}
\end{center}

\section{Voluntarios por país}

\begin{longtable}[l]{|p{200pt}|p{100pt}|}
\hline
\textbf{País} & \textbf{Voluntarios} \\
\hline
<?php
$total_paises = 0;
foreach($paises as $pais) {
  $pais_cantidad = $pais['voluntarios'];
  $total_paises += $pais_cantidad;
  echo $pais['pais']."&".$pais_cantidad."\\\ \n";
}
echo "\\hline \n";
echo "\\textbf{Total} & \\textbf{".$total_paises."} \\\ \n";
echo "\\hline \n";
?>
\end{longtable}

\section{Voluntarios por provincia}

\begin{tabular}{|l|l|l|l|l|}
\hline
\textbf{Provincia} & \textbf{Total Voluntarios} & \textbf{Voluntarios CIONG} & \textbf{Voluntarios Camino} & \textbf{Resto Voluntarios} \\
\hline
<?php
$total_provincias_total = $total_provincias_ciong = $total_provincias_camino = $total_provincias_resto = 0;
foreach($provincias as $provincia => $total_voluntarios) {
  $provincia_cantidad_total = $total_voluntarios['voluntarios'];
  $total_provincias_total += $provincia_cantidad_total;
  if (isset($provincias_ciong[$provincia])) {
    $provincia_cantidad_ciong = $provincias_ciong[$provincia]['voluntarios'];
  } else {
    $provincia_cantidad_ciong = 0;
  }
  $total_provincias_ciong += $provincia_cantidad_ciong;
  if (isset($provincias_camino[$provincia])) {
    $provincia_cantidad_camino = $provincias_camino[$provincia]['voluntarios'];
  } else {
    $provincia_cantidad_camino = 0;
  }
  $total_provincias_camino += $provincia_cantidad_camino;
  $provincia_cantidad_resto = $provincia_cantidad_total - ($provincia_cantidad_ciong + $provincia_cantidad_camino);
  $total_provincias_resto += $provincia_cantidad_resto;
  echo $total_voluntarios['nombre']." & ".$provincia_cantidad_total." & ".$provincia_cantidad_ciong." & ".$provincia_cantidad_camino." & ".$provincia_cantidad_resto." \\\ \n";
}
echo "\\hline \n";
echo "\\textbf{Total} & \\textbf{".$total_provincias_total."} & \\textbf{".$total_provincias_ciong."} & \\textbf{".$total_provincias_camino."} & \\textbf{".$total_provincias_resto."} \\\ \n";
echo "\\hline \n";
?>
\end{tabular}

\newpage

\section{Voluntarios por edades}

\begin{tabular}{|l|l|l|l|}
\hline
\textbf{Edad} & \textbf{Mundo} & \textbf{España} & \textbf{Madrid (aplicación voluntarios)} \\
\hline
<?php
$total_mundo = $total_españa = $total_madrid = 0;

for ($i=0; $i<12; $i++) {
  $cantidad_mundo = $edades_mundo[$i]['cantidad'];
  $total_mundo += $cantidad_mundo;
  $cantidad_españa = $edades_españa[$i]['cantidad'];
  $total_españa += $cantidad_españa;
  $cantidad_madrid = $edades_madrid[$i]['cantidad'];
  $total_madrid += $cantidad_madrid;
  echo $edades_mundo[$i]['grupo_edad'].'&'.$cantidad_mundo.'&'.$cantidad_españa.'&'.$cantidad_madrid."\\\ \n";
}
echo "\\hline \n";
echo "\\textbf{Total} & \\textbf{".$total_mundo."} & \\textbf{".$total_españa."} & \\textbf{".$total_madrid."} \\\ \n";
echo "\\hline \n";
?>
\end{tabular}


\section{Voluntarios Madrid por idiomas}

\begin{tabular}{|l|l|l|l|l|}
\hline
\textbf{Provincia Madrid (aplicación voluntarios)} & \textbf{Alto} & \textbf{Medio} & \textbf{Bajo} & \textbf{No} \\
\hline
<?php
echo "\\textbf{Inglés} & ".$ingles['Alto'].'&'.$ingles['Medio'].'&'.$ingles['Bajo'].'&'.$ingles['No']."\\\ \n";
echo "\\textbf{Francés} & ".$frances['Alto'].'&'.$frances['Medio'].'&'.$frances['Bajo'].'&'.$frances['No']."\\\ \n";
echo "\\textbf{Alemán} & ".$aleman['Alto'].'&'.$aleman['Medio'].'&'.$aleman['Bajo'].'&'.$aleman['No']."\\\ \n";
?>
\hline
\end{tabular}


\end{document}
