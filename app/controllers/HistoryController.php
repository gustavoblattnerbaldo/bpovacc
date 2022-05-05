<?php

class HistoryController extends \BaseController {

	protected $layout;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->layout = 'users.index';
		
		if ($this->userInfo->role_id == 1)
		{
			$this->layout = 'admin.index';
		}
	}
	
	
	/* === VIEW === */
	public function index()
	{
		$reply = new TicketHistory;
		
		$data = array(
			'replies' => $reply->getAll()
		);	
				
		if ( Request::ajax() )
		{
			return $this->loadDataTable();	
		}
		else
		{
			$this->layout->content = View::make('users.replies.index', $data);
		}		
	}

	public function create()
	{

	}

	public function show($id)
	{
		$ticket 	= new Ticket;
		$historiy	= new TicketHistory;
		$reply		= $historiy->getOne($id);
		
		$data = array(
			'ticket' 	=> $ticket->getOne($reply->ticket_id),
			'reply' 	=> $reply,
			'histories'	=> $historiy->getAllbyID($reply->ticket_id),
			'owner'		=> Setting::find(1)->name,
		);
		
		return View::make('users.replies.show', $data);	
	}	
	
	public function edit($id)
	{
			
	}
	/* === END VIEW === */
	
	
	/* === C.R.U.D. === */
	public function store()
	{
	
	}
	
	public function update($id)
	{

	}

	public function destroy($id)
	{
		$reply = TicketHistory::where('id', $id)->where('user_id', $this->userInfo->id)->first();
		$reply->delete();	
		
		return $this->loadDataTable();		
	}
	/* === END C.R.U.D. === */
	
	
	/* === PRIVATE === */
	private function loadDataTable()
	{
		$reply = new TicketHistory;

		$data = array(
			'replies'	=> $reply->getAll(),
			'alert'		=> 1
		);
		
		return View::make('users.replies.table', $data);		
	}
	/* === END PRIVATE === */
	

	/* === OHTERS === */
	public function markAsRead($id)
	{
		if ($this->userInfo->role_id == 1)
		{
			$update 	= TicketHistory::find($id);
			$newReplies	= TicketHistory::where('state', 0)->count();
		}
		else
		{
			$update 	= TicketHistory::where('id', $id)->where('user_id', $this->userInfo->id)->first();
			$newReplies	= TicketHistory::where('user_id', $this->userInfo->id)->where('state', 0)->count();
		}
		
		$update->state 	= 1;
		$update->save();
		
		$ticket 	= new Ticket;
		$historiy	= new TicketHistory;
		$reply		= $historiy->getOne($id);
		
		$data = array(
			'ticket' 		=> $ticket->getOne($reply->ticket_id),
			'reply' 		=> $reply,
			'newReplies'	=> $newReplies-1,
			'histories'		=> $historiy->getAllbyID($reply->ticket_id),
			'owner'			=> Setting::find(1)->name,
			'alert'			=> 4
		);

		return View::make('users.replies.show', $data);
	}
	
	public function reply($ticketID)
	{
		$rules = array(
			'title'     => 'required',
			'content'	=> 'required'
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);	
		
		if ($validator->passes())
		{		
			$store				= new TicketHistory;
			$store->ticket_id	= $ticketID;
			$store->user_id		= Input::get('userID');
			$store->from_id		= $this->userInfo->id;
			$store->fill(Input::all());
			$store->save();
			
			$update 		= TicketHistory::where('id', Input::get('replyID'))->whereIn('user_id', array(1, $this->userInfo->id))->first();
			$update->state 	= 1;
			$update->save();
		}
		else
		{	
			$historiy = new TicketHistory;
			
			$data = array(
				'ticket' 		=> $ticket->getOne($id),
				'reply' 		=> $historiy->getOne(Input::get('replyID')),
				'histories'		=> $historiy->getAllbyID($id),
				'owner'			=> Setting::find(1)->name,
				'errors'		=> $validator->errors(),
				'inputs'		=> Input::all(),				
			);			

			return View::make('users.replies.show', $data);	
		}	
		
		return $this->loadDataTable();		
	}
	/* === END OHTERS === */	
	
}