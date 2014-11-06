<?php

use \Model\Cursos;

class Controller_Cursos extends Controller_Common
{
	public function before()
	{
		parent::before();
		//$this->enable_cache();
	}

	public function action_index()
	{
		$act_p = Cursos::get(array('gratuito' => 0));
		$act_g = Cursos::get(array('gratuito' => 1));

		$data = array(
			'actividades' => $act_p,
			'gratuitas' => $act_g
		);

		$this->template->title = 'Cursos y actividades';
		$this->template->content = View::forge('cursos/list',$data,false);
	}

	public function action_curso($slug_curso = null)
	{
		if(false === Cursos::exists($slug_curso)) throw new HttpNotFoundException;
		
		$data = array();
		$data['actividad'] = Cursos::getAmpliada($slug_curso);

		$this->template->title = $data['actividad']['title'];
		$this->template->subtitle = $data['actividad']['subtitle'];
		$this->template->content = View::forge('cursos/informacion',$data,false);
	}

	public function after($response)
	{
		$response = parent::after($response);
		$this->template->cursos = 'active';
		return $response;
	}
}
