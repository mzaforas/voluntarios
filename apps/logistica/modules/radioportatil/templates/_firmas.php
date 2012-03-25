<?php use_helper('Latex','I18N') ?>
\documentclass[a4paper]{article}

\usepackage[activeacute,spanish]{babel}
\usepackage[utf8]{inputenc}
\usepackage{graphicx}
\usepackage[margin=0.5cm]{geometry}
\usepackage{tabularx}
\usepackage{eurosym}
\usepackage{multirow}
\usepackage{longtable}
\usepackage{lscape}
\usepackage{float}

\begin{document}
\pagestyle{empty}

\begin{center}
\textbf{{\huge Hoja de firmas de <?php echo $evento ?>}}
\end{center}

\begin{longtable}{|p{3cm}|p{3.5cm}|p{2cm}|p{3cm}|p{3cm}|p{3cm}|}
\hline
\textbf{Tarea} & \textbf{Responsable} & \textbf{DNI} & \textbf{Radio portátil} & \textbf{Firma entrega} & \textbf{Firma devolución} \\
\hline
<?php foreach($tareas as $tarea): ?>
\hline
<?php foreach($tarea->getTareaRadioportatiles() as $trp): ?>
<?php echo $trp->getTareaId().'. '.$trp->getTarea() ?> & 
<?php echo $trp->getVoluntario()->getNombreCompleto() ?> &
<?php echo $trp->getVoluntario()->getNumeroDocumentoIdentificativo() ?> &
<?php echo $trp->getRadioportatil() ?> &
 &
\\
\hline
<?php endforeach; ?>

<?php endforeach; ?>
\end{longtable}


\end{document}