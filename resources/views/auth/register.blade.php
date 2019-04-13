@extends('layout.master')
@section('content')
<form method="POST" action="{{ url('/register') }}">
    {{ csrf_field() }}
    <label for="email">Name</label>
    <input type="text" name="name" value="{{old('name')}}"/>
    <br>
    <label for="email">Email</label>
    <input type="text" name="email" value="{{old('email')}}"/>
    <br>
    <label for="password">Password</label>
    <input type="password" name="password" value="">
    <br>
    <label for="password">Confirm Password</label>
    <input type="password" name="password_confirmation" value="">
    <button type="submit">Register</button>
</form>
@endsection
        