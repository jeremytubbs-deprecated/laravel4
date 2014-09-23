@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-offset-4 col-md-4">
        <h1>Welcome.</h1>
        {{ Form::open(['route' => 'login']) }}
            <!-- Email Form Input -->
            <div class="form-group">
                {{ Form::label('email', 'Email Address') }}
                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'email@example.com', 'required' => 'required']) }}
            </div>

            <!-- Password Form Input -->
            <div class="form-group">
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', ['class' => 'form-control', 'required' => 'required']) }}
            </div>

            <!-- Sign In Input -->
            <div class="form-group">
                {{ Form::submit('Login', ['class' => 'btn btn-block']) }}
            </div>
        {{ Form::close() }}
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-link btn-sm"><a href={{ route('register') }}>Need an Account? Register Here.</a></button>
            <button type="submit" class="btn btn-block btn-link btn-sm"><a href={{ route('remind') }}>Forgot your password?</a></button>
        </div>
    </div>
</div>
@stop