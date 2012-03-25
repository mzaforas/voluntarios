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
\textbf{{\huge A. Hoja de recogida de material}}\\
\textbf{Equipment collection sheet}
\end{center}

\section*{Datos personales / Personal data}

<?php echo $voluntario->getFoto() ? '\includegraphics[width=2cm]{/home/jmjadmin/web/uploads/fotos/'.$voluntario->getFoto().'}' : '\includegraphics[width=2cm]{/home/jmjadmin/web/uploads/fotos/generica.png}'; ?> 
\newline

\begin{tabular}{|l|l|}
\hline
\textbf{Nombre y apellidos / First and last name} & <?php echo $voluntario ?> \\
\hline
\textbf{Fecha nacimiento / Date of birth (Day/Month/Year)} & <?php echo $voluntario->getDateTimeObject('fecha_nacimiento')->format('d/m/Y') ?> \\
\hline
\textbf{<?php echo $voluntario->getTipoDocumentoIdentificativo() ?> / Id number} & <?php echo $voluntario->getNumeroDocumentoIdentificativo() ?> \\
\hline
\textbf{Teléfono móvil / Mobile number} & <?php echo $voluntario->getTelefonoMovil() ?> \\
\hline
\textbf{Ubicación / Location} & <?php echo $voluntario->getCiudad().', '.$voluntario->getProvincia().' ('.format_country($voluntario->getPais()).')' ?> \\
\hline
\end{tabular}

\section*{Artículos a recoger / Items being received}

\begin{tabular}{|l|l|l|}
\hline
\textbf{Artículo / Item} & \textbf{Cantidad / Quantity} & \textbf{Check} \\
\hline
\hline
<?php
if($voluntario->getEquipo()->tienePerfil(8)) {
  $num_polos = '0';
} elseif ($voluntario->getPais() == 'ES') {
  $num_polos = '2';
} else {
  $num_polos = '2';
}
 ?>
Polo (talla / size <?php echo $voluntario->getTalla() ?>) & <?php echo $num_polos ?> & \\
\hline
Mochila / Backpack & 1 & \\
\hline
Youcat / Cathechism (<?php echo $voluntario->getIdiomaDocumentacion()?>) & 1 & \\
\hline
Guía peregrino / Pilgrim guide (<?php echo $voluntario->getIdiomaDocumentacion()?>) & 1 & \\
\hline
Magnificat (<?php echo $voluntario->getIdiomaDocumentacion()?>) & 1 & \\
\hline
Evangelio / Gospel (<?php echo $voluntario->getIdiomaDocumentacion()?>) & 1 & \\
\hline
Guía actos culturales / Cultural events guide (<?php echo $voluntario->getIdiomaDocumentacion()?>) & 1 & \\
\hline
Plano transporte / Transportation map & 1 & \\
\hline
Callejero Madrid / Map of Madrid & 1 & \\
\hline
Rosario / Rosary & 1 & \\
\hline
\end{tabular}

\section*{Sello y firma / Seal and signature}

\begin{tabular}{ll}
\fbox{
  \parbox{6 cm}{
    \vspace{3cm}
    Sello / Seal
  }
}
&
\fbox{
  \parbox{8 cm}{
    \vspace{3cm}
    Firma voluntario / Signature of the volunteer
  }
}
\end{tabular}

\newpage

<?php if(!$voluntario->getEquipo()->tienePerfil(8)): ?>

\begin{center}
\textbf{{\huge B. Hoja de registro}} \\
\textbf{Registration sheet}
\end{center}

\section*{Datos personales / Personal data}
<?php echo $voluntario->getFoto() ? '\includegraphics[width=2cm]{/home/jmjadmin/web/uploads/fotos/'.$voluntario->getFoto().'}' : '\includegraphics[width=2cm]{/home/jmjadmin/web/uploads/fotos/generica.png}'; ?>
\newline

\begin{tabular}{|l|l|}
\hline
\textbf{Nombre y apellidos / First and last name } & <?php echo $voluntario ?> \\
\hline
\textbf{Fecha nacimiento / Date of birth (Day/Month/Year)} & <?php echo $voluntario->getDateTimeObject('fecha_nacimiento')->format('d/m/Y') ?> \\
\hline
\textbf{<?php echo $voluntario->getTipoDocumentoIdentificativo() ?> / Id number} & <?php echo $voluntario->getNumeroDocumentoIdentificativo() ?> \\
\hline
\textbf{Teléfono móvil / Mobile number} & <?php echo $voluntario->getTelefonoMovil() ?> \\
\hline
\textbf{Email} & <?php echo $voluntario->getEmail() ?> \\
\hline
\textbf{Ubicación / Location} & <?php echo $voluntario->getCiudad().', '.$voluntario->getProvincia().' ('.format_country($voluntario->getPais()).')' ?> \\
\hline
\textbf{Nacionalidad / Nacionality} & <?php echo $voluntario->getNacionalidad() ?> \\
\hline
\textbf{Movimiento / Movement} & <?php echo $voluntario->getMovimientoId() ? $voluntario->getMovimiento() : ''?> \\
\hline
\end{tabular}

\section*{Material sensible / Sensitive items}
\renewcommand{\arraystretch}{3}
\begin{tabular}{|l|l|}
\hline
\textbf{{\Large Abonos transporte}} &
\textbf{\Large <?php echo ($voluntario->getAlojamiento()=='IFEMA' and $voluntario->getPais()!='ES' and $voluntario->getEquipoId()!=190) ? '2' : '1' ; ?>} \\
\hline
\hline
\textbf{{\Large Tickets manutención}} (semana 8 al 14 de agosto) &
\textbf{\Large <?php echo ($voluntario->getAlojamiento()=='IFEMA' and $voluntario->getPais()!= 'ES' and $voluntario->getEquipoId()!=190) ? 'SÍ' : 'NO'  ?>} \\
\hline
\hline
\textbf{{\Large Pulsera acceso IFEMA}} &
\textbf{\Large <?php echo ($voluntario->getAlojamiento() == 'IFEMA' and $voluntario->getEquipoId()!=190) ? 'SÍ' : 'NO'; ?>} \\
\hline
\end{tabular}

\renewcommand{\arraystretch}{1}

\section*{Compromiso / Contract}
\par [\textbf{Español}] Me comprometo a respetar las normas de este alojamiento y de la tarea de voluntarios, incluyendo a título indicativo no limitativo tareas y horarios. Soy consciente de que de no cumplirlos perderé mi estatus de voluntario y con ello el derecho a alojamiento, manutención y acceso a los actos en calidad de voluntario.
\newline

\par [\textbf{English}] I promise to respect the rules of this accommodation and to do the work asked of me as a volunteer, including but not limited to a variety of tasks and schedules. I am aware that failure to reach these requirements at any time will result in the loss of my volunteer status, and to the right to partake in my free housing, food, and Volunteer Accreditation Pass to the events provide by the WYD Organization.
\newline

\par [\textbf{Italiano}] Mi comprometto a rispettare le norme di questo alloggio e dei compiti di volontari, compresso in maniera indicativa e non limitata per quanto riguarda compiti e orari. Sono conscente che si loro non vengono  compiuti  perderó mio Status di volontario e con quello il diritto ad alloggio, cibo e acesso agli eventi in qualitá di volontario.
\newline

\par [\textbf{Polski}] Zobowiązuję się do przestrzegania norm, obowiązujących na terenie IFEMA i do wykonywania zadań wolontariusza, włączając w to niograniczoną liczbe zadań i godzin ich wykonywania. Jestem świadomy/a, że nie wypełniając ww zadań utracę status wolontariusza a co za tym idzie prawo do kwaterunku, jedzenia oraz wstępu na wydarzenia przeznaczone dla wolontariuszy.

\section*{Firma voluntario / Signature of the volunteer}
\fbox{
  \parbox{6 cm}{
    \vspace{2cm}
    Firma  / Signature
  }
}

\newpage

<?php endif; ?>

\begin{landscape}

\begin{center}
\textbf{{\huge C. Hoja de información para el voluntario}}\\
\textbf{Information sheet for volunteer}
\end{center}

\section*{Datos personales / Personal data}

\begin{tabular}{|l|l|l|l|l|}
\hline
\textbf{Nombre y apellidos / First and last name} &
\textbf{Fecha nacimiento / Date of birth} & 
\textbf{<?php echo $voluntario->getTipoDocumentoIdentificativo() ?> / Id number} &
\textbf{Teléfono móvil / Mobile} &
\textbf{Email} &
\hline
<?php echo $voluntario ?> &
<?php echo $voluntario->getDateTimeObject('fecha_nacimiento')->format('d/m/Y') ?> &
<?php echo $voluntario->getNumeroDocumentoIdentificativo() ?> &
<?php echo $voluntario->getTelefonoMovil() ?> &
<?php echo $voluntario->getEmail() ?> \\
\hline
\end{tabular}

\section*{Datos de la organización / Organization information}
\begin{tabular}{|l|l|l|}
\hline
\textbf{Equipo al que pertenece / Team} & \textbf{¿Es jefe de equipo de su equipo? / Is supervisor?} & \textbf{Su jefe es / Supervisor} \\
\hline
<?php echo $voluntario->getEquipoId() ? $voluntario->getEquipo()->getNombreCompleto() : 'No asignado / Not assigned' ?> &
<?php echo $voluntario->getJefeEquipo() ? 'Sí / Yes' : 'No' ?> &
<?php echo $voluntario->getEquipo()->getJefe() ? $voluntario->getEquipo()->getJefe().' ('.$voluntario->getEquipo()->getJefe()->getTelefonoMovil().')' : ''?> \\
\hline
\end{tabular}

\section*{Tareas asignadas al <?php echo $voluntario->getEquipo() ?> / Work assigned to team <?php echo $voluntario->getEquipo()->getId() ?>
\\{\footnotesize Esta información es orientativa y puede cambiar, contacte con su jefe de equipo / This is a guidance information and can be modified, contact with your supervisor }
}

\newline
\begin{tabular}{|p{1cm}|p{3cm}|p{3cm}|p{3cm}|p{3cm}|p{4cm}|p{3cm}|p{3cm}|}
\hline
\textbf{Id} & \textbf{Nombre / Name} & \textbf{Fecha / Date} & \textbf{Franja horaria / Time slot} & \textbf{Lugar / Place} & \textbf{Descripción / Notes} & \textbf{Evento / Event} & \textbf{Responsable / Supervisor} \\
\hline
\hline
<?php foreach ($tareas as $tarea): ?>
<?php echo $tarea->get('id').' & '.$tarea->get('nombre').' & '.date('d/m/Y',strtotime($tarea->get('fecha'))).' & '.$tarea->get('franja_horaria').' & '.$tarea['Lugar']['nombre'].' & '.escapar($tarea->get('descripcion')).' & '.$tarea['Evento']['nombre'].' & '.$tarea['Voluntario']['nombre']." \\\ \n"  ?>
\hline
<?php endforeach; ?>
\end{tabular}

\section*{Calendario de tareas asignadas al <?php echo $voluntario->getEquipo() ?> / Calendar of assigned tasks to team <?php echo $voluntario->getEquipo()->getId() ?>}
\renewcommand{\arraystretch}{3}
<?php $tareas_raw = $tareas->getRawValue();?>
\begin{tabular}{|p{1.7cm}||p{3.2cm}|p{3.2cm}|p{3.2cm}|p{3.2cm}|p{3.2cm}|p{3.2cm}|p{3.2cm}|}
\hline
& \textbf{Lunes 15 \newline Monday} & \textbf{Martes 16 \newline Tuesday} & \textbf{Miércoles 17 \newline Wednesday} & \textbf{Jueves 18 \newline Thursday} & \textbf{Viernes 19 \newline Friday} & \textbf{Sábado 20 \newline Saturday} & \textbf{Domingo 21 \newline Sunday} \\
\hline
\hline

\textbf{Mañana \newline Morning}
  <?php for($d=15;$d<=21;$d++): ?>
    <?php $dia = '2011-08-'.$d; ?>
    &
    <?php if (array_key_exists($dia, $tareas_raw) and ($tareas_raw[$dia]['franja_horaria'] == 'Mañana' or $tareas_raw[$dia]['franja_horaria'] == 'Mañana y Tarde')): ?>
    \cellcolor{red}{\footnotesize <?php echo $tareas_raw[$dia]['id'].'. '.$tareas_raw[$dia]['nombre']; ?>}
    <?php endif; ?>
  <?php endfor; ?>
\\
\hline

\textbf{Tarde \newline Afternoon}
  <?php for($d=15;$d<=21;$d++): ?>
    <?php $dia = '2011-08-'.$d; ?>
    &
    <?php if (array_key_exists($dia, $tareas_raw) and ($tareas_raw[$dia]['franja_horaria'] == 'Tarde' or $tareas_raw[$dia]['franja_horaria'] == 'Mañana y Tarde')): ?>
    \cellcolor{red}{\footnotesize <?php echo $tareas_raw[$dia]['id'].'. '.$tareas_raw[$dia]['nombre']; ?>}
    <?php endif; ?>
  <?php endfor; ?>
\\
\hline

\textbf{Noche \newline Night}
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

<?php if ($voluntario->getJefeEquipo()): ?>
\begin{landscape}

\begin{center}
\textbf{{\huge D. Hoja de información para el jefe de equipo}}\\
\textbf{Information sheet for team manager}
\end{center}

\section*{Miembros del equipo <?php echo $voluntario->getEquipo() ?> / Team members}
Usted es responsable de las siguientes personas / You are responsible of the next people:
\newline

\begin{tabular}{|l|l|l|l|l|l|}
\hline
& \textbf{Nombre y apellidos / Name} & \textbf{Identificación / Id} & \textbf{Fecha nacimiento / Birth} & \textbf{Teléfono móvil / Phone} & \textbf{Email} \\
\hline
\hline
<?php $i=1; ?>
<?php foreach($voluntario->getEquipo()->getVoluntarios() as $miembro): ?>
<?php echo $i; $i++;?>&
<?php echo $miembro ?> &
<?php echo $miembro->getTipoDocumentoIdentificativo().': '.$miembro->getNumeroDocumentoIdentificativo() ?> &
<?php echo $miembro->getDateTimeObject('fecha_nacimiento')->format('d/m/Y') ?> &
<?php echo $miembro->getTelefonoMovil() ?> &
<?php echo $miembro->getEmail() ?> 
\\
\hline
<?php endforeach; ?>
\end{tabular}

\end{landscape}
<?php endif; ?>

\end{document}