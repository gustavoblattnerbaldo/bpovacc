<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

$lang = new Language;
App::setLocale(isset($lang->defaultLanguage()->short) ? $lang->defaultLanguage()->short : 'en');


Route::get('/',								'WebsiteController@index');
Route::get('guest-ticket',					'WebsiteController@create');
Route::post('website/send-ticket',			'WebsiteController@store');

Route::get('login',							'LoginController@login');
Route::post('auth',							'LoginController@auth');
Route::get('create-account',				'LoginController@create');
Route::post('signin',						'LoginController@store');
Route::get('forgot-password',				'LoginController@forgotPassword');
Route::post('reset',						'LoginController@reset');
Route::get('logout',						'LoginController@logout');


Route::group(array('before' => 'auth'), function()
{
	Route::group(array('before' => 'admin'), function() 
	{
		Route::get('admin',								'AdminController@index');
		Route::get('admin/settings',					'AdminController@settings');
		Route::post('admin/company',					'AdminController@company');
		Route::post('admin/email',						'AdminController@receiveEmails');

		
		Route::resource('language',						'LanguageController');
		Route::post('language/translate',				'LanguageController@translate');		
		
		Route::resource('client',						'ClientController');
		Route::resource('department',					'DepartmentController');
		Route::resource('invitation',					'InvitationSettingController');	
		Route::resource('staff',						'StaffController');
		
		Route::resource('ticketPriority',				'TicketPriorityController');
		Route::resource('ticketType',					'TicketTypeController');
		Route::resource('ticketStatus',					'TicketStatusController');	
		
		Route::delete('user/{id}/ban', 					'UserController@banUser');
		Route::get('client/{id}/send-invitation',		'ClientController@sendInvitation');
	});	

	Route::get('dashboard',								'DashboardController@index');	
	Route::post('language/setDefault',					'LanguageController@setDefaultLanguage');	

	Route::get('ticket/{id}/status',					'TicketController@showStatus');
	Route::post('ticket/{id}/status',					'TicketController@updateStatus');		
	Route::get('ticket/{id}/priority',					'TicketController@showPriority');
	Route::post('ticket/{id}/priority',					'TicketController@updatePriority');		
	Route::get('ticket/{id}/department',				'TicketController@showDepartment');
	Route::post('ticket/{id}/department',				'TicketController@updateDepartment');		
	Route::get('ticket/{id}/workers',					'TicketController@showWorkers');
	Route::post('ticket/manage-worker/{id}',			'TicketController@manageWorker');
	Route::post('ticket/{id}/mark-as-read',				'TicketController@markAsRead');	
	Route::post('ticket/{id}/reply',					'TicketController@reply');	

	Route::post('reply/{id}/mark-as-read',				'HistoryController@markAsRead');	
	Route::post('reply/{id}/reply',						'HistoryController@reply');
	
	Route::get('settings',								'SettingController@index');
	
	Route::resource('reply',							'HistoryController');
	Route::resource('ticket',							'TicketController');
	Route::resource('user',								'UserController');

});	


App::missing(function($exception)
{
	return Response::view('assets.messages.error-404', array(), 404);
});