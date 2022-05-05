<?php

class UserDepartment extends Eloquent {

	public $timestamps = false;
	
	
	public function getAll($departmentID)
	{
		$userID = Auth::id();
		
		$query = DB::table('user_departments')
			->leftJoin('users', 'users.id', '=', 'user_departments.user_id')
			->select( 'users.*', 'users.id as staffID', 'users.name as worker')
			
			->where(function($querySplit) use ($userID) {
			
				if (Auth::user()->role_id == 2)
				{
					$querySplit->where('users.id', $userID);
				}

			})
			
			->where('user_departments.department_id', $departmentID)
			->get();

		return $query;		
	}
	
	public function getStaffEmailsByDepartment($departmentID)
	{
		$admin = Setting::where('id', 1)->lists('receive_emails');
		
		$query = DB::table('user_departments')
			->leftJoin('users', 'users.id', '=', 'user_departments.user_id')
			->where('user_departments.department_id', $departmentID)
			->lists('email');
		
		return array_merge($query, $admin);
	}
	
}