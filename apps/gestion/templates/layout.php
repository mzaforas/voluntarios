<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div id="cabecera">
      <a href="<?php echo url_for(@homepage) ?>"><div id="logo"></div></a>
      <div id="menu">
        <?php if ($sf_user->isAuthenticated()): ?>          
	<ul class="menu">
	  <li><a href="#" class="first"><span>Voluntarios</span></a>
            <ul>
              <li><?php echo link_to('<span>Listado voluntarios</span>', 'voluntario/index') ?></li>
              <?php if ($sf_user->hasCredential('voluntario_enviar_email')): ?>
	      <li><?php echo link_to('<span>Envío email (con filtros)</span>', 'voluntario/enviarEmail') ?></li>
              <li><?php echo link_to('<span>Generar .txt emails</span>', 'voluntario/exportarEmails') ?></li>
              <?php endif; ?>
              <li><?php echo link_to('<span>Listado equipos</span>', 'equipo/index') ?></li>
              <li><?php echo link_to('<span>Generar .csv equipos</span>', 'equipo/exportarCsv') ?></li>
              <li><?php echo link_to('<span>Listado formación</span>', 'tag/index') ?></li>
              <li><?php echo link_to('<span>Listado parroquias</span>', 'parroquia/index') ?></li>
              <li><?php echo link_to('<span>Listado movimientos</span>', 'movimiento/index') ?></li>
            </ul>
	  </li>
	  <li><a href="#" class="parent"><span>Asignación</span></a>
	   <ul>
              <li><?php echo link_to('<span>Listado tareas</span>', 'tarea/index') ?></li>
              <li><?php echo link_to('<span>Listado eventos</span>', 'evento/index') ?></li>
              <li><?php echo link_to('<span>Listado departamentos</span>', 'departamento/index') ?></li>
              <li><?php echo link_to('<span>Listado lugares</span>', 'lugar/index') ?></li>
              <li><?php echo link_to('<span>Listado perfiles</span>', 'perfil/index') ?></li>
	   </ul>
          </li>
	  <li><a href="#" class="parent"><span>Calendario</span></a>
	   <ul>
	   <li><?php echo link_to('<span>Calendario</span>', 'http://voluntarios.madrid11.com/calendario/month.php', array('popup'=>true)) ?></li>
	   <li><?php echo link_to('<span>Calendario eventos .ics</span>', 'evento/calendario') ?></li>
	   <li><?php echo link_to('<span>Calendario tareas .ics</span>', 'tarea/calendario') ?></li>
	   </ul>
	  </li>
	  <li><a href="#" class="parent"><span>Estadísticas</span></a>
            <ul>
              <li><?php echo link_to('<span>Paises</span>', 'estadistica/pais') ?></li>
              <li><?php echo link_to('<span>Provincias</span>', 'estadistica/provincia') ?></li>
              <li><?php echo link_to('<span>Sexos</span>', 'estadistica/sexo') ?></li>
              <li><?php echo link_to('<span>Tallas</span>', 'estadistica/talla') ?></li>
              <li><?php echo link_to('<span>Movimientos</span>', 'estadistica/movimiento') ?></li>
              <li><?php echo link_to('<span>Diocesis</span>', 'estadistica/diocesis') ?></li>
              <li><?php echo link_to('<span>Parroquias</span>', 'estadistica/parroquia') ?></li>
              <li><?php echo link_to('<span>Edad</span>', 'estadistica/edad') ?></li>
              <li><?php echo link_to('<span>Equipo</span>', 'estadistica/equipo') ?></li>
              <li><?php echo link_to('<span>Pagado</span>', 'estadistica/pagado') ?></li>
              <li><?php echo link_to('<span>Fotos</span>', 'estadistica/foto') ?></li>
              <li><?php echo link_to('<span>Seguridad</span>', 'estadistica/seguridad') ?></li>
              <li><?php echo link_to('<span>Seguridad acreditable</span>', 'estadistica/seguridadAcreditable') ?></li>
              <li><?php echo link_to('<span>Seguridad orden</span>', 'estadistica/seguridadOrden') ?></li>
              <li><?php echo link_to('<span>Registro</span>', 'estadistica/registro') ?></li>
              <li><?php echo link_to('<span>Resumen</span>', 'estadistica/resumen') ?></li>
              <li><?php echo link_to('<span>Informe .csv</span>', 'estadistica/informeCsv') ?></li>
              <li><?php echo link_to('<span>Informe .pdf</span>', 'estadistica/informePdf') ?></li>
            </ul>
	  </li>
          <li><a href="#" class="parent"><span>Ayuda</span></a>
            <ul>
              <li><?php echo link_to('<span>Manual usuario .pdf</span>', url_for('/').'web/uploads/manual.pdf', array('popup'=>true)) ?></li>
              <li><?php echo link_to('<span>Preguntas frecuentes</span>', 'ayuda/preguntasFrecuentes') ?></li>
              <li><?php echo link_to('<span>Contactar</span>', 'ayuda/contactarDesarrolladores') ?></li>
            </ul>
         </li>
	  <li class="last"><a href="#"><span>Sistema</span></a>
          <ul>
            <li> <a href="<?php echo url_for('@sf_guard_signout') ?>"><span>Salir</span></a></li>
            <li><?php echo link_to('<span>Test csv</span>', 'voluntario/testCsv') ?></li>
            <li><?php echo link_to('<span>Csv standard</span>', 'voluntario/exportarCsv') ?></li>
            <?php if ($sf_user->isSuperAdmin()): ?>
            <li><?php echo link_to('<span>Csv equipo</span>', 'equipo/exportarCsv') ?></li>
            <li><?php echo link_to('<span>Csv policía</span>', 'voluntario/exportarCsvPolicia') ?></li>
            <li><?php echo link_to('<span>Csv pago</span>', 'voluntario/exportarCsvPago') ?></li>
            <li><?php echo link_to('<span>Csv acreditación</span>', 'voluntario/exportarCsvAcreditacion') ?></li>
            <li><?php echo link_to('<span>Actualizar pagados</span>', 'voluntario/actualizarPagados') ?></li>
            <li><?php echo link_to('<span>Contactar usuarios</span>', 'ayuda/contactarUsuarios') ?></li>
            <li><?php echo link_to('<span>Usuarios</span>', 'sfGuardUser/index') ?></li>
            <li><?php echo link_to('<span>Grupos</span>', 'sfGuardGroup/index') ?></li>
            <li><?php echo link_to('<span>Permisos</span>', 'sfGuardPermission/index') ?></li>
            <?php endif; ?>
          </ul>
        </li>
	</ul>
      <?php endif; ?>
      </div>
    </div>
  </div>
  <div id="contenido">
   <?php $usersToRedirect = array();//'mzaforas','bortiz','bgonzalez','tbarreda','valcantara','a','mvinas','gdepablo','pbesari','mmarquinez');
   if( $sf_user->isAuthenticated() && in_array($sf_user->getUsername(), $usersToRedirect) ): ?>
     <?php $msg = "<p><font size=5><b>Lo sentimos, pero la aplicación madrid11 ha sido dada de baja</b></font></p><p><font size=3>Debido a los principios e ideas que tenemos en el área de voluntariado, teniendo siempre por referencia a nuestros responsables, hemos considerado que la mejor opción es cerrar la aplicación. En definitiva, todo lo que viene de los ordenadores es \"mentira\". ¡Y no podemos trabajar así!. <i>\"Es por eso por lo que quiebran las empresas\"</i>. No tenemos claro cómo se va a gestionar a partir de ahora toda la información, pero tenemos muy claro que va a ser mucho mejor, más claro y preciso, ¡sin errores!. Eso sí, sin ningún ordenador de por medio. Suponemos por ello que se imprimirán montones de tablas en papel y desde allí se marcarán los pagos, las fotos, se adjuntará la documentación necesaria, etc. pero aún todo está por decidir.</p><p>!Ánimo, que no queda nada! Este cambio nos ayudará a gestionar mejor a los voluntarios.</p><p>Para más información sobre tu forma de trabajo, ponte en contacto con D. José Armada.";
   echo $msg;?>
     <br><br>
     <img goomoji="981" style="margin: 0pt 0.2ex; vertical-align: middle;" src="https://mail.google.com/mail/e/981">
   <img goomoji="983" style="margin: 0pt 0.2ex; vertical-align: middle;" src="https://mail.google.com/mail/e/983">
   <img goomoji="983" style="margin: 0pt 0.2ex; vertical-align: middle;" src="https://mail.google.com/mail/e/983">
   <img goomoji="983" style="margin: 0pt 0.2ex; vertical-align: middle;" src="https://mail.google.com/mail/e/983">
   <img goomoji="983" style="margin: 0pt 0.2ex; vertical-align: middle;" src="https://mail.google.com/mail/e/983">
   <img goomoji="517" style="margin: 0pt 0.2ex; vertical-align: middle;" src="https://mail.google.com/mail/e/517">
   
   <img goomoji="517" style="margin: 0pt 0.2ex; vertical-align: middle;" src="https://mail.google.com/mail/e/517">
    
   <? else : ?>
     <?php echo $sf_content ?>
     <?php endif; ?>
   
  </div>

  <div id="pie">
    <a href="http://apycom.com"></a>
  </div>

  </body>
</html>
