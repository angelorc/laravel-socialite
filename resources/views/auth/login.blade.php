@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body text-center">
                    <a class="btn btn-primary" href="">Github</a>
                    <a class="btn btn-primary" href="{{ action('Auth\AuthController@redirectToProvider') }}">Facebook</a>
                    <a class="btn btn-primary" href="">Google</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
