<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Model\Accounts\Address;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'new-email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'address' => 'required|string|max:255',
            'address_1' => 'required_with:address',
            'address_2' => 'required_with:address|nullable',
            'city' => 'required_with:address',
            'zip' => 'required_with:address',
            'state' => 'required_with:address',
            'country' => 'required_with:address',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['new-email'],
            'password' => bcrypt($data['password']),
            'account' => 'user',
            'rank' => 0,
        ]);

        Address::create([
            'user_id' => $user->id,
            'address' => $data['address_1'],
            'address_2' => $data['address_2'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip' => $data['zip'],
            'country' => $data['country'],
        ]);

        return $user;
    }
}
