<?php

$this->group([

	/**
	*
	* Backend routes main config
	*/
	'namespace' => "System", 
	'as' => "system.", 
	'prefix'	=> "admin",
	// 'middleware' => "", 

], function(){

	$this->group(['middleware' => ["web","system.guest"]], function(){
		$this->get('register/{_token?}',['as' => "register",'uses' => "AuthController@register"]);
		$this->post('register/{_token?}',['uses' => "AuthController@store"]);
		$this->get('login/{redirect_uri?}',['as' => "login",'uses' => "AuthController@login"]);
		$this->post('login/{redirect_uri?}',['uses' => "AuthController@authenticate"]);
	});

	$this->group(['middleware' => ["web","system.auth","system.client_partner_not_allowed"]], function(){
		
		$this->get('lock',['as' => "lock", 'uses' => "AuthController@lock"]);
		$this->post('lock',['uses' => "AuthController@unlock"]);
		$this->get('logout',['as' => "logout",'uses' => "AuthController@destroy"]);

		$this->group(['as' => "account."],function(){
			$this->get('p/{username?}',['as' => "profile",'uses' => "AccountController@profile"]);
			$this->group(['prefix' => "setting"],function(){
				$this->get('info',['as' => "edit-info",'uses' => "AccountController@edit_info"]);
				$this->post('info',['uses' => "AccountController@update_info"]);
				$this->get('password',['as' => "edit-password",'uses' => "AccountController@edit_password"]);
				$this->post('password',['uses' => "AccountController@update_password"]);
			});
		});

		$this->group(['middleware' => ["system.update_profile_first"]], function() {
			$this->get('/',['as' => "dashboard",'uses' => "DashboardController@index"]);

			$this->group(['prefix' => "subscriber", 'as' => "subscriber."], function () {
				$this->get('/',['as' => "index", 'uses' => "NewsletterSubscriptionController@index"]);
			});

			/*$this->group(['prefix' => "registration", 'as' => "registration."], function () {
				$this->get('/',['as' => "index", 'uses' => "RegistrationController@index"]);
				$this->get('show/{id?}',['as' => "show", 'uses' => "RegistrationController@show"]);
				$this->get('export', ['as' => "export", 'uses' => "RegistrationController@export"]);
			});  	*/



			$this->group(['prefix' => "system-account", 'as' => "user."], function () {
				$this->get('/',['as' => "index", 'uses' => "UserController@index"]);
				$this->get('create',['as' => "create", 'uses' => "UserController@create"]);
				$this->post('create',['uses' => "UserController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "UserController@edit"]);
				$this->post('edit/{id?}',['uses' => "UserController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "UserController@destroy"]);
			});

			$this->group(['prefix' => "team", 'as' => "team."], function () {
				$this->get('/',['as' => "index", 'uses' => "TeamController@index"]);
				$this->get('create',['as' => "create", 'uses' => "TeamController@create"]);
				$this->post('create',['uses' => "TeamController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "TeamController@edit"]);
				$this->post('edit/{id?}',['uses' => "TeamController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "TeamController@destroy"]);
			});
			$this->group(['prefix' => "service", 'as' => "service."], function () {
				$this->get('/',['as' => "index", 'uses' => "ServiceController@index"]);
				$this->get('create',['as' => "create", 'uses' => "ServiceController@create"]);
				$this->post('create',['uses' => "ServiceController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "ServiceController@edit"]);
				$this->post('edit/{id?}',['uses' => "ServiceController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "ServiceController@destroy"]);
			});

			//Banner
			$this->group(['prefix' => "banner", 'as' => "banner."], function () {
				$this->get('/',['as' => "index", 'uses' => "BannerController@index"]);
				$this->get('create',['as' => "create", 'uses' => "BannerController@create"]);
				$this->post('create',['uses' => "BannerController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "BannerController@edit"]);
				$this->post('edit/{id?}',['uses' => "BannerController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "BannerController@destroy"]);
			});

			//Page
			/*
			$this->group(['prefix' => "page", 'as' => "page."], function () {
				$this->get('/',['as' => "index", 'uses' => "PageController@index"]);
				$this->get('create',['as' => "create", 'uses' => "PageController@create"]);
				$this->post('create',['uses' => "PageController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "PageController@edit"]);
				$this->post('edit/{id?}',['uses' => "PageController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "PageController@destroy"]);
			});*/
			//webinfo
			$this->group(['prefix' => "web-info", 'as' => "web-info."], function () {
				$this->get('/',['as' => "index", 'uses' => "WebinfoController@index"]);
				
				$this->post('/',['uses' => "WebinfoController@store"]);
				
			});

			$this->group(['prefix' => "about-us", 'as' => "about."], function () {
				$this->get('/',['as' => "index", 'uses' => "AboutController@index"]);
				$this->post('/',['uses' => "AboutController@store"]);
			});


			//inquiries
			$this->group(['prefix' => "inquiries", 'as' => "inquiries."], function () {
				$this->get('/',['as' => "index", 'uses' => "InquiriesController@index"]);
				$this->get('create',['as' => "create", 'uses' => "InquiriesController@create"]);
				$this->post('create',['uses' => "InquiriesController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "InquiriesController@edit"]);
				$this->post('edit/{id?}',['uses' => "InquiriesController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "InquiriesController@destroy"]);
			});
			//sub-pages
			/*$this->group(['prefix' => "subpages", 'as' => "subpages."], function () {
				$this->get('/',['as' => "index", 'uses' => "SubpagesController@index"]);
				$this->get('create',['as' => "create", 'uses' => "SubpagesController@create"]);
				$this->post('create',['uses' => "SubpagesController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "SubpagesController@edit"]);
				$this->post('edit/{id?}',['uses' => "SubpagesController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "SubpagesController@destroy"]);
			});*/

			// $this->group(['prefix' => "category", 'as' => "category."], function () {
			// 	$this->get('/',['as' => "index", 'uses' => "CategoryController@index"]);
			// 	$this->get('create',['as' => "create", 'uses' => "CategoryController@create"]);
			// 	$this->post('create',['uses' => "CategoryController@store"]);
			// 	$this->get('edit/{id?}',['as' => "edit", 'uses' => "CategoryController@edit"]);
			// 	$this->post('edit/{id?}',['uses' => "CategoryController@update"]);
			// 	$this->any('delete/{id?}',['as' => "destroy", 'uses' => "CategoryController@destroy"]);
			// });

			$this->group(['prefix' => "article", 'as' => "article."], function () {
				$this->get('/',['as' => "index", 'uses' => "ArticleController@index"]);
				$this->get('create',['as' => "create", 'uses' => "ArticleController@create"]);
				$this->post('create',['uses' => "ArticleController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "ArticleController@edit"]);
				$this->post('edit/{id?}',['uses' => "ArticleController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "ArticleController@destroy"]);
			});


			$this->group(['prefix' => "video-archive", 'as' => "video_archive."], function () {
				$this->get('/',['as' => "index", 'uses' => "VideoArchiveController@index"]);
				$this->get('create',['as' => "create", 'uses' => "VideoArchiveController@create"]);
				$this->post('create',['uses' => "VideoArchiveController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "VideoArchiveController@edit"]);
				$this->post('edit/{id?}',['uses' => "VideoArchiveController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "VideoArchiveController@destroy"]);
			});

			$this->group(['prefix' => "news", 'as' => "news."], function () {
				$this->get('/',['as' => "index", 'uses' => "NewsController@index"]);
				$this->get('create',['as' => "create", 'uses' => "NewsController@create"]);
				$this->post('create',['uses' => "NewsController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "NewsController@edit"]);
				$this->post('edit/{id?}',['uses' => "NewsController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "NewsController@destroy"]);
			});

			// $this->group(['prefix' => "specialty", 'as' => "specialty."], function () {
			// 	$this->get('/',['as' => "index", 'uses' => "SpecialtyController@index"]);
			// 	$this->get('create',['as' => "create", 'uses' => "SpecialtyController@create"]);
			// 	$this->post('create',['uses' => "SpecialtyController@store"]);
			// 	$this->get('edit/{id?}',['as' => "edit", 'uses' => "SpecialtyController@edit"]);
			// 	$this->post('edit/{id?}',['uses' => "SpecialtyController@update"]);
			// 	$this->any('delete/{id?}',['as' => "destroy", 'uses' => "SpecialtyController@destroy"]);
			// });

			// $this->group(['prefix' => "app-user", 'as' => "app_user."], function () {
			// 	$this->get('/',['as' => "index", 'uses' => "AppUserController@index"]);
			// 	$this->get('mentors',['as' => "mentor", 'uses' => "AppUserController@mentors"]);
			// 	$this->get('mentees',['as' => "mentee", 'uses' => "AppUserController@mentees"]);

			// 	$this->get('create',['as' => "create", 'uses' => "AppUserController@create"]);
			// 	$this->post('create',['uses' => "AppUserController@store"]);
			// 	$this->get('edit/{id?}',['as' => "edit", 'uses' => "AppUserController@edit"]);
			// 	$this->post('edit/{id?}',['uses' => "AppUserController@update"]);
			// 	$this->any('delete/{id?}',['as' => "destroy", 'uses' => "AppUserController@destroy"]);
			// });
		});
	});
});