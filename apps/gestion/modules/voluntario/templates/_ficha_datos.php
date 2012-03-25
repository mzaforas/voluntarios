  <div class="sf_admin_list">
  <?php echo image_tag($foto_path,array('title'=>$voluntario,'class'=>'foto')) ?>
  <?php $icono_doc = '../sf/sf_admin/images/default_icon.png'; ?>
  <?php $icono_si = '../sfDoctrinePlugin/images/tick.png'; ?>
  <?php $icono_no = '../sfDoctrinePlugin/images/delete.png'; ?>

     <?php if ($voluntario->getEquipoId() == 19): ?>
    <h3>Turnos logística de voluntarios</h3>
     Descargar hoja de turnos: <?php echo link_to(image_tag($icono_doc,array('title'=>'Descargar hoja de turnos')),'voluntario/hojaTurnos?id='.$voluntario->getId()) ?>
     <?php endif; ?>

    <h3>Datos registro</h3>
<table>
<tr>
    <th>Registrado</th><td><?php echo $voluntario->getRegistrado() ? image_tag($icono_si,array('title'=>'Ha sido registrado')) : image_tag($icono_no,array('title'=>'No ha sido registrado')) ?></td>
    <th>Idioma documentación</th><td><?php echo $voluntario->getIdiomaDocumentacion() ?></td>
    <th>Tickets comida</th><td><?php echo $voluntario->getTicketsComida() ? image_tag($icono_si,array('title'=>'Se le han dado los tickets de comida')) : image_tag($icono_no,array('title'=>'No se le han dado tickets de comida')) ?></td>
    <th>Acreditación entregada</th><td><?php echo $voluntario->getAcreditacionEntregada() ? image_tag($icono_si,array('title'=>'Entregada')) : image_tag($icono_no,array('title'=>'No entregada')) ?></td>
</tr>
</table>

    <h3>Datos alojamiento</h3>
<table>
<tr>
    <th>Alojamiento</th><td><?php echo $voluntario->getAlojamiento() ?></td>
    <th>Datos alojamiento</th><td><?php echo $voluntario->getDatosAlojamiento() ?></td>
</tr>
</table>

    <h3>Datos personales <?php echo link_to(image_tag("../sfDoctrinePlugin/images/edit.png"),'voluntario/edit?id='.$voluntario->getId(), array('title'=>'Editar datos personales')) ?></h3>
    <table>
    <tr>
    <th>Nombre</th><td> <?php echo $voluntario ?></td>
    <th>Nivel estudios</th><td><?php echo $voluntario->getNivelEstudios() ?></td>
    <th>Experiencia administración</th><td><?php echo $voluntario->getExperienciaAdministracion() ? image_tag($icono_si,array('title'=>'Sí experiencia administración')) : image_tag($icono_no,array('title'=>'No experiencia administración')) ?></td>
    </tr>
    <tr>
    <th>Fecha nacimiento</th><td> <?php echo $voluntario->getDateTimeObject('fecha_nacimiento')->format('d/m/Y') ?></td>
    <th>Especialidad</th><td><?php echo $voluntario->getEspecialidad() ?></td>
    <th>Experiencia turismo</th><td><?php echo $voluntario->getExperienciaTurismo() ? image_tag($icono_si,array('title'=>'Sí experiencia turismo')) : image_tag($icono_no,array('title'=>'No experiencia turismo')) ?></td>
    </tr>
    <tr>
    <th><?php echo $voluntario->getTipoDocumentoIdentificativo().'</th><td> '.$voluntario->getNumeroDocumentoIdentificativo() ?></td>
    <th>Otros estudios</th><td><?php echo $voluntario->getOtrosEstudios() ?></td>
    <th>Experiencia informatica</th><td><?php echo $voluntario->getExperienciaInformatica() ? image_tag($icono_si,array('title'=>'Sí experiencia informatica')) : image_tag($icono_no,array('title'=>'No experiencia informatica')) ?></td>
    </tr>
    <tr>
    <th>Teléfono móvil</th><td> <?php echo $voluntario->getTelefonoMovil();?></td>
    <th>Nivel inglés</th><td><?php echo $voluntario->getNivelIngles() ?></td>
    <th>Experiencia seguridad</th><td><?php echo $voluntario->getExperienciaSeguridad() ? image_tag($icono_si,array('title'=>'Sí experiencia seguridad')) : image_tag($icono_no,array('title'=>'No experiencia seguridad')) ?></td>
    </tr>
    <tr>
    <th>Teléfono fijo</th><td> <?php echo $voluntario->getTelefonoFijo();?></td>
    <th>Nivel francés</th><td><?php echo $voluntario->getNivelFrances() ?></td>
    <th>Experiencia educacion</th><td><?php echo $voluntario->getExperienciaEducacion() ? image_tag($icono_si,array('title'=>'Sí experiencia educacion')) : image_tag($icono_no,array('title'=>'No experiencia educacion')) ?></td>
    </tr>
    <tr>
    <th>Email</th><td> <?php echo mail_to($voluntario->getEmail()) ?></td>
    <th>Nivel alemán</th><td><?php echo $voluntario->getNivelAleman() ?></td>
    <th>Experiencia sanitario</th><td><?php echo $voluntario->getExperienciaSanitario() ? image_tag($icono_si,array('title'=>'Sí experiencia sanitario')) : image_tag($icono_no,array('title'=>'No experiencia sanitario')) ?></td>
    </tr>
    <tr>
    <th>Ubicación</th><td><?php echo $voluntario->getCiudad().', '.$voluntario->getProvincia().' ('.format_country($voluntario->getPais()).')' ?></td>
    <th>Otro idioma</th><td><?php echo $voluntario->getOtroIdioma() ?></td>
    <th>Experiencia traduccion</th><td><?php echo $voluntario->getExperienciaTraduccion() ? image_tag($icono_si,array('title'=>'Sí experiencia traduccion')) : image_tag($icono_no,array('title'=>'No experiencia traduccion')) ?></td>
    </tr>
    <tr>
    <th>Parroquia </th><td><?php echo $voluntario->getParroquia() ?></td>
    <th>Nivel otro idioma</th><td><?php echo $voluntario->getNivelOtroIdioma() ?></td>
    <th>Experiencia recursos humanos</th><td><?php echo $voluntario->getExperienciaRecursosHumanos() ? image_tag($icono_si,array('title'=>'Sí experiencia recursos humanos')) : image_tag($icono_no,array('title'=>'No experiencia recursos humanos')) ?></td>
    </tr>
    <tr>
    <th>Movimiento</th><td><?php echo $voluntario->getMovimientoId() ? $voluntario->getMovimiento() : null ?></td>
    <th>Disponibilidad dias</th><td><?php echo $voluntario->getDisponibilidadDias() ?></td>
    <th>Carnet de conducir</th><td><?php echo $voluntario->getCarnetConducir() ? image_tag($icono_si,array('title'=>'Sí carnet de conducir')) : image_tag($icono_no,array('title'=>'No carnet de conducir')) ?></td>
    </tr>
    <tr>
    <th>Compromiso religioso</th><td><?php echo $voluntario->getCompromisoReligioso() ?></td>
    <th>Disponibilidad horas</th><td><?php echo $voluntario->getDisponibilidadHoras() ?></td>
    <th>Otra experiencia</th><td><?php echo $voluntario->getExperienciaOtroCampo() ?></td>
    </tr>
    <tr>
    <th>Nacionalidad</th><td><?php echo format_country($voluntario->getNacionalidad()) ?></td>
    <th>Talla</th><td><?php echo $voluntario->getTalla() ?></td>
    <th></th><td></td>
    </tr>
    </table>

  <h3>Datos gestión</h3>
  <table>
    <tr>
    <th>Reunión inicial</th><td><?php echo $voluntario->getReunionInicial() ? image_tag($icono_si,array('title'=>'Ha asistido a la reunión inicial')) : image_tag($icono_no,array('title'=>'No ha asistido a la reunión inicial')) ?></td>
    <th>Revisado policía</th><td> <?php echo $voluntario->getRevisadoPolicia() ? image_tag($icono_si,array('title'=>'Revisado por la policía')) : image_tag($icono_no,array('title'=>'No revisado por la policía')) ?></td>
    <th>Equipo</th><td> <?php echo $voluntario->getEquipoId() ? link_to($voluntario->getEquipo()->getNombreCompleto(),'equipo/ListFicha?id='.$voluntario->getEquipoId(),array('title'=>'Ficha del '.$voluntario->getEquipo())) : 'No asignado' ?></td>
    <th>Doc. identificación personal</th><td> <?php echo $voluntario->getDocumentoIdentificacionPersonal() ? link_to(image_tag($icono_doc,array('title'=>'Descargar documento')),'voluntario/descargarDocumento?id='.$voluntario->getId().'&tipo=documento_identificacion_personal') : image_tag($icono_no,array('title'=>'No')) ?></td>
    <th>Doc. compromiso</th><td> <?php echo $voluntario->getDocumentoCompromiso() ? link_to(image_tag($icono_doc,array('title'=>'Descargar documento')),'voluntario/descargarDocumento?id='.$voluntario->getId().'&tipo=documento_compromiso') : image_tag($icono_no,array('title'=>'No')) ?></td>
    </tr>
    <tr>
    <th>Entrevista selección</th><td><?php echo $voluntario->getEntrevistaSeleccion() ? image_tag($icono_si,array('title'=>'Ha asistido a la entrevista de selección')) : image_tag($icono_no,array('title'=>'No ha asistido a la entrevista de selección')) ?></td>
    <th>Pagado</th><td> <?php echo $voluntario->getPagado() ? image_tag($icono_si,array('title'=>'Ha pagado')) : image_tag($icono_no,array('title'=>'No ha pagado')) ?></td>
    <th>Jefe de equipo</th><td> <?php echo $voluntario->getJefeEquipo() ? image_tag($icono_si,array('title'=>'Es jefe de equipo')) : image_tag($icono_no,array('title'=>'No es jefe de equipo')) ?></td>
    <th>Doc. autorización paterna</th><td> <?php echo $voluntario->getDocumentoAutorizacionPaterna() ? link_to(image_tag($icono_doc,array('title'=>'Descargar documento')),'voluntario/descargarDocumento?id='.$voluntario->getId().'&tipo=documento_autorizacion_paterna') : image_tag($icono_no,array('title'=>'No')) ?></td>
    <th>Doc. acreditación</th><td> <?php echo $voluntario->getDocumentoAcreditacion() ? link_to(image_tag($icono_doc,array('title'=>'Descargar documento')),'voluntario/descargarDocumento?id='.$voluntario->getId().'&tipo=documento_acreditacion') : image_tag($icono_no,array('title'=>'No')) ?></td>
    </tr>
    <tr><th>Apto</th><td>
    <?php 
      $apto=$voluntario->getApto();
      if (is_null($apto)) {
        echo "Sin definir";    
      } elseif ($apto == 0) {
        echo image_tag($icono_no,array('title'=>'No apto'));
      } elseif ($apto == 1) {
        echo image_tag($icono_si,array('title'=>'Apto'));
      } 
    ?></td>
    <th>Foto</th><td> <?php echo $voluntario->getTieneFoto() ? image_tag($icono_si,array('title'=>'Tiene foto')) : image_tag($icono_no,array('title'=>'No tiene foto')) ?></td>
    <th>Acreditado</th><td> <?php echo $voluntario->getAcreditado() ? image_tag($icono_si,array('title'=>'Acreditado')) : image_tag($icono_no,array('title'=>'No acreditado')) ?></td>
    <th>Doc. antecedentes penales</th><td> <?php echo $voluntario->getDocumentoAntecedentesPenales() ? link_to(image_tag($icono_doc,array('title'=>'Descargar documento')),'voluntario/descargarDocumento?id='.$voluntario->getId().'&tipo=documento_antecedentes_penales') : image_tag($icono_no,array('title'=>'No')) ?></td>
    <th>Notas</th><td><?php echo $voluntario->getNotas(); ?></td>
    </tr>
    </table>

    <h3>Datos transporte</h3>
<table>
<tr>
    <th>Medio de transporte</th><td><?php echo $voluntario->getMedioTransporte() ?></td>
    <th>Fecha de llegada</th><td><?php echo $voluntario->getFechaLlegada() ? $voluntario->getDateTimeObject('fecha_llegada')->format('d/m/Y H:i') : ''?></td>
    <th>Fecha de salida</th><td><?php echo $voluntario->getFechaSalida() ? $voluntario->getDateTimeObject('fecha_salida')->format('d/m/Y H:i') : ''?></td>
    <th>Datos transporte</th><td> <?php echo $voluntario->getDatosTransporte(); ?></td>
</tr>
</table>

    <h3>Datos niveles seguridad</h3>
    <table>
    <tr><th>Código evento</th><th>Nombre evento</th><th>Nivel seguridad</th></tr>
      <?php for($i=1;$i<=12;$i++): ?>
	  <tr>
	  <?php $evento = $i ?>
          <td><?php echo $evento ?></td>
          <td><?php echo $etiquetas_eventos_seguridad->get($evento) ?></td>
          <td>
          <?php $nivel = $voluntario->{'getNivelSeguridad_'.$evento}()  ?>
          <?php
    switch($nivel) {
    case 'Gris':
      echo '<span style="color:grey">Gris</span>';
      break;
    case 'Azul':
      echo '<span style="color:blue">Azul</span>';
      break;
    case 'Rojo':
      echo '<span style="color:red">Rojo</span>';
      break;
    default:
      echo $nivel;
    } ?>
          </td>  
	  </tr>
      <?php endfor; ?>
    </table>

</div>
