<?php

class Controller_Articulos extends Controller_Common
{
	private $actived;

	public function before()
	{
		parent::before();
		$this->enable_cache();
	}

	public function action_terapiagestalt()
	{
		$this->template->title = '¿Por qué la Terapia Gestalt?';
		$this->actived = 'terapiagestalt';
		$this->template->content = View::forge('articulos/terapiagestalt');
	}

	public function action_alcanzarsuenyo()
	{
		$this->template->title = 'Alcanzar un sueño, de lo deseado y lo temido';
		$this->actived = 'suenyo';
		$this->template->content = View::forge('articulos/suenyo');
	}

	public function action_entrevistamediterraneo()
	{
		$this->template->title = 'Entrevista "El Periódico Mediterráneo"';
		$this->actived = 'entrevista';
		$this->template->content = View::forge('articulos/entrevista');
	}

	public function action_dondequedasexualidad()
	{
		$this->template->title = '¿Por qué es necesario atender la sexualidad en un centro de drogodependientes?';
		$this->actived = 'sexualidad';
		$this->template->content = View::forge('articulos/sexualidad');
	}

	public function after($response)
	{
		$response = parent::after($response);
		$this->template->articulos = 'active';
		$this->template->{$this->actived} = 'active';
		return $response;
	}
}
