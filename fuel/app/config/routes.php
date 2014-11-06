<?php
return array(
	'_root_'  => 'centro/index',
	'_404_'   => 'welcome/404',

	'articulos/porque-terapia-gestalt' => 'articulos/terapiagestalt',
	'articulos/alcanzar-un-suenyo' => 'articulos/alcanzarsuenyo',
	'articulos/entrevista-el-mediterraneo' => 'articulos/entrevistamediterraneo',
	'articulos/donde-queda-la-sexualidad' => 'articulos/dondequedasexualidad',
	'cursos-y-actividades' => 'cursos',
	'curso/(:any)' => 'cursos/curso/$1',

	'inscripcion/(:any)' => 'inscripcion/index/$1'
);