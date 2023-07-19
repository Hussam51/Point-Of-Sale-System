@extends('layouts.dashboard.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Client</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('clients.index') }}"> Back</a>
                </div>
            </div>
        </div>


        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('clients.update', $client->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong> Name :</strong>
                        <input type="text" class="form-control" name="name"
                            value="{{ old('name',$client->name) }}">

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    @for ($i=0;$i<=1;$i++)
                    <div class="form-group">

                          <strong>Phone:</strong>
                           <input type="text" class="form-control" placeholder="phone" name="phone[]"
                            value="{{old('phone',$client->phone[$i])}}">

                    </div>
                    @endfor

                    <div class="form-group">
                        <strong>Address:</strong>
                        <input type="text" class="form-control" placeholder="Address" name="address"
                            value="{{old('address',$client->address)}}">
                    </div>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>

        <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
    </div>
@endsection
