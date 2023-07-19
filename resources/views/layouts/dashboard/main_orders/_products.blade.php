@section('products')
<table class="table table-hover">
    <thead class="table-dark">
        <tr>

            <td> Name</td>
            <td> Quantity</td>
            <td> Price </td>

        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
            <tr>
                <td>{{-- $product->name --}}</td>
                <td>{{--$product->pivot->quantity--}}</td>
                <td>{{--number_format($product->pivot->quantity * $product->sale_price,2)--}}</td>
            </tr>

            @empty
        @endforelse
    </tbody>


</table>
@endsection
