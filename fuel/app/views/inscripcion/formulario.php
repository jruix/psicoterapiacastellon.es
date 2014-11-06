<div class="row">
    <div class="twelve columns">
      <div class="panel">
        <h4>Inscripción Presencial en el Centro:</h4>
        <p><strong>Se requiere concertar cita previa en el teléfono 610 401 481.</strong></p>
        <h4>Inscripción On-Line:</h3>
        <ul>
          <li>Realizar un ingreso o transferencia por el importe de la actividad, especificando nombre completo de quien se inscribe y actividad a la que se matricula, en la siguiente cuenta: Caja Rural 3058 7314 35 2810006664</li>
          <li>Rellenar y enviar el siguiente Formulario de Inscripción.</li>
        </ul>
      </div>
      <div class="row">
        <div class="eight columns">
          <?php if(true === Session::get_flash('correct')): ?>
            <div class="alert-box success">
              El formulario de inscripción se ha enviado correctamente. Nos pondremos en contacto contigo. ¡Muchas gracias!
              <a href="" class="close">&times;</a>
            </div>
          <?php endif; ?>
          <?php if(true === Session::get_flash('incorrect')): ?>
            <div class="alert-box alert">
              ¡Tienes que aceptar la política de protección de datos!
              <a href="" class="close">&times;</a>
            </div>
          <?php endif; ?>
        <?php echo Form::open('inscripcion'); ?>
          <div class="row collapse">
            <div class="two columns"><label class="inline <?php if($err_actividad) echo 'error'; ?>">Actividad</label></div>
            <div class="ten columns">
              <select name="actividad">
                <?php foreach($actividades as $actividad): ?>
                  <option value="<?php echo $actividad['id']; ?>"><?php echo $actividad['title']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="row collapse">
            <div class="two columns"><label class="inline <?php if($err_dni) echo 'error'; ?>">DNI / NIE</label></div>
            <div class="ten columns">
              <input type="text" <?php if($err_dni) echo 'class="error"'; ?> name="dni" value="<?php echo Input::post('dni'); ?>" />
              <?php if($err_dni): ?>
                <small class="error"><?php echo $err_dni; ?></small>
              <?php endif; ?>
            </div>
          </div>
          <div class="row collapse">
            <div class="two columns"><label class="inline <?php if($err_nombre) echo 'error'; ?>">Nombre</label></div>
            <div class="ten columns">
              <input type="text" <?php if($err_nombre) echo 'class="error"'; ?> name="nombre" value="<?php echo Input::post('nombre'); ?>" />
              <?php if($err_nombre): ?>
                <small class="error"><?php echo $err_nombre; ?></small>
              <?php endif; ?>
            </div>
          </div>
          <div class="row collapse">
            <div class="two columns"><label class="inline <?php if($err_apellidos) echo 'error'; ?>">Apellidos</label></div>
            <div class="ten columns">
              <input type="text" <?php if($err_apellidos) echo 'class="error"'; ?> name="apellidos" value="<?php echo Input::post('apellidos'); ?>" />
              <?php if($err_apellidos): ?>
                <small class="error"><?php echo $err_apellidos; ?></small>
              <?php endif; ?>
            </div>
          </div>
          <div class="row collapse">
            <div class="two columns"><label class="inline <?php if($err_telefono) echo 'error'; ?>">Teléfono</label></div>
            <div class="ten columns">
              <input type="text" <?php if($err_telefono) echo 'class="error"'; ?> name="telefono" value="<?php echo Input::post('telefono'); ?>" />
              <?php if($err_telefono): ?>
                <small class="error"><?php echo $err_telefono; ?></small>
              <?php endif; ?>
            </div>
          </div>
          <div class="row collapse">
            <div class="two columns"><label class="inline <?php if($err_email) echo 'error'; ?>">Email</label></div>
            <div class="ten columns">
              <input type="text" <?php if($err_email) echo 'class="error"'; ?> name="email" value="<?php echo Input::post('email'); ?>" />
              <?php if($err_email): ?>
                <small class="error"><?php echo $err_email; ?></small>
              <?php endif; ?>
            </div>
          </div>
          <div class="row collapse">
            <div class="two columns"><label class="inline <?php if($err_fecha) echo 'error'; ?>">Fecha transferencia</label></div>
            <div class="ten columns">
              <input type="text" <?php if($err_fecha) echo 'class="error"'; ?> name="fecha" value="<?php echo Input::post('fecha'); ?>" />
              <?php if($err_fecha): ?>
                <small class="error"><?php echo $err_fecha; ?></small>
              <?php endif; ?>
            </div>
          </div>
          <div class="row collapse">
            <div class="two columns"><label class="inline">Promoción</label></div>
            <div class="ten columns">
              <select name="promocion" id="promotion">
                  <option value="0">Ninguna</option>		  
                  <option value="1" data-show="activities">2 talleres x 40€</option>
                  <option value="2" data-show="persons">2 personas x 40€</option>
                  <option value="3">Actualmente sin empleo</option>
              </select>
            </div>
          </div>
          <div class="row collapse activities show" style="display:none">
            <div class="two columns"><label class="inline">Segunda actividad</label></div>
            <div class="ten columns">
              <select name="actividad_2">
                <?php foreach($actividades as $actividad): ?>
		  <?php if($actividad['title'] != 'Biodanza (sesiones quincenales)'): ?>
                  <option value="<?php echo $actividad['title']; ?>"><?php echo $actividad['title']; ?></option>
		  <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="row collapse persons show" style="display:none">
            <div class="two columns"><label class="inline">Información segunda persona</label></div>
            <div class="ten columns">
		<textarea name="persona_2" placeholder="DNI, nombre, teléfono, email..."></textarea>
            </div>
          </div>
          <div class="row collapse">
            <div class="two columns"></div>
            <div class="ten columns">
              <label for="informacion">
                <input type="checkbox" name="informacion" id="informacion"> Deseo recibir información de nuevas actividades
              </label>
            </div>
          </div>
          <div class="row collapse">
            <div class="two columns"></div>
            <div class="ten columns">
              <label for="politica">
                <input type="checkbox" name="politica" id="politica"> Acepto la política de protección de datos
              </label>
            </div>
          </div>
          <button type="submit" class="radius button right">Enviar</button>
        <?php echo Form::close(); ?>
        <br /><br />
        <blockquote>
          <p>De conformidad con la Ley 15/1999, de 13 de Diciembre, de Protección de Datos de Carácter Personal, le informamos que los datos
          personales reseñados en esta solicitud se adjuntarán a un fichero del que es responsable Manuel Mestre Guardiola y que tiene
          por objeto realizar la incorporación al curso que usted solicita, así como, la adecuada organización y presentación de las distintas
          actividades que van a ser desarrolladas. Igualmente, garantiza la veracidad de los datos personales facilitados y se compromete a
          facilitar cualquier actualización de los mismos.</p>
          <p>Usted tiene reconocido y podrá ejercitar gratuitamente los derechos de acceso, rectificación, cancelación y oposición, enviando un
          escrito acreditando su identidad a: Manuel Mestre Guardiola. Centro de Psicoterapia y Sexología de Castellón. Historiador Escolano, 21
          A Entlo. 12004 Castellón de la Plana.</p>
        </blockquote>
      </div>
      <div class="four columns">
        <p>
          <a href="" data-reveal-id="modalMap"><?php echo Asset::img('contacto/mapa.png'); ?></a><br />
        </p>
      </div>
    </div>
</div>
<div id="modalMap" class="reveal-modal xlarge">
  <h2>¿Dónde estamos?</h2>
  <hr />
  <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.es/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q=Calle+del+Historiador+Escolano,+21+A,+Castell%C3%B3n&amp;aq=&amp;sll=39.892345,-0.041208&amp;sspn=0.00914,0.021136&amp;ie=UTF8&amp;hq=&amp;hnear=Calle+del+Historiador+Escolano,+21,+12004+Castell%C3%B3n,+Comunidad+Valenciana&amp;t=m&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="https://maps.google.es/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q=Calle+del+Historiador+Escolano,+21+A,+Castell%C3%B3n&amp;aq=&amp;sll=39.992345,-0.041208&amp;sspn=0.00914,0.021136&amp;ie=UTF8&amp;hq=&amp;hnear=Calle+del+Historiador+Escolano,+21,+12004+Castell%C3%B3n,+Comunidad+Valenciana&amp;t=m&amp;z=14&amp;iwloc=A" style="color:#0000FF;text-align:left">Ver mapa más grande</a></small>
  <a class="close-reveal-modal">&#215;</a>
</div>
