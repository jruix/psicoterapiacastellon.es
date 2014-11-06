<?php

class Controller_Common extends \Cache\Controller_Template_Cache
{
	public function after($response)
	{
		$response = parent::after($response);
		
		$this->template->centro = '';
		$this->template->cursos = '';
		$this->template->contacto = '';
		$this->template->articulos = '';
		$this->template->terapiagestalt = '';
		$this->template->suenyo = '';
		$this->template->entrevista = '';
		$this->template->sexualidad = '';

        return $response;
	}
}
