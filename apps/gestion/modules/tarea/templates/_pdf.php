<?php use_helper('Latex') ?>
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
\usepackage{colortbl}

\begin{document}
\pagestyle{empty}

<?php $si = '\includegraphics[width=3mm]{/home/jmjadmin/web/sfDoctrinePlugin/images/tick.png}' ?>
<?php $no = '\includegraphics[width=3mm]{/home/jmjadmin/web/sfDoctrinePlugin/images/delete.png}' ?>

\begin{center}
\textbf{{\huge Ficha de la tarea <?php echo $tarea->getId() ?>}}
\end{center}

\section{Datos de la tarea}

\begin{itemize}
\item \textbf{Nombre:} <?php echo $tarea->getNombre() ?>
\item \textbf{Departamento:} <?php echo $tarea->getDepartamento() ?>
\item \textbf{Fecha:} <?php echo $tarea->getDateTimeObject('fecha')->format('d/m/Y') ?>
\item \textbf{Franja horaria:} <?php echo $tarea->getFranjaHoraria() ?>
\item \textbf{Lugar:} <?php echo $tarea->getLugar() ?>
\item \textbf{Descripción:} <?php echo $tarea->getDescripcion() ?>
\item \textbf{Evento:} <?php echo $tarea->getEvento() ?>
\item \textbf{Responsable:} <?php echo $tarea->getVoluntario() ?>
\item \textbf{Perfil:} <?php echo $tarea->getPerfil() ?>
\end{itemize}

\section{Estado de asignación}
\begin{itemize}
\item \textbf{Estado:} <?php echo $tarea->getEstado() ?>
\item \textbf{Número de voluntarios necesarios:} <?php echo $tarea->getVoluntariosNecesarios() ?>
\item \textbf{Número de voluntarios asignados:} <?php echo $tarea->getNumeroVoluntarios() ?>
\item \textbf{Número de equipos asignados:} <?php echo $equipos_asignados->count() ?>
\end{itemize}

\newpage

\begin{landscape}

\section{Equipos asignados}
\begin{tabular}{|l|l|l|l|l|l|}
\hline
\textbf{Equipo} & \textbf{Nombre} & \textbf{Miembros} & \textbf{Perfiles asociados} & \textbf{Tareas} & \textbf{Jefe} \\
\hline
\hline
<?php foreach ($equipos_asignados as $equipo_asignado): ?>
<?php echo $equipo_asignado->getId(); ?>&
<?php echo $equipo_asignado->getNombre(); ?>&
<?php echo $equipo_asignado->getVoluntarios()->count(); ?>&
<?php foreach ($equipo_asignado->getPerfiles() as $perfil) { echo $perfil; } ?> &
<?php echo $equipo_asignado->getTareas()->count(); ?> &
<?php echo $equipo_asignado->getJefe() ? $equipo_asignado->getJefe().' ('.$equipo_asignado->getJefe()->getTelefonoMovil().')' : ''; ?> \\
\hline
<?php endforeach; ?>
\end{tabular}

\end{landscape}

\newpage

% \begin{landscape}
\begin{longtable}{|l|p{6cm}|p{3.5cm}|p{1.1cm}|p{6cm}|}
\hline
& \textbf{Nombre y apellidos} & \textbf{Identificación} & \textbf{Equipo} & \textbf{Jefe de Equipo} \\
\hline
\hline
<?php $i=1; ?>
<?php foreach ($equipos_asignados as $equipo_asignado): ?>
<?php foreach ($equipo_asignado->getVoluntarios() as $voluntario): ?>
<?php echo $i; $i++; ?> &
<?php echo $voluntario; ?> &
<?php echo $voluntario->getTipoDocumentoIdentificativo().": ".$voluntario->getNumeroDocumentoIdentificativo(); ?> &
<?php echo $equipo_asignado->getId(); ?> &
<?php echo $equipo_asignado->getJefe(); ?> \\
\hline
<?php endforeach; ?>
<?php endforeach; ?>
\end{longtable}
%\end{landscape}

\end{document}