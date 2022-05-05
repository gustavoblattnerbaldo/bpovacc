<?php

class TicketPriorityController extends \BaseController {

	protected $layout = 'index';
	
	
	/* === C.R.U.D. === */
	public function store()
	{
		$rules = array(
			'value' => 'required'
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);		
		
		if ($validator->passes())
		{
			$priority = TicketPriority::where('user_id', Auth::id())->where('name', Input::get('value'))->first();
			
			if ( ! $priority )
			{
				$store			= new TicketPriority;
				$store->user_id	= Auth::id();
				$store->name	= Input::get('value');
				$store->save();
				
				$language = new Language;
				$language->createLanguageFile(Input::get('value'));
			}
			else
			{
				return $this->loadDataTable(2, false);				
			}
		}
		else
		{
			return $this->loadDataTable(false, $validator->errors());			
		}
		
		return $this->loadDataTable(1, false);
	}
	
	public function update($id)
	{
		$rules = array(
			'priority' => 'required'
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);		
		
		if ($validator->passes())
		{
			$priority = TicketPriority::where('user_id', Auth::id())->where('name', Input::get('priority'))->first();
			
			if ( ! $priority )
			{
				$update			= TicketPriority::where('id', $id)->where('user_id', Auth::id())->first();
				$update->name	= Input::get('priority');
				$update->save();
				
				$language = new Language;
				$language->updateLanguageFile(Input::get('oldValue'), Input::get('priority'));
			}
			else
			{
				return $this->loadDataTable(2, false);					
			}
		}
		else
		{
			return $this->loadDataTable(false, $validator->errors());		
		}
		
		return $this->loadDataTable(1, false);		
	}

	public function destroy($id)
	{
		$delete = TicketPriority::find($id);
		$delete->delete();
		
		$language = new Language;
		$language->deleteFromLanguageFile($delete->name);		
		
		return $this->loadDataTable(1, false);
	}
	/* === END C.R.U.D. === */

	
	/* === PRIVATE ===  */
	private function loadDataTable($alert, $errors)
	{
		$data = array(
			'ticketPriorities'	=> TicketPriority::where('user_id', Auth::id())->orderBy('name', 'asc')->get(),
			'ticketTypes'		=> TicketType::where('user_id', Auth::id())->orderBy('name', 'asc')->get(),
			'ticketStatuses'	=> TicketStatus::where('user_id', Auth::id())->orderBy('name', 'asc')->get()
		);
		
		if ($alert)
		{
			$data['alert'] = $alert;
		}
		
		if ($errors)
		{
			$data['errors'] = $errors;
		}
		
		return View::make('admin.settings.tickets', $data);			
	}	
	/* === END PRIVATE ===  */	
}