<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>CPSCS | <?php echo $title; ?></title>
  <?php echo Asset::css('foundation.min.css'); ?>
  <?php echo Asset::css('app.css'); ?>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'>
  <?php echo Asset::js('modernizr.foundation.js'); ?>
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body>
  <!--[if lt IE 8]>
    <div class="row">
      <div class="twelve columns">
        <div class="alert-box alert">
          Lo lamentamos, pero tu versión de navegador no está soportada. Por favor, actualiza a la última versión, o instala un navegador que respete los estándares. Pulsa <a href="http://browsehappy.com/" target="_blank">aquí</a> para más información.
        </div>
      </div>
    </div>
  <![endif]-->
  <div class="row">
    <div class="three columns">
      <h1>
        <a href="<?php echo Uri::base(); ?>">
          <?php echo Asset::img('general/logo.png'); ?>
        </a>
      </h1>
    </div>
    <div class="nine columns">
      <ul class="nav-bar right">
        <li class="<?php echo $centro; ?>"><a href="<?php echo Uri::create('centro'); ?>">El centro</a></li>
        <li class="<?php echo $cursos; ?> has-flyout">
          <a href="<?php echo Uri::create('cursos-y-actividades'); ?>">Cursos y actividades</a>
          <a href="#" class="flyout-toggle"><span> </span></a>
          <ul class="flyout">
            <?php $cursos = (Request::active()->controller == 'Controller_Cursos') ? true : false; ?>
            <li><a <?php echo $cursos ? 'href="#" id="cursos-menu"' : 'href="'.Uri::create('cursos-y-actividades#cursos').'"'; ?>>Cursos</a></li>
            <li><a <?php echo $cursos ? 'href="#" id="actividades-menu"' : 'href="'.Uri::create('cursos-y-actividades#gratuitas').'"'; ?>>Actividades gratuitas</a></li>
            <li><a <?php echo $cursos ? 'href="#" id="psicoterapia-menu"' : 'href="'.Uri::create('cursos-y-actividades#psicoterapia').'"'; ?>>Psicoterapia</a></li>
            <li><a <?php echo $cursos ? 'href="#" id="sexual-menu"' : 'href="'.Uri::create('cursos-y-actividades#educacion').'"'; ?>>Educación sexual</a></li>
          </ul>
        </li>
        <li class="<?php echo $contacto; ?>"><a href="<?php echo Uri::create('contacto'); ?>">Contacto</a></li>
        <li><a target="_blank" href="http://blog.psicoterapiacastellon.es">Blog</a></li>
      </ul>
    </div>
  </div>

  <div class="row">
    <div class="twelve columns">
      <h1><?php echo $title; ?></h1>
      <?php if(isset($subtitle)): ?>
        <h4><?php echo $subtitle; ?></h4>
      <?php endif; ?>
      <hr />
    </div>
  </div>

  <?php echo $content; ?>

  <footer class="row hide-for-small">
    <div class="eleven columns">
      <hr />
      <p class="small">&copy; 2012 Centro de Psicoterapia y Sexología de Castellón - Manuel Mestre Guardiola - 610 401 481 - Email: <a href="mailto:info@psicoterapiacastellon.es">info@psicoterapiacastellon.es</a></p>
    </div> 
  </footer>
  <?php echo Asset::img('general/footer.png',array('id' => 'footer', 'class' => 'hide-for-small')); ?>
  <?php echo Asset::js('foundation.min.js'); ?>
  <?php echo Asset::js('app.js'); ?>
  <ul id="social_side_links" class="hide-for-small">
    <li><a target="_blank" href="http://www.facebook.com/psicocastellon"><?php echo Asset::img('icons/facebook.png'); ?></a></li>
    <li><a target="_blank" href="http://blog.psicoterapiacastellon.es"><?php echo Asset::img('icons/blogger.png'); ?></a></li>
    <li class="last"><a href="<?php echo Uri::create('contacto'); ?>"><?php echo Asset::img('icons/email.png'); ?></a></li>
  </ul>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26471795-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script> 
</body>
</html>
