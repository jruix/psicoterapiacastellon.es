<div class="row">
    <div class="eight columns">
      <?php if(true === Session::get_flash('correct')): ?>
        <div class="alert-box success">
          El formulario de contacto se ha enviado correctamente. ¡Muchas gracias!
          <a href="" class="close">&times;</a>
        </div>
      <?php endif; ?>
    <?php echo Form::open('contacto'); ?>
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
        <div class="two columns"><label class="inline <?php if($err_email) echo 'error'; ?>">Email</label></div>
        <div class="ten columns">
          <input type="text" <?php if($err_email) echo 'class="error"'; ?> name="email" value="<?php echo Input::post('email'); ?>" />
          <?php if($err_email): ?>
            <small class="error"><?php echo $err_email; ?></small>
          <?php endif; ?>
        </div>
      </div>
      <div class="row collapse">
        <div class="two columns"><label class="inline <?php if($err_comentarios) echo 'error'; ?>">Comentarios</label></div>
        <div class="ten columns">
          <textarea name="comentarios" <?php if($err_comentarios) echo 'class="error"'; ?>><?php echo Input::post('comentarios'); ?></textarea>
          <?php if($err_comentarios): ?>
            <small class="error"><?php echo $err_comentarios; ?></small>
          <?php endif; ?>
        </div>
      </div>
      <blockquote>
        <p>En cumplimiento de la Ley Orgánica 15/1999, de Protección de Datos de Carácter Personal, se informa a la persona titular de los datos que los mismos van a ser incorporados a un fichero automatizado, titularidad de Manuel Mestre Guardiola autorizando expresamente a éste el tratamiento de dichos datos con el fin de poder atender y resolver las solicitudes de consulta remitidas, así como informarle de otros servicios ofrecidos. Asimismo podrán ser incluidos los datos que se pudieran generar mediante la relación que se establezca o se pudiera establecer.</p>
        <p>Todos los campos son de obligada cumplimentación, en otro caso no podremos atender su consulta. La persona titular de los datos tiene reconocidos los derechos de acceso, rectificación, cancelación y oposición, los cuales podrán ser ejercitados enviando un escrito acreditando su identidad a: Manuel Mestre Guardiola, Historiador Escolano, 21 A Entlo. 12004 Castellón de la Plana. Este fichero ha sido inscrito en el Registro General de la Agencia Española de Protección de Datos.</p>
      </blockquote>
      <button type="submit" class="radius button right">Enviar</button>
    <?php echo Form::close(); ?>
    <br />
    <h1>Datos de contacto</h1>
    <br />
    <ul>
      <li>Dirección: Historiador Escolano, 21 A, entresuelo. 12004 Castellón de la Plana</li>
      <li>Teléfono de contacto: 610 401 481</li>
      <li>Dirección de e-mail: <a href="mailto:info@psicoterapiacastellon.es">info@psicoterapiacastellon.es</a></li>
    </ul>
  </div>
  <div class="four columns">
    <p>
      <a href="" data-reveal-id="modalMap"><?php echo Asset::img('contacto/mapa.png'); ?></a><br />
    </p>
  </div>
</div>
<div id="modalMap" class="reveal-modal xlarge">
  <h2>¿Dónde estamos?</h2>
  <hr />
  <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.es/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q=Calle+del+Historiador+Escolano,+21+A,+Castell%C3%B3n&amp;aq=&amp;sll=39.892345,-0.041208&amp;sspn=0.00914,0.021136&amp;ie=UTF8&amp;hq=&amp;hnear=Calle+del+Historiador+Escolano,+21,+12004+Castell%C3%B3n,+Comunidad+Valenciana&amp;t=m&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="https://maps.google.es/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q=Calle+del+Historiador+Escolano,+21+A,+Castell%C3%B3n&amp;aq=&amp;sll=39.992345,-0.041208&amp;sspn=0.00914,0.021136&amp;ie=UTF8&amp;hq=&amp;hnear=Calle+del+Historiador+Escolano,+21,+12004+Castell%C3%B3n,+Comunidad+Valenciana&amp;t=m&amp;z=14&amp;iwloc=A" style="color:#0000FF;text-align:left">Ver mapa más grande</a></small>
  <a class="close-reveal-modal">&#215;</a>
</div>
