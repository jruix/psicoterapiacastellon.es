<div class="row">
	<div class="twelve columns">
		<?php if(!empty($actividad['imagen'])): ?>
			<?php echo Asset::img('actividades/'.$actividad['imagen'],array('class' => 'left mright15')); ?>
		<?php endif; ?>
		<?php echo $actividad['contenido']; ?>
		<br />
		<a href="<?php echo Uri::create('inscripcion'); ?>" class="round button">¡ Quiero inscribirme !</a>
		<br /><br />
	</div>
</div>
