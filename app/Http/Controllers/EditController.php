<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

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
        $user = User::find(Auth::user()->id);
        return view('edit')->with('user',$user);
    }
    public function update(Request $request)
    {
        //
        $id = Auth::user()->id;
        $user =  User::find($id);
        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                //
                $file_name = 'AvatarUser'.$id;
                $extension = $request->image->extension();
                $url = $request->image->storeAs('/storage/app', $file_name.".".$extension,'local');        
                $user->avatar_name =$url;
                //echo Storage::url($user->avatar_name);
            }
        }
        $this->validate($request,[
            'name'=>'nullable',
            'last_name'=>'nullable',
            'email'=>'nullable',
            'password'=>'nullable',
            'avatar_name'=>'nullable',

        ]);
        if($request->has('name'))
        {
           $user->name = $request->input('name');
        }
        if($request->has('last_name'))
        {
            $user->last_name = $request->input('last_name');
        }
        if($request->has('email'))
        {
            $user->email = $request->input('email');
        }
        if($request->has('password'))
        {
             $user->password = $request->input('password');
        }
        $user->save();
        return redirect('/');

    }
}
