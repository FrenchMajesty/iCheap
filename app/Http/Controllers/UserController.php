<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{	
	/**
	 * Show the user's account page
	 * @return \Illuminate\Http\Response 
	 */
	public function accountPage()
	{
		$user = Auth::user();
		return view('platform.account', compact('user'));
	}
}
