<?php

class Ticket extends Eloquent {
	
	protected 	$guarded 	= array('id', 'staff_id');
	protected 	$fillable	= array('department_id', 'priority_id', 'type_id', 'title', 'content');
	private 	$useInfo;

	
	public function getAll()
	{
		if (Auth::user()->role_id == 1)
		{
			$query = DB::select('
				SELECT 
					tickets.*, 
					users_A.name staff, 
					users_B.name client, 
					departments.name as department,
					ticket_priorities.name as priority,
					ticket_types.name as type,
					ticket_statuses.name as status				
					FROM tickets 
					LEFT JOIN users users_A ON users_A.id = tickets.staff_id
					LEFT JOIN users users_B ON users_B.id = tickets.client_id	
					LEFT JOIN  departments ON departments.id = tickets.department_id
					LEFT JOIN  ticket_priorities ON ticket_priorities.id = tickets.priority_id
					LEFT JOIN  ticket_types ON ticket_types.id = tickets.type_id
					LEFT JOIN  ticket_statuses ON ticket_statuses.id = tickets.status_id
					ORDER BY tickets.state
			');			
		}
		else
		{
			$userID = Auth::id();
			
			$query = DB::table('tickets')
					->leftJoin('users', 'users.id', '=', 'tickets.client_id')
					->leftJoin('departments', 'departments.id', '=', 'tickets.department_id')
					->leftJoin('ticket_priorities', 'ticket_priorities.id', '=', 'tickets.priority_id')
					->leftJoin('ticket_types', 'ticket_types.id', '=', 'tickets.type_id')
					->leftJoin('ticket_statuses', 'ticket_statuses.id', '=', 'tickets.status_id')
					->select(	'tickets.*',
								'users.name as client',
								'departments.name as department',
								'ticket_priorities.name as priority',
								'ticket_types.name as type',
								'ticket_statuses.name as status'
							)
							
					->where(function($querySplit) use ($userID) {
					
						if (Auth::user()->role_id == 2)
						{
							$staffDepartment = UserDepartment::where('user_id', $userID)->first();
							
							$querySplit->where('tickets.department_id', $staffDepartment->department_id);
							$querySplit->whereIn('tickets.staff_id', array(0, $userID));
						}					
						
						if (Auth::user()->role_id == 3)
						{
							$querySplit->where('tickets.client_id', $userID);
						}

					})									
					
					->orderBy('tickets.id', 'asc')
					->get();
		}
		
		return $query;
	}

	public function getOne($id)
	{
		$query = DB::select('
			SELECT 
				tickets.*, 
				users_A.name staff, 
				users_B.name client, 
				departments.name as department,
				ticket_priorities.name as priority,
				ticket_types.name as type,
				ticket_statuses.name as status,
				COUNT(ticket_histories.ticket_id) as number
				FROM tickets 
				LEFT JOIN users users_A ON users_A.id = tickets.staff_id
				LEFT JOIN users users_B ON users_B.id = tickets.client_id	
				LEFT JOIN  departments ON departments.id = tickets.department_id
				LEFT JOIN  ticket_priorities ON ticket_priorities.id = tickets.priority_id
				LEFT JOIN  ticket_types ON ticket_types.id = tickets.type_id
				LEFT JOIN  ticket_statuses ON ticket_statuses.id = tickets.status_id
				LEFT JOIN  ticket_histories ON ticket_histories.ticket_id = tickets.id
				WHERE tickets.id = ' . $id . '
				ORDER BY tickets.staff_id
		');		

		return $query[0];	
	}
	
}