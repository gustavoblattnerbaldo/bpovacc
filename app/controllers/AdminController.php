<?php

class AdminController extends \BaseController {

	protected $layout = 'admin.index';
	
	
	/* === VIEW === */
	public function index()
	{
		$ticket = new Ticket;
		
		$data = array(
			'totalDepartments'	=> Department::count(),
			'totalStaff'		=> User::where('role_id', 2)->count(),
			'totalClients'	 	=> User::where('role_id', 3)->count(),
			'totalTickets' 		=> Ticket::count(),
			'tickets' 			=> $ticket->getAll(),
			'invitation'		=> InvitationSetting::find(1),
			'ticketPriority'	=> TicketPriority::count(),
			'ticketType'		=> TicketType::count(),
			'ticketStatus'		=> TicketStatus::count(),
			'owner'				=> Setting::find(1)->name,
			'receive_emails'	=> Setting::find(1)->receive_emails
		);
		
		$report = new Report;
		
		View::share('label1', 			$report->showDays());
		View::share('reportClients', 	$report->showMonthReport('users', 'created_at'));
		View::share('reportTickets', 	$report->showMonthReport('tickets', 'created_at'));			
		
		$this->layout->content = View::make('admin.dashboard', $data);
	}
	
	public function settings()
	{
		$language = new Language;
		
		$data = array(
			'company' 			=> Setting::where('id', 1)->first(),
			'invitation'		=> InvitationSetting::find(1),
			'ticketPriorities'	=> TicketPriority::where('user_id', Auth::id())->orderBy('name', 'asc')->get(),
			'ticketTypes'		=> TicketType::where('user_id', Auth::id())->orderBy('name', 'asc')->get(),
			'ticketStatuses'	=> TicketStatus::where('user_id', Auth::id())->orderBy('name', 'asc')->get(),			
			'languages'			=> Language::all(),
			'defaultLanguage'	=> $language->defaultLanguage()
		);

		$this->layout->content = View::make('admin.settings.index', $data);
	}	
	/* === END VIEW === */
	
	
	/* === C.R.U.D. === */
	public function company()
	{
		$rules = array(
			'name'     	=> 'required',
			'country'	=> 'required',
			'state'		=> 'required',
			'city'		=> 'required',
			'zip'		=> 'required',
			'address'	=> 'required',
			'contact'	=> 'required',
			'phone'		=> 'required',
			'email'		=> 'required|email',
			'website'	=> 'url',
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);		
		
		if ($validator->passes())
		{
			$update 				= Setting::find(1);
			$update->receive_emails = Input::get('email');
			$update->fill(Input::all());
			$update->save();			
		}
		else
		{
			$data = array(
				'company' 	=> Setting::where('id', 1)->first(),
				'errors' 	=> $validator->errors(),
				'inputs'	=> Input::all(),
				'status'	=> 3
			);
			
			return View::make('admin.settings.company', $data);
		}	
		
		$data = array(
			'company' 	=> Setting::where('id', 1)->first(),
			'status'	=> 1
		);
		
		return View::make('admin.settings.company', $data);	
	}

	public function receiveEmails()
	{
		$rules = array(
			'email' => 'required|email'
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);		
		
		if ($validator->passes())
		{		
			$update					= Setting::where('id', 1)->first();
			$update->receive_emails	= Input::get('email');
			$update->save();
		}
		else
		{
			$data = array(
				'company' 	=> Setting::where('id', 1)->first(),
				'errors' 	=> $validator->errors(),
				'status'	=> 3
			);
			
			return View::make('admin.settings.email', $data);
		}	
		
		$data = array(
			'company' 	=> Setting::where('id', 1)->first(),
			'status'	=> 1
		);	
		
		return View::make('admin.settings.email', $data);	
	}	
	/* === END C.R.U.D. === */	
	
}