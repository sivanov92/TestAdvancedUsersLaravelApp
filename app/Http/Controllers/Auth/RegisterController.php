<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegisterred;
use Illuminate\Support\Arr;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $users = User::all();
        $emails = array();
        foreach($users as $user){
            Arr::add($user->email,$emails);
        }
        foreach ($emails as $recipient) {
            Mail::to($recipient)->send(new UserRegisterred());
        }
        //-- Find Someone to Assign to !
        $sizes = [];
        foreach($users as $user)
        {
         array_push($sizes,count($user->assigned));
         if($user->id==5)
          {
            break;
          }
        }
        sort($sizes);
        $head1 = $sizes[0];
        $head2 = $sizes[1];
        $next_id = count($users);
        /*
         This module will currently be pending.
         I used a migration to set the assignments to all seeded users, however 
         updating the register to assign a user or a leader needs more work, so
         you can see the code i wrote to achieve it, but its only  a part of the algorithm i need
         to make.
        */
        //--
        return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
           // 'assigned'=>[$head1,$head2],
        ]);
    }
}
