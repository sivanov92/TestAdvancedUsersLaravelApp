<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
       // return view('home')->with('users',$users);
        $users = DB::table('users')->whereIn('id',$user->assigned)->paginate(15);
        return view('home', ['users' => $users,'user'=>$user]);

    }
    public function Sorted($sortby)
    {
        $users = User::orderBy($sortby,'asc')->get();
        return view('home')->with('users',$users);
    }
}
