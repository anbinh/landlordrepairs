@extends('blank')

@section('content')

<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                User Profile
            </h1>
            <ul>
                <li><strong>Profile picture</strong> : <img src="{{ $user->profile_picture }}" style="max-width:100px; max-height:100px" /></li>
                <li><strong>User name</strong> : {{ $user->username }}</li>
                <li><strong>First name</strong> : {{ $user->first_name }}</li>
                <li><strong>Last name</strong> : {{ $user->last_name }}</li>
                <li><strong>Email</strong> : {{ $user->email }}</li>
                <li><strong>Role</strong> : {{ ($user->role == 1) ? "Admin" : "User" }}</li>
            </ul>
            
        </div>
    </div>
<!-- /.row -->

@stop