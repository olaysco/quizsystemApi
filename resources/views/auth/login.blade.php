@extends('layout.master')
@section('content')

<form action="{{ url('/login') }}" method="POST">
    {{ csrf_field() }}
    <label for="email">Email</label>
    <input type="text" name="email" value=""/>
    <br>
    <label for="password">Password</label>
    <input type="passord" name="password" value="">
    <button type="submit">Login</button>
</form>

@endsection
        