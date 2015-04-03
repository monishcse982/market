@extends('layouts.master')
@section('title')
    WELCOME TO MARKET
@stop
@section('body-title') <h1> WELCOME TO MARKET </h1> @stop
@section('body-content')
            {{Form::open(array('url' => 'Users', 'method' => 'GET')) }}
            {{Form::submit('USER LOGIN',array('class' => 'login login-submit'))}}
            {{Form::close()}}

            {{Form::open(array('url' => 'admins', 'method' => 'GET')) }}
            {{Form::submit('ADMIN LOGIN',array('class' => 'login login-submit'))}}
            {{Form::close()}}
@stop