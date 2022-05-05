<?php

class Setting extends Eloquent {

	public $timestamps 	= false;
	protected $guarded 	= array('id');
	protected $fillable = array('name', 'language_id', 'country', 'state', 'city', 'zip', 'address', 'contact', 'phone', 'email', 'website', 'bank', 'bank_account', 'description');	
	
}