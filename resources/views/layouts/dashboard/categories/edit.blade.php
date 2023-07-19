@extends('layouts.dashboard.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit category</h2>
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
        @endif

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong> Name en:</strong>
                        <input type="text" class="form-control" name="name_en"
                            value="{{ old('name_en',$category->getTranslation('name', 'en'))}}">
                            <strong> Name ar:</strong>
                            <input type="text" class="form-control" placeholder="Name ar" name="name_ar"
                                value="{{ old('name_ar',$category->getTranslation('name', 'ar'))}}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Descriptions en:</strong>
                        <input type="text" class="form-control" placeholder="Descriptions" name="description_en"
                            value="{{old('description_en',$category->getTranslation('description', 'en'))}}">
                    </div>
                    <div class="form-group">
                        <strong>Descriptions ar:</strong>
                        <input type="text" class="form-control" placeholder="Descriptions" name="description_ar"
                            value="{{old('description_ar',$category->getTranslation('description', 'ar'))}}">
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
