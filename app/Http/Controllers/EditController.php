<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {    
        return view('edit');
    }
    public function update(Request $request)
    {
        //
        $this->validate($request,[
            'name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'password'=>'required',

        ]);
        $id = Auth::user()->id;
        print($id);
        $user =  User::find($id);
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        $user->save();
        return redirect('/');

    }
}
