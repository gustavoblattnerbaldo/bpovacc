<?php

class TicketHistory extends Eloquent {

	protected 	$guarded 	= array('id', 'ticket_id', 'user_id', 'from_id');
	protected 	$fillable 	= array('title', 'content', 'status', 'state');

	
	public function getAll()
	{
		$user = Auth::user();
		
		$query = DB::table('ticket_histories')
				->leftJoin('users', 'users.id', '=', 'ticket_histories.from_id')
				->select(	'ticket_histories.*',
							'users.name', 'users.role_id'
						)
						
				->where(function($querySplit) use ($user) {
				
					if ($user->role_id != 1)
					{
						$querySplit->where('ticket_histories.user_id', $user->id);
					}					

				})
				
				->orderBy('ticket_histories.state', 'asc')
				->get();	
		
		return $query;		
	}
	
	public function getAllbyID($ticketID)
	{
		$query = DB::table('ticket_histories')
				->leftJoin('users', 'users.id', '=', 'ticket_histories.from_id')
				->select( 	'ticket_histories.*',
							'users.role_id', 'users.name as client'
						)
				->where('ticket_histories.ticket_id', $ticketID)
				->orderBy('ticket_histories.id', 'asc')
				->get();	
		
		return $query;	
	}
	
	public function getOne($id)
	{
		$user = Auth::user();
		
		$query = DB::table('ticket_histories')
				->leftJoin('users', 'users.id', '=', 'ticket_histories.from_id')
				->select('ticket_histories.*')
						
				->where(function($querySplit) use ($user) {
				
					if ($user->role_id != 1)
					{
						$querySplit->where('ticket_histories.user_id', $user->id);
					}					

				})
				
				->where('ticket_histories.id', $id)
				->first();	
		
		return $query;		
	}
	
}