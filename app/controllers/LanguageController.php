<?php

class LanguageController extends \BaseController {

	protected $layout = 'admin.index';
	
	
	/* === VIEW === */
	public function index()
	{
		$data = array(
			'languages'	=> Language::all(),
		);
		
		if (Request::ajax())
		{
			return $this->loadDataTables();
		}
		else
		{
			$this->layout->content = View::make('admin.languages.index', $data);
		}	
	}

	public function create()
	{
		return View::make('admin.languages.create');
	}

	public function show($id)
	{
		$data = array(
			'original'		=> array_merge(File::getRequire(base_path().'/app/lang/_default/default.php'), File::getRequire(base_path().'/app/lang/_default/dinamic.php')),
			'translated'	=> File::getRequire(base_path().'/app/lang/' . Language::where('id', $id)->first()->short . '/translate.php')
		);
		
		$this->layout->content = View::make('admin.languages.show', $data);
	}
	
	public function edit($id)
	{
		$data = array(
			'language' => Language::where('id', $id)->first()
		);
		
		return View::make('admin.languages.edit', $data);
	}
	/* === END VIEW === */
	
	
	/* === C.R.U.D. === */
	public function store()
	{
		$rules = array(
			'name'			=> 'required',
			'short_name'	=> 'required'
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);		
		
		if ($validator->passes())
		{
			$dir = strtolower(Input::get('short_name'));
			
			if (!File::exists(app_path() . '/lang/' . $dir))
			{
				$store				= new Language;
				$store->name		= Input::get('name');
				$store->short		= $dir;
				$store->save();				
				
				File::copyDirectory(app_path() . '/lang/en', app_path() . '/lang/' . $dir, 0777);
			}
			else
			{
				$data = array(
					'languages'	=> Language::all(),
					'errors' 	=> $validator->errors(),
					'inputs'	=> Input::all(),
					'alert'		=> 2
				);
				
				return View::make('admin.languages.create', $data);
			}
		}
		else
		{
			$data = array(
				'languages'	=> Language::all(),
				'errors' 	=> $validator->errors(),
				'inputs'	=> Input::all(),
				'alert'		=> 3
			);
			
			return View::make('admin.languages..create', $data);
		}
		
		return $this->loadDataTables();
	}
	
	public function update($id)
	{
		$rules = array(
			'name' => 'required'
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);		
		
		if ($validator->passes())
		{	
			$update			= Language::where('id', $id)->first();
			$update->name	= Input::get('name');
			$update->save();
		}
		else
		{
			$data = array(
				'language'	=> Language::where('id', $id)->first(),
				'errors' 	=> $validator->errors(),
				'alert'		=> 3
			);
			
			return View::make('admin.languages..edit', $data);
		}	
		
		return $this->loadDataTables();		
	}

	public function destroy($id)
	{
		$delete = Language::where('id', $id)->first();
		$delete->delete();
		
		File::deleteDirectory(app_path() . '/lang/' . $delete->short);
		
		return $this->loadDataTables();		
	}
	/* === END C.R.U.D. === */
	
	
	/* === PRIVATE === */
	public function loadDataTables()
	{
		$data = array(
			'languages'	=> Language::all(),
			'alert'		=> 1
		);
		
		return View::make('admin.languages.table', $data);		
	}
	/* === END PRIVATE === */
	
	
	/* === OTHERS === */
	public function translate()
	{
		$language = new Language;
		$language->translateLanguage(Input::get('words'), Input::get('languageID'));
		
		return Redirect::to('language')->with('message', trans('translate.data_was_saved'));
	}
	
	public function setDefaultLanguage()
	{
		$rules = array(
			'language' 	=> 'required'
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);		
		
		if ($validator->passes())
		{		
			$update					= User::where('id', Auth::id())->first();
			$update->language_id	= Input::get('language');
			$update->save();	
		}
		else
		{
			$data = array(
				'languages'	=> Language::all(),
				'errors'	=> $validator->errors(),
				'inputs'	=> Input::all()
			);
			
			if (Auth::user()->role_id != 1)
			{
				return View::make('users.settings.language', $data);
			}
			else
			{
				return View::make('admin.settings.language', $data);
			}				
		}
		
		$language = new Language;
		
		$data = array(
			'languages'			=> Language::all(),
			'defaultLanguage'	=> $language->defaultLanguage(),
			'alert'				=> 1
		);		
		
		if (Auth::user()->role_id != 1)
		{
			return View::make('users.settings.language', $data);
		}
		else
		{
			return View::make('admin.settings.language', $data);
		}
	}
	/* === END OTHERS === */

}