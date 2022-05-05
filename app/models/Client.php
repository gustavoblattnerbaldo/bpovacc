<?php

class Client extends Eloquent {

	
	public function getAll()
	{
		$query = DB::table('users')
					->leftJoin('invitations','invitations.client_id', '=', 'users.id')
					->select(	'users.*',
								'invitations.status as invitation'
						)
					->where('role_id', '=', 3)
					->orderBy('id', 'desc')
					->get();		
					
		return $query;			
	}	
	
}