<?php

class DepartmentController extends \BaseController {

	protected $layout = 'admin.index';
	
	
	/* === VIEW === */
	public function index()
	{
		$data = array(
			'departments' => Department::all()
		);
	
		if (Request::ajax())
		{
			return $this->loadDataTable();
		}
		else
		{
			$this->layout->content = View::make('admin.departments.index', $data);
		}		
	}

	public function create()
	{
		return View::make('admin.departments.create');
	}

	public function show($id)
	{

	}	
	
	public function edit($id)
	{
		$data = array(
			'department' => Department::find($id)
		);
		
		return View::make('admin.departments.edit', $data);
	}
	/* === END VIEW === */
	
	
	/* === C.R.U.D. === */
	public function store()
	{
		$rules = array(
			'name' => 'required|unique:departments',
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);	
		
		if ($validator->passes())
		{
			$store			= new Department;
			$store->name	= Input::get('name');
			$store->save();	
			
			$language = new Language;
			$language->createLanguageFile(Input::get('name'));	
		}
		else
		{
			$data = array(
				'errors'	=> $validator->errors(),
				'inputs'	=> Input::all()
			);
			
			return View::make('admin.departments.create', $data);
		}
			
		return $this->loadDataTable();	
	}
	
	public function update($id)
	{
		$rules = array(
			'name'	=> 'required|unique:departments',
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);	
		
		if ($validator->passes())
		{
			$update				= Department::find($id);
			$update->name		= Input::get('name');
			$update->save();
			
			$language = new Language;
			$language->updateLanguageFile(Input::get('oldValue'), Input::get('name'));				
		}
		else
		{
			$data = array(
				'department'	=> Department::find($id),
				'errors' 		=> $validator->errors(),
				'inputs'		=> Input::all()
			);
			
			return View::make('admin.departments.edit', $data);
		}
			
		return $this->loadDataTable();
	}

	public function destroy($id)
	{
		$delete = Department::find($id);
		$delete->delete();
		
		$language = new Language;
		$language->deleteFromLanguageFile($delete->name);		
		
		return $this->loadDataTable();
	}
	/* === END C.R.U.D. === */

	
	/* === PRIVATE === */
	private function loadDataTable()
	{
		$data = array(
			'departments' => Department::all(),
			'alert'		=> 1
		);

		return View::make('admin.departments.table', $data);		
	}
	/* === END PRIVATE === */
}