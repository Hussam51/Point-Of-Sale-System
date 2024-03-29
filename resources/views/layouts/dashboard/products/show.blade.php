@extends('layouts.dashboard.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>

<div class="container">
    <div class="pull-left">
        <h2>  User  Information</h2>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong> First Name:</strong>
                {{ $user->fname }}<br>
                <strong> Last Name:</strong>
                {{ $user->fname }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $user->email }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong style="display: inline-block ">Roles:</strong>
                @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                        <label class="badge badge-success">{{ $v }}</label>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
