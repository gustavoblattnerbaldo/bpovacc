<?php

class DashboardController extends \BaseController {

	protected $layout = 'users.index';
	
	
	public function index()
	{
		$ticket = new Ticket;
					
		if ( ! $this->userIsClient )
		{
			$data = array(
				'totalClients'	=> User::where('role_id', 3)->count(),
				'totalReplies'	=> TicketHistory::where('user_id', Auth::id())->count(),
				'tickets'		=> array_slice($ticket->getAll(), 0, 5, true),				
				'lastTickets'	=> Ticket::orderBy('id', 'desc')->take(5)->get()
			);		
			
			$this->layout->content = View::make('users.dashboards.staff', $data);						
		}
		
		if ( $this->userIsClient )
		{
			return Redirect::to('ticket');
		}		
	}

}