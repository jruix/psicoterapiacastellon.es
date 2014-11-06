<?php

class Controller_Contacto extends Controller_Common
{
	private $data = array();

	public function action_index()
	{
		$val = Validation::forge();

		$val->add_field('nombre', 'nombre', 'required');
		$val->add_field('email', 'email', 'required|valid_email');
		$val->add_field('comentarios', 'comentarios', 'required|min_length[5]|max_length[500]');

		if($val->run())
		{
			Package::load('email');

			$email = Email::forge();
			$email->from(Config::get('confemail.web_from'), Config::get('confemail.web_name'));
			$email->to(Config::get('confemail.admin_email'), Config::get('confemail.admin_name'));
			$email->subject(Config::get('confemail.subject_contacto'));
			$email->html_body(View::forge('general/email', $this->_create_email()));

			$email->send();

			Session::set_flash('correct',true);
			Response::redirect(Uri::current());

			Session::set_flash('correct',true);
			Response::redirect(Uri::current());
		}

		$this->_results_validation($val);

		$this->template->title = 'Contacto';
		$this->template->content = View::forge('general/contacto', $this->data);
	}

	private function _results_validation($val)
	{
		$this->data['err_nombre'] = $val->error('nombre');
		$this->data['err_email'] = $val->error('email');
		$this->data['err_comentarios'] = $val->error('comentarios');
	}

	private function _create_email()
	{
		$data = array();

		$data['nombre'] = Input::post('nombre');
		$data['email'] = Input::post('email');
		$data['comentarios'] = Input::post('comentarios');

		return $data;
	}

	public function after($response)
	{
		$response = parent::after($response);
		$this->template->contacto = 'active';
		return $response;
	}
}
