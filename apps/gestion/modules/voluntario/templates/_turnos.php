<?php use_helper('Latex','I18N') ?>
\documentclass[a4paper]{article}

\usepackage[activeacute,spanish]{babel}
\usepackage[utf8]{inputenc}
\usepackage{graphicx}
\usepackage[margin=1cm]{geometry}
\usepackage{tabularx}
\usepackage{eurosym}
\usepackage{multirow}
\usepackage{longtable}
\usepackage{lscape}
\usepackage{float}
\usepackage{colortbl}

\begin{document}
\pagestyle{empty}

<?php $si = '\includegraphics[width=3mm]{/home/jmjadmin/web/sfDoctrinePlugin/images/tick.png}' ?>
<?php $no = '\includegraphics[width=3mm]{/home/jmjadmin/web/sfDoctrinePlugin/images/delete.png}' ?>

\begin{center}
\textbf{{\Huge Hoja turnos <?php echo $voluntario ?>}}
\end{center}

\begin{center}
\begin{tabular}{|l|l|l|l|l|l|}
\hline
\textbf{Nombre} & \textbf{Descripción} & \textbf{Lugar} & \textbf{Fecha} & \textbf{Hora comienzo} & \textbf{Hora fin} \\
\hline
\hline
<?php foreach($voluntario->getTurnos() as $turno): ?>
<?php echo $turno->getNombre() ?> &
<?php echo $turno->getDescripcion() ?> &
<?php echo $turno->getLugar() ?> &
<?php echo $turno->getDateTimeObject('fecha')->format('d/m/Y') ?> &
<?php echo $turno->getHoraComienzo() ?> &
<?php echo $turno->getHoraFin() ?> 
\\
<?php endforeach; ?>
\hline
\end{tabular}
\end{center}

\end{document}