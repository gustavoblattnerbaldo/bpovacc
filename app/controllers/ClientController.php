<?php

class ClientController extends \BaseController {

	protected $layout = 'admin.index';
	
	
	/* === VIEW === */
	public function index()
	{
		$client = new Client;
		
		$data = array(
			'clients' 		=> $client->getAll(),
			'invitation'	=> InvitationSetting::find(1)
		);
	
		if (Request::ajax())
		{
			return $this->loadDataTable();
		}
		else
		{
			$this->layout->content = View::make('admin.clients.index', $data);
		}		
	}

	public function create()
	{
		return View::make('admin.clients.create');
	}

	public function show($id)
	{
		$data = array(
			'client' 	=> User::find($id)
		);
		
		return View::make('admin.clients.show', $data);
	}	
	
	public function edit($id)
	{
		$data = array(
			'client'	=> User::find($id),
		);
		
		return View::make('admin.clients.edit', $data);
	}
	/* === END VIEW === */
	
	
	/* === C.R.U.D. === */
	public function store()
	{
		$rules = array(
			'name'			=> 'required',
			'email'			=> 'required|email|unique:users',
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);	
		
		if ($validator->passes())
		{
			$password				= str_random(10);
			
			$store					= new User;
			$store->role_id			= 3;
			$store->parent_id		= Auth::id();
			$store->name			= Input::get('name');
			$store->email			= Input::get('email');
			$store->password		= Hash::make($password);
			$store->save();	
			
			$fromEmail	= Auth::user()->email;	
			$toEmail	= Input::get('email');;
			$subject	= trans('translate.account_was_created');
			
			$values = array(
				'user'		=> Input::get('email'),
				'password'	=> $password
			);		
			
			Mail::send('assets.emails.clients', $values, function($message) use ($fromEmail, $toEmail, $subject)
			{
				$message->from($fromEmail, trans('translate.app_name'));
				$message->to($toEmail)->subject($subject);
			});				
		}
		else
		{
			$data = array(
				'errors' 		=> $validator->errors(),
				'inputs'		=> Input::all()
			);
			
			return View::make('admin.clients.create', $data);
		}
			
		return $this->loadDataTable();	
	}
	
	public function update($id)
	{
		$update = User::find($id);
		
		if ( Input::get('action') == 'details' )
		{
			$rules = array(
				'name'			=> 'required',
				'email'			=> 'required|email',
			);	
			
			$validator = Validator::make(array_map('trim', Input::all()), $rules);	
			
			if ($validator->passes())
			{
				$update->name			= Input::get('name');
				$update->email			= Input::get('email');
				$update->save();
			}
			else
			{
				$data = array(
					'client'	=> User::find($id),
					'errors'	=> $validator->errors(),
				);
				
				return View::make('admin.clients.edit', $data);
			}		
		}
		
		if ( Input::get('action') == 'password' )
		{
			$rules = array(
				'new-password'	=> 'required|min:6',
			);	
			
			$validator = Validator::make(array_map('trim', Input::all()), $rules);	
			
			if ($validator->passes())
			{
				$update->password = Hash::make(Input::get('new-password'));
				$update->save();
				
				$fromEmail	= Setting::find(1)->receive_emails;
				$toEmail	= $update->email;
				$title		= trans('translate.password_was_reseted');
				$subject	= trans('translate.password_was_reseted');
				
				$values = array(
					'user'		=> $update->email,
					'password' 	=> Input::get('new-password')
				);	
				
				Mail::send('assets.emails.reset', $values, function($message) use ($fromEmail, $toEmail, $title, $subject)
				{
					$message->from($fromEmail, $title);
					$message->to($toEmail)->subject($subject);
				});				
			}
			else
			{	
				$data = array(
					'client'	=> User::find($id),
					'errors' 	=> $validator->errors(),
				);
				
				return View::make('admin.clients.edit', $data);	
			}
		}		
		
		return $this->loadDataTable();
	}

	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();
		
		// $ticket = Ticket::where('client_id', $id)->first();
		// $ticket->delete();
		
		// TicketHistory::where('ticket_id', $ticket->id)->delete();
		
		return $this->loadDataTable();
	}
	/* === END C.R.U.D. === */

	
	/* === PRIVATE === */
	private function loadDataTable()
	{
		$client = new Client;
		
		$data = array(
			'clients' => $client->getAll(),
			'alert'		=> 1
		);

		return View::make('admin.clients.table', $data);		
	}
	/* === END PRIVATE === */
	

	/* === OTHERS === */
	public function sendInvitation($id)
	{
		$store				= new Invitation;
		$store->user_id		= Auth::id();
		$store->client_id	= $id;
		$store->status		= 1;
		$store->save();		
	
		$text = InvitationSetting::find(1);
		
		$data = array(
			'title'		=> $text->title,
			'content' 	=> $text->content
		);
		
		$contactEmail = User::where('id', $id)->first()->email;
		
		Mail::send('assets.emails.invitation', $data, function($message) use ($contactEmail)
		{
			$message->from(Auth::user()->email, trans('translate.app_name'));
			$message->to($contactEmail)->subject(trans('translate.invitation'));
		});		

		return $this->loadDataTable();	
	}
	/* === END OTHERS === */
	
}