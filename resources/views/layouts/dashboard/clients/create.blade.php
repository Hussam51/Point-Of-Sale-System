@extends('layouts.dashboard.app')
@section('content')
    <div class="row">


        <div class="container">

            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Create New Client</h2>
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
                <button class="fa fa-close"></button>
            @endif


            <form action="{{ route('clients.store') }}" method="POST">
                @csrf
                <div class="row">
                    





                        <div class="form-group">

                            <strong> Name</strong>
                            <input type="text" class="" name="name" placeholder="Name">

                            @for ($i=1;$i<=2;$i++)
                            <strong>Phone 1 :</strong>
                            <input type="number" class="form-control" name="phone[]" placeholder="phone"/>
                            @endfor

                            <strong>Address :</strong>
                            <input type="text" class="form-control" name="address" placeholder="address"/>

                        </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>

                <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
        </div>



    </div>
@endsection
