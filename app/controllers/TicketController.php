<?php

class TicketController extends \BaseController {

	protected $layout = 'users.index';
	
	
	/* === VIEW === */
	public function index()
	{
		$ticket = new Ticket;
		$reply 	= new TicketHistory;
		
		$data = array(
			'tickets' => $ticket->getAll(),
			'replies' => $reply->getAll()
		);
			
		if ( Request::ajax() )
		{
			return $this->loadDataTable();	
		}
		else
		{
			$this->layout->content = View::make('users.tickets.index', $data);
		}		
	}

	public function create()
	{
		$data = array(
			'departments'	=> Department::all(),
			'priorities'	=> TicketPriority::all(),
			'types'			=> TicketType::all()
		);
		
		return View::make('users.tickets.create', $data);
	}

	public function show($id)
	{
		$ticket 	= new Ticket;
		$historiy	= new TicketHistory;
		
		$data = array(
			'ticket' 		=> $ticket->getOne($id),
			'histories'		=> $historiy->getAllbyID($id),
			'owner'			=> Setting::find(1)->name,
		);			
		
		return View::make('users.tickets.show', $data);	
	}	
	
	public function edit($id)
	{
			
	}
	/* === END VIEW === */
	
	
	/* === C.R.U.D. === */
	public function store()
	{
		if ( $this->userIsClient )
		{
			$rules = array(
				'title'     	=> 'required',
				'department_id'	=> 'required',
				'type_id'		=> 'required',
				'priority_id'	=> 'required',
				'content'		=> 'required'
			);	
			
			$validator = Validator::make(array_map('trim', Input::all()), $rules);	
			
			if ($validator->passes())
			{
				$store				= new Ticket;
				$store->staff_id	= 0;
				$store->client_id	= $this->userInfo->id;
				$store->status_id	= 0;
				$store->state		= 0;
				$store->fill(Input::all());
				$store->save();
				
				$staffEmails	= new UserDepartment;
				$fromEmail		= $this->userInfo->email;
				$toEmail		= $staffEmails->getStaffEmailsByDepartment(Input::get('department_id'));
				$subject		= trans('translate.new_ticket');
				
				$values = array(
					'title'		=> Input::get('title'),
					'content'	=> Input::get('content')
				);
				
				Mail::send('assets.emails.ticket', $values, function($message) use ($fromEmail, $toEmail, $subject)
				{
					$message->from($fromEmail, trans('translate.app_name'));
					$message->to($toEmail)->subject($subject);
				});	
			}
			else
			{
				$data = array(
					'departments'	=> Department::all(),
					'priorities'	=> TicketPriority::all(),
					'types'			=> TicketType::all(),					
					'errors'		=> $validator->errors(),
					'inputs'		=> Input::all()
				);
				
				return View::make('users.tickets.create', $data);			
			}	
			
			return $this->loadDataTable();
		}
	}
	
	public function update($id)
	{

	}

	public function destroy($id)
	{
		if ( Auth::user()->role_id == 3 )
		{
			$ticket = Ticket::where('id', $id)->where('client_id', $this->userInfo->id)->first();
			$ticket->delete();	
			
			TicketHistory::where('ticket_id', $ticket->id)->delete();			
		}
		else
		{
			return Redirect::to('dashboard')->with('error', trans('translate.permissions_denied'));
		}		

		return $this->loadDataTable();
	}
	/* === END C.R.U.D. === */
	
	
	/* === PRIVATE === */
	private function loadDataTable()
	{
		$ticket = new Ticket;
		
		if ($this->userInfo->role_id == 1)
		{
			$newTickets = Ticket::where('state', 0)->count();
		}
		
		$data = array(
			'tickets'	=> $ticket->getAll(),
			'alert'		=> 1
		);
		
		return View::make('users.tickets.table', $data);		
	}
	/* === END PRIVATE === */
	
	
	/* === ADDONS === */
	public function showDepartment($id)
	{
		$data = array(
			'ticket'		=> Ticket::find($id),
			'departments' 	=> Department::all()
		);
		
		return View::make('users.tickets.addons.department', $data);		
	}
	
	public function updateDepartment($id)
	{
		$rules = array(
			'department' => 'required'
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);	
		
		if ($validator->passes())
		{			
			$update 				= Ticket::find($id);
			$update->staff_id		= 1;
			$update->department_id 	= Input::get('department');
			$update->save();
		}	
		else
		{
			$data = array(
				'ticket'		=> Ticket::find($id),
				'departments' 	=> Department::all(),
				'errors'		=> $validator->errors()
			);
			
			return View::make('users.tickets.addons.department', $data);					
		}
		
		return $this->loadDataTable();
	}
	
	public function showStatus($id)
	{
		$data = array(
			'ticket'	=> Ticket::find($id),
			'statuses' 	=> TicketStatus::all()
		);
		
		return View::make('users.tickets.addons.status', $data);		
	}
	
	public function updateStatus($id)
	{
		$rules = array(
			'status' => 'required'
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);	
		
		if ($validator->passes())
		{			
			$update 			= Ticket::find($id);
			$update->status_id 	= Input::get('status');
			$update->save();
		}	
		else
		{
			$data = array(
				'ticket'	=> Ticket::find($id),
				'statuses' 	=> TicketStatus::all(),
				'errors'	=> $validator->errors()
			);
			
			return View::make('users.tickets.addons.status', $data);					
		}
		
		return $this->loadDataTable();
	}	
	
	public function showPriority($id)
	{
		$data = array(
			'ticket'		=> Ticket::find($id),
			'priorities' 	=> TicketPriority::all()
		);
		
		return View::make('users.tickets.addons.priority', $data);		
	}
	
	public function updatePriority($id)
	{
		$rules = array(
			'priority' => 'required'
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);	
		
		if ($validator->passes())
		{			
			$update 				= Ticket::find($id);
			$update->priority_id	= Input::get('priority');
			$update->save();
		}	
		else
		{
			$data = array(
				'ticket'		=> Ticket::find($id),
				'priorities' 	=> TicketPriority::all(),
				'errors'		=> $validator->errors()
			);
			
			return View::make('users.tickets.addons.priority', $data);					
		}
		
		return $this->loadDataTable();
	}	
	
	public function showWorkers($id)
	{
		$ticket = new Ticket;
		$staff	= new UserDepartment;
		
		$data = array(
			'ticket' 	=> $ticket->getOne($id),
			'workers'	=> $staff->getAll($ticket->getOne($id)->department_id)
		);
		
		return View::make('users.tickets.addons.workers', $data);		
	}
	
	public function manageWorker($id)
	{
		$ticketID 			= Input::get('ticketID');
		
		$update 			= Ticket::find($ticketID);
		$update->staff_id	= $id;
		$update->save();			
		
		$ticket = new Ticket;
		$staff	= new UserDepartment;

		$data = array(
			'ticket' 	=> $ticket->getOne($ticketID),
			'workers'	=> $staff->getAll($ticket->getOne($ticketID)->department_id),
			'alert'		=> 4
		);
		
		return View::make('users.tickets.addons.workers', $data);
	}
	/* === END ADDONS === */

	
	/* === OHTERS === */
	public function markAsRead($id)
	{
		if ($this->userInfo->role_id == 1)
		{
			$update 	= Ticket::find($id);
			$newTickets	= Ticket::where('state', 0)->count();
		}
		else		
		{
			$update 	= Ticket::where('id', $id)->whereIn('staff_id', array(0, $this->userInfo->id))->first();
			$newTickets	= Ticket::whereIn('staff_id', array(0, $this->userInfo->id))->where('state', 0)->count();
		}
		
		$update->staff_id 	= $this->userInfo->id;
		$update->state 		= 1;
		$update->save();
		
		$ticket 	= new Ticket;
		$historiy	= new TicketHistory;
		
		$data = array(
			'ticket' 		=> $ticket->getOne($id),
			'newTickets'	=> $newTickets,
			'histories'		=> $historiy->getAllbyID($id),
			'owner'			=> Setting::find(1)->name,
			'alert'			=> 4
		);
		
		return View::make('users.tickets.show', $data);
	}
	
	public function reply($id)
	{
		$rules = array(
			'title'     => 'required',
			'content'	=> 'required'
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);	
		
		if ($validator->passes())
		{		
			$store				= new TicketHistory;
			$store->ticket_id	= $id;
			$store->user_id		= Input::get('userID');
			$store->from_id		= $this->userInfo->id;
			$store->fill(Input::all());
			$store->save();
			
			$update = Ticket::find($id);

			if ($update->state == 0)
			{
				$update->staff_id	= $this->userInfo->id;
				$update->state 		= 1;
				$update->save();
			}
			
			View::share('newTickets', Ticket::where('state', 0)->count());

			$fromEmail		= $this->userInfo->email;
			$toEmail		= User::where('id', Input::get('userID'))->lists('email');
			$subject		= trans('translate.new_reply');
			
			$values = array(
				'title'		=> Input::get('title'),
				'content'	=> Input::get('content')
			);
			
			Mail::send('assets.emails.reply', $values, function($message) use ($fromEmail, $toEmail, $subject)
			{
				$message->from($fromEmail, trans('translate.app_name'));
				$message->to($toEmail)->subject($subject);
			});			
		}
		else
		{	
			$ticket 	= new Ticket;
			$historiy	= new TicketHistory;
			
			$data = array(
				'ticket' 	=> $ticket->getOne($id),
				'histories'	=> $historiy->getAllbyID($id),
				'errors'	=> $validator->errors(),
				'inputs'	=> Input::all(),				
			);			

			return View::make('users.tickets.show', $data);	
		}	
		
		return $this->loadDataTable();				
	}
	/* === END OHTERS === */
	
}