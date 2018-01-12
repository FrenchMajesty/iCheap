<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\System\ContactUs;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('platform.index');
    }

	/**
     * Show the contact page.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('platform.contact');
    }

    /**
     * Show the FAQ page.
     *
     * @return \Illuminate\Http\Response
     */
    public function FAQ()
    {
        return view('platform.faq');
    }

    /**
     * Handle the request to send a contact message
     * 
     * @param  \Illuminate\Http\Request $request Request
     * @return \Illuminate\Http\Response           
     */
    public function submitContact(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|string|min:2|max:160',
    		'email' => 'required|email|max:160',
    		'message' => 'required|string|min:15|max:5000',
    	]);

    	$data = [
    		'name' => $request->name,
    		'email' => $request->email,
    		'message' => $request->message,
    	];

    	Mail::to(env('CONTACT_US_EMAIL'))->send(new ContactUs($data));

    	return back()->with('status','Your message was successfully sent!');
    }    
}
