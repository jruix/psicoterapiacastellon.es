<div class="row">
	<div class="twelve columns">
		<dl class="tabs pill four-up">
			<dd class="active">
				<a href="#cursos">Cursos</a>
			</dd>
			<dd>
				<a href="#gratuitas" class="hide-for-small">Actividades gratuitas</a>
				<a href="#gratuitas" class="show-for-small">Gratuitas</a>
			</dd>
			<dd>
				<a href="#psicoterapia">Psicoterapia</a>
			</dd>
			<dd>
				<a href="#educacion" class="hide-for-small">Educación sexual</a>
				<a href="#educacion" class="show-for-small">Educación</a>
			</dd>
		</dl>
		<ul class="tabs-content contained">
			<li class="active" id="cursosTab">
				<div class="row">
					<?php $i = 0; ?>
					<?php foreach($actividades as $actividad): ?>
							<div class="six columns">
								<div class="panel">
									<h5><?php echo $actividad['title']; ?></h5>
									<div class="row">
										<div class="twelve columns">
											<?php echo $actividad['content']; ?>
											<br />
											<a href="<?php echo Uri::create('curso/' . $actividad['slug']); ?>" class="round button">M&aacute;s info</a>
											<a href="<?php echo Uri::create('inscripcion'); ?>" class="round button">Inscripción</a>
										</div>
									</div>
								</div>
							</div>
							<?php $i++; ?>
						<?php if($i % 2 == 0): ?>
							<div class="clear"></div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>

				<h3>Información general sobre los talleres</h3>
				<ul>
					<li><strong>Coste:</strong> <strong>25 € por taller</strong> (el ingreso debe hacerse al menos 5 días antes del inicio de la actividad).</li>
					<li><strong>Grupos reducidos:</strong> los talleres se llevarán a cabo con un mínimo de 8 inscripciones y un máximo de 15.</li>
				</ul>
				<br />
				<ul><strong>Promociones:</strong>
					<li><strong>Dos x 40 €:</strong> Inscríbete a dos talleres ó inscribiros dos personas a un mismo taller por sólo 40 €</li>
					<li><strong>Actualmente sin empleo:</strong> 15 € por taller (no compatible con otras promociones. Será necesario acreditarlo).</li>
				</ul>
				<br />
				<p>¡Un fuerte abrazo y hasta pronto!</p>
			</li>
			<li id="gratuitasTab">
				<div class="row">
					<?php $i = 0; ?>
					<?php foreach($gratuitas as $actividad): ?>
						<div class="six columns">
							<div class="panel">
								<h5><?php echo $actividad['title']; ?></h5>
								<div class="row">
									<div class="twelve columns">
										<?php echo $actividad['content']; ?>
									</div>
								</div>
							</div>
						</div>
						<?php if($i % 2 != 0): ?>
							<div class="clear"></div>
						<?php endif; ?>
						<?php $i++; ?>
					<?php endforeach; ?>
				</div>
			</li>
			<li id="psicoterapiaTab">
				<div class="row">
					<div class="twelve columns">
						<?php echo Asset::img('actividades/psicoterapia.jpg',array('class' => 'left mright15')); ?>
						<p>En el <strong>Centro de Psicoterapia y Sexología de Castellón</strong> ofrecemos:</p>
						<ul>
							<li>Psicoterapia Individual</li>
							<li>Psicoterapia de Pareja</li>
							<li>Asesoramiento y Terapia Sexual</li>
						</ul>
						<div class="hide-for-small"><br /><br /><br /></div>
						<h5>Para <strong>solicitar cita</strong>, llame al 610 401 481 o bien remítanos un correo electrónico pinchando <a href="<?php echo Uri::create('contacto'); ?>">aquí</a> y, en breve, nos pondremos en contacto con usted.</h5>
						<h5>Si quiere conocer más acerca de la Terapia Gestáltica, no dude en leer el artículo: Por qué la Terapia Gestalt pinchando <a href="<?php echo Uri::create('articulos/porque-terapia-gestalt'); ?>">aquí</a>.</h5>
					</div>
				</div>
			</li>
			<li id="educacionTab">
				<div class="row">
					<div class="twelve columns">
						<?php echo Asset::img('actividades/educacion_sexual.jpg',array('class' => 'left mright15')); ?>
						<p>Desde el <em>Centro de Psicoterapia y Sexología de Castellón</em> hemos desarrollado proyectos en las siguientes entidades:</p>
						<ul>
							<li>Exmo. Ayuntamiento de Castellón de la Plana. Concejalía de Juventud. Asesoría sobre Afectividad y Sexualidad para Jóvenes.</li>
							<li>Exmo. Ayuntamiento de Benicassim. Casal Jove.</li>
							<li>Proyecto Amigó. Tratamiento de Drogodependencias y Ludopatias. Fundación Amigó. Castellón de la Plana.</li>
						</ul>
						<h5>Elaboramos y desarrollamos programaciones personalizadas y adaptadas a las necesidades de cada centro, asociación o colectivo.</h5>
						<p>Pídenos información a través del Telf: 610 401 481 o remítenos un correo electrónico pinchando <a href="mailto:info@psicoterapiacastellon.es">aquí</a>.</p>
					</div>
				</div>
			</li>
		</ul>
	</div>
</div>
<!--<div class="row">
	<div class="three columns">
		<?php echo Asset::img('actividades/triptico.JPG', array('class' => 'fleft')); ?>
	</div>
	<div class="nine columns">
		<h3>Tríptico</h3>
		<p>Si quieres mantenerte al día de las actividades que se realizan en el <strong>Centro de Psicoterapia y Sexología de Castellón</strong>, descarga el tríptico de actividades aquí: <a href="<?php echo Uri::base(false).'assets/img/actividades/triptico.png' ?>">Tríptico de actividades</a></p>
	</div>
</div>-->
