<?php

namespace App\Http\Controllers;

use App\User;
use App\Events\Accounts\RequestVerificationLink;
use App\Model\Accounts\Registration\EmailVerificationToken;
use Illuminate\Http\Request;

class EmailController extends Controller
{
	/**
	 * Handle request to re-send another verification link to the user
	 * @param  \Illuminate\Http\Request $request Request
	 * @return \Illuminate\Http\Response           
	 */
	public function sendVerificationEmail(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email|max:255|exists:users',
		]);

		$user = User::where('email', $request->email)->first();
		event(new RequestVerificationLink($user));

		return back()->with('status', 'We just sent you another email! Please wait 5 minutes before requesting another link.'); 
	}

    /**
	 * Handle the validating of a user's email address
	 * @param  \Illuminate\Http\Request $request Request
	 * @return \Illuminate\Http\Response           
	 */
	public function verifyEmail(Request $request)
	{
		$this->validate($request, [
			'token' => 'required|exists:email_verification_tokens|reject_soft_deleted:email_verification_tokens,token',
		]);

		$token = EmailVerificationToken::where('token', $request->token)->first();
		$token->user->email_verified = true;
		$token->user->save();
		$token->delete();

		if($request->user()) {
			return redirect()->route('account')->with('status', 'Your email was successfully verified!');
		}

		return redirect()->route('login')->with('status', 'Your email was successfully verified!');
	}
}
