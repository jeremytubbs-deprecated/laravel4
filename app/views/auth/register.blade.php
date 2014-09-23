@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-offset-4 col-md-4">
        <h1>Register.</h1>
        <div class="form-group">
            <a class="btn btn-block btn-facebook" href={{ route('facebook') }}>Connect with <strong>Facebook</strong></a>
            <span class="help-block text-center"><small>We will create your member profile using details from Facebook.</small></span>
        </div>

        <p class="seperator"> or </p>
        @include('layouts.partials.errors')
        {{ Form::open(['route' => 'register', 'name' => 'registrationForm']) }}
            <!-- Email Form Input -->
            <div class="form-group">
                {{ Form::label('email', 'Email Address') }}
                {{ Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) }}
            </div>

            <!-- Password Form Input -->
            <div class="form-group">
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', ['class' => 'form-control', 'required' => 'required']) }}
            </div>

            <!-- Password_confirmation Form Input -->
            <div class="form-group">
                {{ Form::label('password_confirmation', 'Password Confirmation') }}
                {{ Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required']) }}
            </div>

            <div class="form-group">
                {{ Form::submit('Sign Up', ['class' => 'btn btn-block']) }}
            </div>

        {{ Form::close() }}
    </div>
</div>
@stop