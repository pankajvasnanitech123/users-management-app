@extends('layout.default')

@section('content')
    <h3 class="text-center"> {{ trans('Login To Users Management App') }} </h3>
    <div class="container">
        @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            You have entered invalid inputs. Please enter again.
        </div>
        @endif
        <div clas="row">
            {{ Form::open(array('route' => ['login_validate'], 'method' => 'post')) }}
                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    {{ Form::text('email', '', ['class' => 'form-control', 'id' => 'inputEmail', 'placeholder' => 'Email']) }}
                </div>
                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    {{ Form::password('password', ['class' => 'form-control', 'id' => 'inputPassword', 'placeholder' => 'Password']) }}
                </div>
                <div class="checkbox">
                    <label><input type="checkbox"> Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            {{ Form::close() }}
        </div>
    </div>
@stop
