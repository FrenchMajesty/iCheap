<?php

namespace App\Http\Controllers;

use App\Model\Accounts\Registration\EmailVerificationToken;
use Illuminate\Http\Request;

class EmailController extends Controller
{
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
