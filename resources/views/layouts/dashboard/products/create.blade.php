@extends('layouts.dashboard.app')
@section('content')
    <div class="row">


        <div class="container">

            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Create New Product</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
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


            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong> Product Name en:</strong>
                            <input type="text" class="form-control" name="name_en" placeholder="Name">

                        </div>
                        <div class="form-group">
                            <strong> Product Name ar:</strong>
                            <input type="text" class="form-control" name="name_ar" placeholder="Name">

                        </div>
                        <div class="form-group">
                            <strong>Purchase Price:</strong>
                            <input type="number" class="form-control" name="purchase_price" placeholder="purchase price">

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>sale price:</strong>
                            <input type="number" class="form-control" name="sale_price" placeholder="sale price">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Quantity:</strong>
                            <input type="number" class="form-control" name="stock" placeholder="Quantity">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <strong>Category:</strong>
                            <select name="category_id">
                                <option >select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <div class="form-group">
                            <strong>image:</strong>
                            <input type="file" class="form-group" name="image" value="{{old('image')}}"/>

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
