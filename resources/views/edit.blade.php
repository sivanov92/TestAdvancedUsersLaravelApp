@extends('layouts.app')

@section('content')
 <div class="container">
 <form action="/edit/update" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group row">
            <div class="col-md-6  text-md-right">
            <h2>Edit Your Profile</h2>
            </div>
        </div>
        <div class="container container-lg ">
        <img src="{{asset($user->avatar_name)}}" class="rounded mx-auto d-block" alt="NoAvatarPhoto">
        </div>
        <div class="form-group  row">
           <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
           <div class="col-md-6">
           <input type="text" name="name" id="name" placeholder="name" class="form-control" value="{{$user->name}}">
           </div>
        </div>
        <div class="form-group  row" >
            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
            <div class="col-md-6">
            <input type="text" name="last_name" id="last_name" placeholder="last_name" class="form-control" value="{{$user->last_name}}">
            </div>
        </div>
        <div class="form-group  row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
            <div class="col-md-6">
             <input type="text" name="email" id="email" placeholder="email" class="form-control" value="{{$user->email}}">
            </div>
        </div>
        <div class="form-group  row">
            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
            <div class="col-md-6">
            <input type="text" name="password" id="password" placeholder="password" class="form-control" value="{{$user->password}}">
            </div>
        </div>
    <div class="form-group  row">
        <label for="image" class="col-md-4 col-form-label text-md-right">Choose Image</label>
        <div class="col-md-6">
        <input id="image" type="file" name="image" class="form-control" >
        </div>
    </div>
    <div class="form-group  row mb-0">
    <div class="col-md-6 offset-md-4">
     <input type="submit" value="Update" class="btn btn-primary">
    </div>
</div>
    </form>
 </div>
@endsection