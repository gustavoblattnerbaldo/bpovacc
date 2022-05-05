<?php

class Staff extends Eloquent {


	public function getAll()
	{
		$query = DB::table('users')
				->join('user_departments', 'user_departments.user_id', '=', 'users.id')
				->join('departments', 'departments.id', '=', 'user_departments.department_id')
				->select(
							'users.*', 'users.id as userID',
							'departments.id as departmentID', 'departments.name as department'
						)
				->where('role_id', '=', 2)
				->get();
				
		return $query;
	}	

	public function getOne($id)
	{
		$query = DB::table('users')
				->join('user_departments', 'user_departments.user_id', '=', 'users.id')
				->join('departments', 'departments.id', '=', 'user_departments.department_id')
				->select(
							'users.*', 'users.id as userID',
							'departments.id as departmentID', 'departments.name as department'
						)
				->where('users.id', $id)
				->first();
				
		return $query;		
	}
	
}