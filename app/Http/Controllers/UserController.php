<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Model\Accounts\Address;
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
	 * Show the page for users to verify their emails
	 * @return \Illuminate\Http\Response 
	 */
	public function verifyEmailPage()
	{
		return view('platform.verify-email');
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
			'address_1' => 'required_with:address',
			'address_2' => 'nullable',
			'city' => 'required_with:address',
			'zip' => 'required_with:address',
			'state' => 'required_with:address',
			'country' => 'required_with:address',
		]);

		$user = User::find($request->user()->id);
		$user->firstname = $request->firstname;
		$user->lastname = $request->lastname;
		$user->save();

		Address::where('user_id', $request->user()->id)->delete();
		Address::create([
			'user_id' => $user->id,
			'address' => $request->address_1,
			'address_2' => $request->address_2,
			'city' => $request->city,
			'state' => $request->state,
			'zip' => $request->zip,
			'country' => $request->country,
		]);

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
