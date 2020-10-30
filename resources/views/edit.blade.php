@extends('layouts.app')

@section('content')
 <div class="container">
 <form action="/edit/update" method="POST">
        @method('PUT')
        @csrf
    <input type="text" name="name" id="name" placeholder="name">
    <input type="text" name="last_name" id="last_name" placeholder="last_name">
    <input type="text" name="email" id="email" placeholder="email">
    <input type="text" name="password" id="password" placeholder="password">
     <input type="submit" value="Update" class="btn btn-primary">
    </form>
 </div>
@endsection