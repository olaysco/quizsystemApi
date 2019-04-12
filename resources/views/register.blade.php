@extends('layout.master')
@section('content')
<form method="POST" action="{{ url('/register') }}">
    {{ csrf_field() }}
    <label for="email">Name</label>
    <input type="text" name="name" value=""/>
    <br>
    <label for="email">Email</label>
    <input type="text" name="email" value=""/>
    <br>
    <label for="password">Password</label>
    <input type="passord" name="password" value="">
    <button type="submit">Register</button>
</form>
@endsection
        