<?php

class SettingController extends \BaseController {

	protected $layout = 'users.index';
	
	
	/* === VIEW === */
	public function index()
	{
		$language = new Language;
		
		if ( ! $this->userIsClient )
		{
			$data = array(
				'languages'			=> Language::all(),
				'defaultLanguage'	=> $language->defaultLanguage()
			);			
		}
		
		if ( $this->userIsClient )
		{
			$data = array(
				'client'			=> User::find(Auth::id()),
				'languages'			=> Language::all(),
				'defaultLanguage'	=> $language->defaultLanguage()
			);			
		}

		$this->layout->content = View::make('users.settings.index', $data);
	}
	/* === END VIEW === */

}