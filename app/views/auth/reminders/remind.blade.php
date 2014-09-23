@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <h1>Reset Your Password</h1>

        {{ Form::open(['route' => 'remind', 'method' => 'POST', 'name' => 'form', 'novalidate' => '', 'autocomplete' => 'off']) }}
            <div class="form-group">
                <label for="email" class="control-label">Email address</label>
                {{ Form::email('email', NULL, array(
                    'class' => 'form-control',
                    'placeholder' => 'email@example.com',
                    'ng-model' => 'formData.email',
                    'required' => true
                ))}}
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-block" ng-disabled="form.$invalid">Send Reset</button>
            </div>
        {{ Form::close() }}
    </div>
</div>
@stop