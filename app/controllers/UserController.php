<?php

class UserController extends \BaseController {

	protected $layout = 'admin.index';
	
	
	/* === C.R.U.D. === */
	public function update($id)
	{
		$update = User::find($id);
		
		if ( Input::get('action') == 'email' )
		{
			$rules = array(
				'email'     	=> 'required|email|unique:users',
				'repeat-email'	=> 'required|same:email',
			);	
			
			$validator = Validator::make(array_map('trim', Input::all()), $rules);	
			
			if ($validator->passes())
			{
				$update->email	= Input::get('email');
				$update->save();
			}
			else
			{
				$data = array(
					'errors'	=> $validator->errors()
				);
				
				return $this->showAccount($data);
			}

			$data = array(
				'alert'	=> 1
			);		
			
			return $this->showAccount($data);			
		}
		
		if ( Input::get('action') == 'password' )
		{
			$rules = array(
				'old-password'	=> 'required|min:6',
				'new-password'	=> 'required|min:6',
			);	
			
			$validator = Validator::make(array_map('trim', Input::all()), $rules);	
			
			if ($validator->passes())
			{
				if ( Hash::check(Input::get('old-password'), $update->password) )
				{
					$update->password = Hash::make(Input::get('new-password'));
					$update->save();
				}
				else
				{
					$data = array(
						'errors'	=> $validator->errors(),
						'alert'		=> 2
					);
					
					return $this->showPassword($data);
				}
			}
			else
			{	
				$data = array(
					'errors' => $validator->errors()
				);
				
				return $this->showPassword($data);
			}
			
			$data = array(
				'alert'	=> 1
			);		
			
			return $this->showPassword($data);	
		}
		
		if ( Input::get('action') == 'details' )
		{
			$rules = array(
				'name'	=> 'required'
			);	
			
			$validator = Validator::make(array_map('trim', Input::all()), $rules);	
			
			if ($validator->passes())
			{
				$update->name	= Input::get('name');
				$update->save();
			}
			else
			{
				$data = array(
					'errors' => $validator->errors()
				);
				
				return $this->showAccount($data);
			}

			$data = array(
				'user'	=> User::find(Auth::id()),
				'alert'	=> 1
			);		
			
			return View::make('users.settings.details', $data);		
		}
	}
	/* === END C.R.U.D. === */	

	
	/* === PRIVATE === */
	private function showAccount($data)
	{
		if (Auth::user()->role_id != 1)
		{
			return View::make('users.settings.account', $data);
		}
		else
		{
			return View::make('admin.settings.account', $data);
		}		
	}	
	
	private function showPassword($data)
	{
		if (Auth::user()->role_id != 1)
		{
			return View::make('users.settings.password', $data);
		}
		else
		{
			return View::make('admin.settings.password', $data);
		}		
	}
	/* === END PRIVATE === */
	
	
	/* === OTHERS === */
	public function banUser($id)
	{
		$ban 	= 0;
		$update = User::find($id);
		
		if ($update->status == 0)
		{
			$ban = 1;
		}
		
		$update->status = $ban;
		$update->save();
		
		$client = new Client;
		
		$data = array(
			'clients' => $client->getAll(),
			'alert'		=> 1
		);

		return View::make('admin.clients.table', $data);
	}
	/* === END OTHERS === */
	
}