<?php

/*
 * Composer for account headers
 */

View::composer('layouts.public.account_header', function($view)
{

	$user = new User;
    $user = $user->getLoggedUserInfo();

    $user_type = Sentry::findGroupById(Sentry::getUser()->group_id);

    $view->with('user', $user)
    	 ->with('user_type', $user_type->name);
});

/*
 * Composer for side bars
 */

View::composer('layouts.public.now_playing_bar', function($view)
{

	$rndsongs = Songs::getSongsRandom();

	$songs = array();
	foreach ($rndsongs as $key => $value) {
		array_push($songs, $value->id);
	}
    $view->with('songs', $songs);
    
});

View::composer('accounts.settings_email', function($view)
{
	$primary_email = User::find(Sentry::getUser()->id);
	$emails = UserEmail::getEmails();

    $view->with('emails', $emails)
		 ->with('primary_email', $primary_email->email);
    
});

