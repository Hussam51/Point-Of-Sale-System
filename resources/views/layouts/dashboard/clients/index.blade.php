@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Clients</li>
            </ol>
        </nav>


        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Clients Management</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('clients.create') }}"> Create New Client</a>
                </div>
            </div>
        </div>


        <form action="{{route('clients.index')}}" method="GET">
            @csrf
            <div class="form-group">
                <button type="submit" class="fa fa-search btn btn-primary" > Search</button>
                <input type="text" name="search" class="form-group" placeholder="Search" autocomplete="on" />
             </div>
        </form>
        <table class="table table-bordered">
         <tr >
           <th>Id</th>
           <th> Name</th>
           <th>Phone</th>
           <th>Address</th>
           <th>Add order</th>
           <th width="280px">Action</th>
         </tr>
         @foreach ($data as $key => $client)
          <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $client->name}}</td>
            <td>{{is_array($client->phone)? implode($client->phone,'-') : $client->phone }}</td>
            <td>{{ $client->address }}</td>
            <td>  <a href="{{route('clients.orders.create',$client->id)}}" > <li class="btn sm btn-success fa fa-plus btn-sm"> add order</li></a></td>
            <td >
              <div style="display: inline-block">
                <a class="btn btn-info btn-sm" href="{{ route('clients.show',$client->id) }}">Show</a>
                <a class="btn btn-primary btn-sm" href="{{ route('clients.edit',$client->id) }}">Edit</a>


              <form action="{{route('clients.destroy',$client->id)}}" method="POST">
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
