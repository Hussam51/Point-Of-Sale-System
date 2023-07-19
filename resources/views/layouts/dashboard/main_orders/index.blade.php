@extends('layouts.dashboard.app')
@section('content')



    <div class="container content-wrapper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Orders</li>
            </ol>
        </nav>
        <div class="row">



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
            <div class="row" style="text-align: center">
                <div class="col-md-6 " style="border: 2px rgb(151, 160, 240) solid;">
                    <div class=" bg-danger">
                        <span>Categories</span>
                    </div><br>


                        <div class="" id="">

                            <div class="row">
                                <form action="" method="GET">
                                   <div class="col-md-8">
                                     <input type="text" name="search" class="form-control" placeholder="search" />
                                  </div>
                                  <div>
                                      <button class="fa fa-search btn btn-primary"></button>
                                  </div>
                                </form>
                              </div>
                            @if ($orders->count() > 0)

                                <table class="table table-hover container">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th> Client</th>
                                            <th>Total price</th>
                                            <th>Created at </th>
                                            <th>Status</th>
                                            <th width="280px">Action</th>
                                        </tr>
                                    </thead>
                                    @forelse ($orders as $id=> $order)
                                       <tbody>
                                          <tr>
                                            <td>{{$id}}</td>
                                            <td>{{$order->client->name}}</td>
                                            <td>{{number_format( $order->total_price,2)}}</td>
                                            <td>{{$order->created_at->toFormattedDateString()}}</td>
                                            <td>
                                               <button class="btn btn-primary btn-sm order-products"
                                               data-url="{{route('order.products',$order->id)}}"
                                               data-method="get"
                                               >
                                                            <li class="fa fa-list"></li>show
                                               </button>
                                            </td>
                                          </tr>
                                       </tbody>
                                    @empty

                                    @endforelse
                                </table>
                            @endif
                        </div>


                        <!-- On cells (`td` or `th`) -->


                </div>
                <div class="col-md-6 box-body">
                    <div class=" bg-info">
                        <span>Products</span>
                    </div><br>
                    <div id="product-list">

                    </div>
                    <!-- On tables -->


                </div>
            </div>


        </div>

    </div>


@endsection
