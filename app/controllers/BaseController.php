<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected	$userInfo;
	protected	$userIsClient;
	
	public function __construct()
	{
		if ( Auth::check() )
		{
			$user			= User::where('id', Auth::id())->select('id', 'role_id', 'email', 'name')->first();	
			$userIsAdmin  	= $user->role_id == 1 ? true : false;	
			$userIsClient	= $user->role_id == 3 ? true : false;

			$this->userInfo 	= $user;
			$this->userIsClient = $userIsClient;
			
			View::share('user', $user);			
			View::share('userIsClient', $userIsClient);	

			if ($userIsAdmin)
			{
				View::share('newTickets', 		Ticket::where('state', 0)->count());
				View::share('newReplies', 		TicketHistory::where('state', 0)->count());	
			}
			else
			{
				if (!$userIsClient)
				{
					$staff = new Staff;
					View::share('newTickets', 	Ticket::where('department_id', $staff->getOne($user->id)->departmentID)->whereIn('staff_id', array(0, $user->id))->where('state', 0)->count());
				}				
				
				View::share('newReplies', 		TicketHistory::where('user_id', $user->id)->where('state', 0)->count());
			}
		}	
	}

}