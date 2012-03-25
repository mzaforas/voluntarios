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
\usepackage{lscape}
\usepackage{colortbl}

\begin{document}
\pagestyle{empty}

<?php $si = '\includegraphics[width=3mm]{/home/jmjadmin/web/sfDoctrinePlugin/images/tick.png}' ?>
<?php $no = '\includegraphics[width=3mm]{/home/jmjadmin/web/sfDoctrinePlugin/images/delete.png}' ?>

\begin{center}
\textbf{{\huge Ficha del <?php echo $equipo ?>}}
\end{center}

\section{Datos del <?php echo $equipo ?>}

\begin{itemize}
\item \textbf{Nombre:} <?php echo $equipo->getNombre() ?>
\item \textbf{Jefe de equipo:} <?php echo $equipo->getJefe() ? $equipo->getJefe().' ('.$equipo->getJefe()->getTelefonoMovil().')' : '' ?>
\item \textbf{Notas:} <?php echo $equipo->getNotas() ?>
\item \textbf{Número de miembros:} <?php echo count($miembros) ?>
\item \textbf{Número de tareas:} <?php echo $equipo->getNumeroTareas() ?>
\end{itemize}

\section{Perfiles asociados al <?php echo $equipo ?>}
\begin{itemize}
<?php foreach ($equipo->getPerfiles() as $perfil): ?>
<?php echo '\item '.$perfil." \n" ?>
<?php endforeach; ?>
\end{itemize}

\section{Miembros del <?php echo $equipo ?>}
\begin{longtable}{|p{7cm}|p{2.5cm}|p{2.5cm}|p{5cm}|}
\hline
\textbf{Nombre y apellidos} & \textbf{Identificación} & \textbf{Teléfono} & \textbf{Email} \\
\hline
\hline
<?php foreach($miembros as $miembro): ?>
<?php echo $miembro->getNombreCompleto() ?> &
<?php echo $miembro->getNumeroDocumentoIdentificativo() ?> &
<?php echo $miembro->getTelefonoMovil() ?> &
<?php echo $miembro->getEmail() ?>
\\
\hline
<?php endforeach; ?>
\hline
\end{longtable}

\newpage

\begin{landscape}
\section{Tareas asignadas al <?php echo $equipo ?>}
\begin{tabular}{|l|l|l|l|l|p{4cm}|l|l|}
\hline
\textbf{Id} & \textbf{Nombre} & \textbf{Fecha} & \textbf{Franja horaria} & \textbf{Lugar} & \textbf{Descripción} & \textbf{Evento} & \textbf{Responsable} \\
\hline
\hline
<?php foreach ($tareas as $tarea): ?>
<?php echo $tarea->get('id').' & '.$tarea->get('nombre').' & '.date('d/m/Y',strtotime($tarea->get('fecha'))).' & '.$tarea->get('franja_horaria').' & '.$tarea['Lugar']['nombre'].' & '.escapar($tarea->get('descripcion')).' & '.$tarea['Evento']['nombre'].' & '.$tarea['Voluntario']['nombre']." \\\ \n"  ?>
\hline
<?php endforeach; ?>
\end{tabular}

\section{Calendario de tareas asignadas al <?php echo $equipo ?>}
\renewcommand{\arraystretch}{3}
<?php $tareas_raw = $tareas->getRawValue();?>
\begin{tabular}{|l||p{3.2cm}|p{3.2cm}|p{3.2cm}|p{3.2cm}|p{3.2cm}|p{3.2cm}|p{3.2cm}|}
\hline
& \textbf{Lunes 15} & \textbf{Martes 16} & \textbf{Miércoles 17} & \textbf{Jueves 18} & \textbf{Viernes 19} & \textbf{Sábado 20} & \textbf{Domingo 21} \\
\hline
\hline

\textbf{Mañana}
  <?php for($d=15;$d<=21;$d++): ?>
    <?php $dia = '2011-08-'.$d; ?>
    &
    <?php if (array_key_exists($dia, $tareas_raw) and ($tareas_raw[$dia]['franja_horaria'] == 'Mañana' or $tareas_raw[$dia]['franja_horaria'] == 'Mañana y Tarde')): ?>
    \cellcolor{red}{\footnotesize <?php echo $tareas_raw[$dia]['id'].'. '.$tareas_raw[$dia]['nombre']; ?>}
    <?php endif; ?>
  <?php endfor; ?>
\\
\hline

\textbf{Tarde}
  <?php for($d=15;$d<=21;$d++): ?>
    <?php $dia = '2011-08-'.$d; ?>
    &
    <?php if (array_key_exists($dia, $tareas_raw) and ($tareas_raw[$dia]['franja_horaria'] == 'Tarde' or $tareas_raw[$dia]['franja_horaria'] == 'Mañana y Tarde')): ?>
    \cellcolor{red}{\footnotesize <?php echo $tareas_raw[$dia]['id'].'. '.$tareas_raw[$dia]['nombre']; ?>}
    <?php endif; ?>
  <?php endfor; ?>
\\
\hline

\textbf{Noche}
  <?php for($d=15;$d<=21;$d++): ?>
    <?php $dia = '2011-08-'.$d; ?>
    &
    <?php if (array_key_exists($dia, $tareas_raw) and ($tareas_raw[$dia]['franja_horaria'] == 'Noche')): ?>
    \cellcolor{red}{\footnotesize <?php echo $tareas_raw[$dia]['id'].'. '.$tareas_raw[$dia]['nombre']; ?>}
    <?php endif; ?>
  <?php endfor; ?>
\\
\hline

\end{tabular}


\end{landscape}

\end{document}