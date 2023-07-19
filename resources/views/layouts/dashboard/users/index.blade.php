@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Library</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Users Management</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                </div>
            </div>
        </div>





        <table class="table table-bordered">
         <tr >
           <th>Id</th>
           <th>First Name</th>
           <th>Last Name</th>
           <th>Email</th>
           <th>Roles</th>
           <th width="280px">Action</th>
         </tr>
         @foreach ($data as $key => $user)
          <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $user->fname }}</td>
            <td>{{ $user->fname }}</td>
            <td>{{ $user->email }}</td>
            <td>
              @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                   <label class="badge badge-success">{{ $v }}</label>
                @endforeach
              @endif
            </td>
            <td >
              <div style="display: inline-block">
                <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>


              <form action="{{route('users.destroy',$user->id)}}" method="POST">
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
