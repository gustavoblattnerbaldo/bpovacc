<?php

class StaffController extends \BaseController {

	protected $layout = 'admin.index';
	
	
	/* === VIEW === */
	public function index()
	{
		$staff = new Staff;
		
		$data = array(
			'staff' => $staff->getAll()
		);
	
		if (Request::ajax())
		{
			return $this->loadDataTable();
		}
		else
		{
			$this->layout->content = View::make('admin.staff.index', $data);
		}		
	}

	public function create()
	{
		$data = array(
			'departments' => Department::all()
		);
		
		return View::make('admin.staff.create', $data);
	}

	public function show($id)
	{
		$staff = new Staff;
		
		$data = array(
			'staff' => $staff->getOne($id)
		);
		
		return View::make('admin.staff.show', $data);
	}	
	
	public function edit($id)
	{
		$staff = new Staff;
		
		$data = array(
			'staff' 		=> $staff->getOne($id),
			'departments' 	=> Department::all()
		);
		
		return View::make('admin.staff.edit', $data);
	}
	/* === END VIEW === */
	
	
	/* === C.R.U.D. === */
	public function store()
	{
		$rules = array(
			'name'			=> 'required',
			'email'			=> 'required|email|unique:users',
			'department'	=> 'required',
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);	
		
		if ($validator->passes())
		{
			$password				= str_random(10);
			
			$store					= new User;
			$store->role_id			= 2;
			$store->parent_id		= Auth::id();
			$store->name			= Input::get('name');
			$store->email			= Input::get('email');
			$store->password		= Hash::make($password);
			$store->save();	
			
			$department					= new UserDepartment;
			$department->user_id		= $store->id;
			$department->department_id	= Input::get('department');
			$department->save();
			
			$fromEmail	= Auth::user()->email;	
			$toEmail	= Input::get('email');;
			$subject	= trans('translate.account_was_created');
			
			$values = array(
				'staff'		=> Input::get('email'),
				'password'	=> $password
			);		
			
			Mail::send('assets.emails.staff', $values, function($message) use ($fromEmail, $toEmail, $subject)
			{
				$message->from($fromEmail, trans('translate.app_name'));
				$message->to($toEmail)->subject($subject);
			});				
		}
		else
		{
			$data = array(
				'departments' 	=> Department::all(),
				'errors' 		=> $validator->errors(),
				'inputs'		=> Input::all()
			);
			
			return View::make('admin.staff.create', $data);
		}
			
		return $this->loadDataTable();	
	}
	
	public function update($id)
	{
		$update = User::find($id);
		$staff 	= new Staff;
		
		if ( Input::get('action') == 'details' )
		{
			$rules = array(
				'name'			=> 'required',
				'email'			=> 'required|email',
				'department'	=> 'required',
			);	
			
			$validator = Validator::make(array_map('trim', Input::all()), $rules);	
			
			if ($validator->passes())
			{
				$update->name			= Input::get('name');
				$update->email			= Input::get('email');
				$update->save();
				
				$department					= UserDepartment::where('user_id', $update->id)->first();
				$department->department_id	= Input::get('department');
				$department->save();
			}
			else
			{
				$data = array(
					'staff' 		=> $staff->getOne($id),
					'departments' 	=> Department::all(),
					'errors' 		=> $validator->errors(),
				);
				
				return View::make('admin.staff.edit', $data);
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
					'staff' 	=> $staff->getOne($id),
					'errors' 	=> $validator->errors(),
				);
				
				return View::make('admin.staff.edit', $data);	
			}
		}		
		
		return $this->loadDataTable();
	}

	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();
		
		return $this->loadDataTable();
	}
	/* === END C.R.U.D. === */

	
	/* === PRIVATE === */
	private function loadDataTable()
	{
		$staff = new Staff;
		
		$data = array(
			'staff'		=> $staff->getAll(),
			'alert'		=> 1
		);

		return View::make('admin.staff.table', $data);		
	}
	/* === END PRIVATE === */
}