<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
       // $users = User::all();
       // return view('home')->with('users',$users);
        $users = DB::table('users')->paginate(15);
        return view('home', ['users' => $users]);

    }
    public function Sorted($sortby)
    {
        $users = User::orderBy($sortby,'asc')->get();
        return view('home')->with('users',$users);
    }
}
