@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
            </ol>
        </nav>
    

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Categories Management</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('categories.create') }}"> Create New Category</a>
                </div>
            </div>
        </div>


        <form action="{{route('categories.index')}}" method="GET">
            @csrf
            <div class="form-group">
                <button type="submit" class="fa fa-search btn btn-primary" ></button>
                <input type="search" name="search" class="form-group" placeholder="Name" autocomplete="on" />
             </div>
        </form>
        <table class="table table-bordered">
         <tr >
           <th>Id</th>
           <th> Name</th>
           <th>Description</th>
           <th width="280px">Action</th>
         </tr>
         @foreach ($data as $key => $category)
          <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $category->name}}</td>
            <td>{{ $category->description }}</td>
            <td >
              <div style="display: inline-block">
                <a class="btn btn-info" href="{{ route('categories.show',$category->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('categories.edit',$category->id) }}">Edit</a>


              <form action="{{route('categories.destroy',$category->id)}}" method="POST">
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
