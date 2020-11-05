@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h1>Welcome to your Profile !</h1>
                    <table class="table">
                        <thead>
                          <tr>
                          <th scope="col"><a href="/sorted/id">#ID</a></th>
                          <th scope="col"><a href="/sorted/name">First</a></th>
                          <th scope="col"><a href="/sorted/last_name">Last</a></th>
                          <th scope="col"><a href="/sorted/email">Email</a></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->last_name}}</td>
                            <td>{{ $user->email}}</td>
                          </tr>                           
                        @endforeach
                        </tbody>
                      </table>
                </div>
                {{ $users->links('vendor/pagination/bootstrap-4') }}
                
            </div>
        </div>
    </div>
</div>
@endsection
