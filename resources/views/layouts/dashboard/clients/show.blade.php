@extends('layouts.dashboard.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('clients.index') }}"> Back</a>
            </div>
        </div>
    </div>

<div class="container">
    <div class="pull-left">
        <h2>  Client  Information</h2>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><u>  Name:</u></strong>
                {{ $client->name }}<br>
                <strong><u>  Phone: </u></strong>
                {{ implode($client->phone,'-') }}<br>
                <strong><u> Address:</u></strong>
                {{ $client->address }}
            </div>
        </div>


    </div>
</div>

@endsection
