@extends('layouts.dashboard.app')
@section('content')



    <div class="container content-wrapper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Clients</li>
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
                    @forelse ($categories as $category)
                        <p>
                            <a class="btn btn-primary" data-bs-toggle="collapse"
                                href="#{{ str_replace('', '-', $category->name) }}" role="button" aria-expanded="false"
                                aria-controls="collapseExample">
                                {{ $category->name }}
                            </a>

                        </p>
                        <div class="collapse" id="{{ str_replace('', '-', $category->name) }}">

                            @if ($category->products->count() > 0)
                                <table class="table table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th> Name</th>
                                            <th>stock</th>
                                            <th>Sale Price</th>
                                            <th width="280px">Add order</th>
                                        </tr>
                                        @foreach ($category->products as $key => $product)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>{{ $product->sale_price }}</td>
                                                <td>
                                                    <a href="" id="product-{{ $product->id }}"
                                                        data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                        data-price="{{ $product->sale_price }}"
                                                        class="btn btn-info add-product">
                                                        <li class="fa fa-plus"></li>
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach
                                </table>
                            @endif
                        </div>


                        <!-- On cells (`td` or `th`) -->

                    @empty
                    @endforelse
                </div>
                <div class="col-md-6 box-body">
                    <div class=" bg-info">
                        <span>Orders</span>
                    </div><br>
                    <!-- On tables -->
                  <form action="{{route('clients.orders.store',$client)}} " method="POST" >
                   @csrf
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>

                                <th> Name</th>
                                <th>stock</th>
                                <th>Sale Price</th>

                            </tr>
                        <tbody class="order-list">

                        </tbody>

                            <div> Total price
                                <h4 class="total-price">

                                </h4>
                                <button class="btn btn-primary btn-block disabled" id="add-order-form-btn">
                                    <i class="fa fa-plus"> add order</i> </button>
                            </div>

                    </table>
                  </form>

                </div>
            </div>


        </div>

    </div>
    <!--script>
        $(document).ready(function() {

            //start of add order
            $('.add-product').on('click', function(e) {

                e.preventDefault();
                var name = $(this).data('name');
                var id = $(this).data('id');
                var price = $.number($(this).data('price'), 2);
                $(this).removeClass('btn-info').addClass('btn-default disabled');


                var html =
                    `<tr>
                    <td>${name}</td>
                    <td><input type="number" name="products[${id}][quantity]" data-price="${price}" class="form-control input-sm product-quantity" min="1" value="1"></td>
                    <td class="product-price">${price}</td>
                    <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
                </tr>`;

                $('.order-list').append(html);
                calculate_total_price();
            });
            //end of add order

            $('body').on('click', '.disabled', function(e) {

                e.preventDefault();
            });
            //start of remove order
            $('body').on('click', '.remove-product-btn', function(e) {
                var id = $(this).data('id');
                e.preventDefault();
                $(this).closest('tr').remove();
                $('#product-' + id).removeClass('btn-default disabled').addClass('btn-info');
                calculate_total_price();
            }); //end of remove order

            //end of change price by quantity

            $('body').on('keyup change', '.product-quantity', function() {
                var quantity = parseInt($(this).val()); //quantity 2
                var price =parseFloat($(this).data('price').replace(/,/g,'')); //price 150

                $(this).closest('tr').find('.product-price').html($.number(quantity * price),
                    2); // new price 300
                calculate_total_price(); // total = new price + price to each product

            }); //end of change price by quantity

            // start of calculate total price
            function calculate_total_price() {

                var price = 0;
                $('.order-list .product-price').each(function(index) {
                    price += parseFloat($(this).html().replace(/,/g, ''));
                });
                $('.total-price').html($.number(price, 2));

                if (price > 0) {
                    $('#add-order-form-btn').removeClass('disabled');
                } else {
                    $('#add-order-form-btn').addClass('disabled');
                }
            }


        });
        //end of calculate price
        //
    </script -->


@endsection
