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
    <a href="<?php echo url_for(@homepage) ?>"><div id="logo_logistica"></div></a>
      <div id="menu">
        <?php if ($sf_user->isAuthenticated()): ?>          
        <ul class="menu">
<!--
	  <li><a href="#" class="first"><span>Comunicaciones</span></a>
            <ul>
              <li><?php echo link_to('<span>Listado radio portatiles</span>', 'radioportatil/index') ?></li>
              <li><?php echo link_to('<span>Disponibilidad</span>', 'radioportatil/disponibilidad') ?></li>
              <li><?php echo link_to('<span>Hojas de Firmas</span>', 'radioportatil/firmas') ?></li>
            </ul>
          </li>
-->
<!--
	  <li><a href="#"><span>Tareas</span></a>
            <ul>
              <li><?php echo link_to('<span>Listado tareas</span>', 'tarea/index') ?></li>
            </ul>
          </li>
-->
	  <li><a href="#" class="first"><span>Turnos</span></a>
            <ul>
              <li><?php echo link_to('<span>Listado turnos</span>', 'turno/index') ?></li>
            </ul>
          </li>

	  <li class="last"><a href="#"><span>Sistema</span></a>
            <ul>
              <li> <a href="<?php echo url_for('@sf_guard_signout') ?>"><span>Salir</span></a></li>
            </ul>
          </li>
	</ul>
        <?php endif; ?>
       </div>
  </div>

  <div id="contenido">
    <?php echo $sf_content ?>
  </div>

  <div id="pie">
    <a href="http://apycom.com"></a>
  </div>
  </body>
</html>
