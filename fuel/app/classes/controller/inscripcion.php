<?php

use \Model\Cursos;

class Controller_Inscripcion extends Controller_Common
{
	private $data = array();

	public function action_index()
	{
		$val = Validation::forge();

		$val->add_field('nombre', 'nombre', 'required');
		$val->add_field('actividad', 'actividad', 'required');
		$val->add_field('dni', 'DNI/NIE', 'required|exact_length[9]');
		$val->add_field('apellidos', 'apellidos', 'required');
		$val->add_field('email', 'email', 'required|valid_email');
		$val->add_field('telefono', 'teléfono', 'required|exact_length[9]');
		$val->add_field('fecha', 'fecha de transferencia', 'required');

		if($val->run())
		{
			if(Input::post('politica') !== 'on') Session::set_flash('incorrect',true);
			else
			{
				Package::load('email');

				$email = Email::forge();
				$email->from(Config::get('confemail.web_from'), Config::get('confemail.web_name'));
				$email->to(Config::get('confemail.admin_email'), Config::get('confemail.admin_name'));
				$email->subject(Config::get('confemail.subject_inscripcion'));
				$email->html_body(View::forge('inscripcion/email', $this->_create_email()));

				$email->send();

				Session::set_flash('correct',true);
				Response::redirect(Uri::current());
			}
		}

		$this->data['actividades'] = Cursos::get(array('gratuito' => 0));

		$this->_results_validation($val);

		$this->template->title = 'Inscripción';
		$this->template->content = View::forge('inscripcion/formulario',$this->data,false);
	}

	private function _results_validation($val)
	{
		$this->data['err_nombre'] = $val->error('nombre');
		$this->data['err_actividad'] = $val->error('actividad');
		$this->data['err_dni'] = $val->error('dni');
		$this->data['err_apellidos'] = $val->error('apellidos');
		$this->data['err_telefono'] = $val->error('telefono');
		$this->data['err_email'] = $val->error('email');
		$this->data['err_comentarios'] = $val->error('comentarios');
		$this->data['err_fecha'] = $val->error('fecha');
	}

	private function _create_email()
	{
		$data = array();

		$curso = Cursos::get(array('id' => Input::post('actividad')));

		$data['actividad'] = $curso[0]['title'];
		$data['nombre'] = Input::post('nombre');
		$data['apellidos'] = Input::post('apellidos');
		$data['dni'] = Input::post('dni');
		$data['telefono'] = Input::post('telefono');
		$data['email'] = Input::post('email');
		$data['fecha'] = Input::post('fecha');
		switch(Input::post('promocion')) {
			case 0:
				$data['extra'] = 'No hay promocion';
				break;
			case 1:
				$data['extra'] = '2 Talleres por 40 euros: ' . Input::post('actividad_2');
				break;
			case 2:
				$data['extra'] = '2 personas por 40 euros: ' . Input::post('persona_2');
				break;
			case 3:
				$data['extra'] = 'Actualmente sin empleo';
				break;
		}

		if(Input::post('informacion') === 'on') $data['informacion'] = 'Sí';
		else $data['informacion'] = 'No';

		return $data;
	}
}
