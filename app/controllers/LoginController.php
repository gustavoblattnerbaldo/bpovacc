<?php

class LoginController extends \BaseController {

	protected $layout = 'login.index';
	
	
	/* === LOGIN === */
	public function login()
	{
		$this->layout->content = View::make('login.login');
	}	

	public function auth()
	{
		$rules = array(
			'email'		=> 'required|email',
			'password'	=> 'required|min:6',
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);
	
		if ($validator->passes())
		{
			if ( Auth::attempt(Input::only('email', 'password'), $remember = false) )
			{
				if ( Auth::user()->status == 1 )
				{
					if ( Auth::user()->role_id == 1 )
					{
						return Redirect::to('admin');
					}
					else
					{
						return Redirect::to('dashboard');
					}
				}
				else
				{
					return Redirect::to('login')->with('warning', 'Your account was banned !');
				}
			}
			else
			{
				return Redirect::to('login')->with('warning', 'Your username/password combination was incorrect !');
			}	
		}
		else
		{
			return Redirect::to('login')->with('warning', "Validation Error Messages ")->withErrors($validator);
		}
	}

	
	/* === FORGOT PASSWORD === */
	public function forgotPassword()
	{
		$this->layout->content = View::make('login.password');
	}	
	
	public function reset()
	{
		$rules = array(
			'sendEmail' => 'required|email',
		);	
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);	
		
		if ($validator->passes())
		{
			if ( User::where('email', Input::get('sendEmail'))->count() == 1 )
			{
				$password 			= str_random(10);
	
				$update				= User::where('email', Input::get('sendEmail'))->first();
				$update->password 	= Hash::make($password);
				$update->save();
				
				$fromEmail	= Setting::find(1)->receive_emails;
				$toEmail	= Input::get('sendEmail');;
				$title		= trans('translate.password_was_reseted');
				$subject	= trans('translate.password_was_reseted');
				
				$values = array(
					'user'		=> Input::get('sendEmail'),
					'password' 	=> $password
				);	
				
				Mail::send('assets.emails.reset', $values, function($message) use ($fromEmail, $toEmail, $title, $subject)
				{
					$message->from($fromEmail, $title);
					$message->to($toEmail)->subject($subject);
				});					
			}
			else
			{
				return Redirect::to('login')->with('warning', 'This email is not registered !');
			}
		}
		else
		{
			return Redirect::to('login')->with('warning', "Validation Error Messages ")->withErrors($validator);
		}

		return Redirect::to('login')->with('message', 'The password was reset ! Check your email !');
	}	
	/* === END FORGOT PASSWORD === */
	
	
	/* === CREATE NEW ACCOUNT === */
	public function create()
	{
		$this->layout->content = View::make('login.sign-in');
	}
	
	public function store()
	{
		$rules = array(
			'name'				=> 'required',
			'email'				=> 'required|email|unique:users',
			'repeatEmail'		=> 'required|email|same:email',
			'password'			=> 'required|min:6',
		);
		
		$validator = Validator::make(array_map('trim', Input::all()), $rules);
		
		if ($validator->passes())
		{
			$store					= new User;
			$store->role_id			= 3;
			$store->parent_id		= 0;
			$store->name			= Input::get('name');
			$store->email			= Input::get('email');
			$store->password		= Hash::make(Input::get('password'));
			$store->save();	
			
			$fromEmail	= Setting::find(1)->receive_emails;	
			$toEmail	= Input::get('email');;
			$subject	= trans('translate.account_was_created');
			
			$values = array(
				'user'		=> Input::get('email'),
				'password'	=> Input::get('password')
			);		
			
			Mail::send('assets.emails.clients', $values, function($message) use ($fromEmail, $toEmail, $subject)
			{
				$message->from($fromEmail, trans('translate.app_name'));
				$message->to($toEmail)->subject($subject);
			});				
		}
		else
		{
			$data = array(
				'errors' 	=> $validator->errors(),
				'inputs'	=> Input::all()
			);
			
			return Redirect::to('create-account')->with('warning', "Validation Error Messages")->withErrors($validator);
		}		
		
		return Redirect::to('login')->with('message', "Account was created ! Login with your username and password !");
	}
	/* === END CREATE NEW ACCOUNT === */
	
	
	/* === LOGOUT === */
	public function logout()
	{
		Auth::logout();
		
		return Redirect::to('');
	}
	/* === END LOGOUT === */
	
}