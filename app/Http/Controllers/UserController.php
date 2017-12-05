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
		$ordersDone = $user->orders()->paginate(7);

		return view('platform.account', compact('user', 'ordersDone'));
	}

	/**
	 * Handle request to update account's informations
	 * @param  \Illuminate\Http\Request $request Request
	 * @return \Illuminate\Http\Response           
	 */
	public function updateAccountDetails(Request $request)
	{
		$this->validate($request, [
			'firstname' => 'required|string|max:255',
			'lastname' => 'required|string|max:255',
			'address' => 'required|string|max:255',
		]);

		$user = User::find($request->user()->id);
		$user->firstname = $request->firstname;
		$user->lastname = $request->lastname;
		$user->address = $request->address;
		$user->save();

		return back()->with('status','Your account details were successfully updated!');
	}

	/**
	 * Handle the request to update user's password
	 * @param  \Illuminate\Http\Request $request Request
	 * @return \Illuminate\Http\Response           
	 */
	public function updatePassword(Request $request)
	{
		$this->validate($request, [
			'password' => 'required|min:6|confirmed',
		]);

		$user = User::find($request->user()->id);
		$user->password = bcrypt($request->password);
		$user->save();

		return back()->with('password-status', 'Your password was successfully updated!');
	}
}
