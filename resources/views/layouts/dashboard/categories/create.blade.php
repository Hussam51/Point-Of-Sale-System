@extends('layouts.dashboard.app')
@section('content')
    <div class="row">


        <div class="container">

            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Create New Category</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
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


            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="" style="display: inline-block">

                            <input type="text" class="" name="name_en" placeholder="Name en">
                            <label>: Name en</label>
                            <input type="text" class="" name="name_ar" placeholder="Name ar">
                            <label>: Name ar</label>

                        </div><br/>
                        <div class="form-group">
                            <strong>Descriptions en:</strong>
                            <textarea type="text" class="form-control" name="description_en" placeholder="description en"></textarea>
                            <strong>Descriptions ar:</strong>
                            <textarea type="text" class="form-control" name="description_ar" placeholder="description ar"></textarea>

                        </div>
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
