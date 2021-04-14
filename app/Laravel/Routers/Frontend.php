<?php

$this->group([

	/**
	*
	* Backend routes main config
	*/
	'namespace' => "Frontend", 
	'as' => "frontend.", 
	// 'prefix'	=> "admin",
	// 'middleware' => "", 

	], function(){

		

		// $this->get('/',['as' => "homepage",'uses' => "MainController@homepage"]);
		// $this->post('/',['uses' => "MainController@subscribe"]);
		$this->get('/', ['as' => "main",'uses' => "MainController@index"]);
		$this->get('/contact-us', ['as' => "contact_us",'uses' => "ContactUsController@index"]);
		$this->post('/contact-us',['uses' => "ContactUsController@inquiry"]);
		$this->get('/about-us', ['as' => "about_us",'uses' => "AboutUsController@index"]);	

		$this->get('/teams', ['as' => "teams",'uses' => "TeamController@index"]);

	



		
	
});