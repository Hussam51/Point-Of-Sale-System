@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </nav>



        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Products Management</h2>
                </div>
            </div>


        </div>
<br>
<div class="form-group">

     <select name="category_id" class="form-group">
        <option value="" > all category</option>
     </select>
    <input type="search" name="search" placeholder="search" />

    <button type="submit" class="fa fa-search btn btn-primary"></button>

</div>

<div class="pull-left">
    <a class="btn btn-success fa fa-plus" href="{{ route('products.create') }}"> Create New Product </a>
</div>

        <table class="table table-bordered">
            <tr>
                <th>Id</th>
                <th> Name</th>
                <th>Purchise Price</th>
                <th>Sale Price</th>
                <th>Category</th>
                <th>stock</th>
                <th>Profit</th>
                <th>Image</th>

                <th width="280px">Action</th>
            </tr>
            @foreach ($data as $key => $product)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->purchase_price }}</td>
                    <td>{{ $product->sale_price }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{$product->profit_precent}} %</td>
                    <td>
                        <a href="{{$product->image_path}}">
                            <img src="{{$product->image_path}}" width="120px" height="120px"
                                style="border-radius: 30%" />
                        </a>
                    </td>
                    <td >

                        <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>

                       <div style="display:inline-block">
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm"> Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>




    </div>


    <!-- Modal -->
@endsection
