<?php

class Controller_Centro extends Controller_Common
{
	public function action_index()
	{
		$this->enable_cache();

		$this->template->title = 'El centro';
		$this->template->content = View::forge('general/centro');
	}

	public function after($response)
	{
		$response = parent::after($response);
		$this->template->centro = 'active';
		return $response;
	}
}
