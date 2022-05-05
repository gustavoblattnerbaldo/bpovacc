<?php

class InvitationSettingController extends \BaseController {

	protected $layout = 'index';

	
	/* === C.R.U.D. === */
	public function store()
	{
		$rules = array(
			'title' 	=> 'required',
			'content' 	=> 'required'
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);		
		
		if ($validator->passes())
		{		
			$store			= new InvitationSetting;
			$store->title	= Input::get('title');
			$store->content	= Input::get('content');
			$store->save();	
		}
		else
		{
			$data = array(
				'invitation'	=> InvitationSetting::find(1),
				'errors'		=> $validator->errors(),
				'inputs'		=> Input::all()
			);
			
			return View::make('admin.settings.invitation', $data);				
		}
		
		return $this->loadDataTable();	
	}
	
	public function update($id)
	{
		$rules = array(
			'title' 	=> 'required',
			'content' 	=> 'required'
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);		
		
		if ($validator->passes())
		{		
			$update				= InvitationSetting::find(1);
			$update->title		= Input::get('title');
			$update->content	= Input::get('content');
			$update->save();	
		}
		else
		{
			$data = array(
				'invitation'	=> InvitationSetting::find(1),
				'errors'		=> $validator->errors(),
				'inputs'		=> Input::all()
			);
			
			return View::make('admin.settings.invitation', $data);			
		}
		
		return $this->loadDataTable();	
	}
	/* === END C.R.U.D. === */

	
	/* === PRIVATE === */
	public function loadDataTable()
	{
		$data = array(
			'invitation'	=> InvitationSetting::find(1),
			'alert'			=> 1
		);
		
		return View::make('admin.settings.invitation', $data);			
	}
	/* === END PRIVATE === */
}