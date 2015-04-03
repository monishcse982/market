@extends('layouts.master')

@section('title')
    USER LOGIN
@stop

@section('body-title') <h1> USER LOGIN </h1> @stop

@section('errors')
    @if(Session::has('errors'))
        {{Session::get('errors')}}
        {{Session::forget('errors')}}
    @endif
@stop

@section('body-content')
            {{Form::open(array('url' => 'users_login', 'method' => 'PUT', 'name' => 'loginForm')) }}

                {{ Form::text('username', Input::old('username'),  array('placeholder'=>'Username')) }}

                {{ Form::password('password')}}

                {{Form::submit('SUBMIT',array('class' => 'login login-submit'))}}

            {{Form::close()}}
@stop