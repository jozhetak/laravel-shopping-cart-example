@extends('layouts.master')

@section('title')
    Cart
@endsection

@section('content')
    <p>
        <a href="{{ url('shop') }}">Home</a> / Cart
    </p>
    <h1>Your Cart</h1>
    <hr>
    {{-- {{ dd(Cart::content()) }} --}}
    @if (sizeof(Cart::content()) > 0)
    <table class="table">
        <thead>
            <tr>
                <th class="table-image"></th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th class="column-spacer"></th>
                <th></th>
            </tr>
        </thead>
    <tbody>
        @foreach (Cart::content() as $item)
            <tr>
                <td class="table-image">
                    <a href="{{ url('shop', [$item->model->slug]) }}"><img src="{{ asset('img/' . $item->model->image) }}" alt="product" class="img-responsive cart-image"></a>
                </td>
                <td>
                    <a href="{{ url('shop', [$item->model->slug]) }}">{{ $item->name }} {{ regex($item->options) }}</a>
                </td>
                <td>
                    <form action="/cart/{{ $item->rowId}}" method="POST" class="side-by-side">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <select class="quantity minimal" data-id="{{ $item->rowId }}">
                            <option {{ $item->qty == 1 ? 'selected' : '' }}>1</option>
                            <option {{ $item->qty == 2 ? 'selected' : '' }}>2</option>
                            <option {{ $item->qty == 3 ? 'selected' : '' }}>3</option>
                            <option {{ $item->qty == 4 ? 'selected' : '' }}>4</option>
                            <option {{ $item->qty == 5 ? 'selected' : '' }}>5</option>
                            <option {{ $item->qty == 6 ? 'selected' : '' }}>6</option>
                        </select>
                        <input type="hidden" name="quantity" value="{{$item->qty + 1}}">
                        <input type="submit" name="submit" value="Add 1" class="btn btn-info btn-sm">
                    </form>
                    <form action="/cart/{{ $item->rowId}}" method="POST" class="side-by-side">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <input type="hidden" name="quantity" value="{{$item->qty - 1}}">
                        <input type="submit" name="submit" value="Remove 1" class="btn btn-danger btn-sm">
                    </form>
                </td>
                <td>${{ $item->subtotal /100 }}</td>
                <td class=""></td>
                <td>
                    <form action="/cart/{{ $item->rowId}}" method="POST" class="side-by-side">
                        {{ csrf_field() }}
                        {{ method_field('DELETE')}}
                        <input type="submit" class="btn btn-danger btn-sm" value="Remove">
                    </form>
                    {{-- <form action="{{ url('switchToWishlist', [$item->rowId]) }}" method="POST" class="side-by-side">
                    {!! csrf_field() !!}
                        <input type="submit" class="btn btn-success btn-sm" value="To Wishlist">
                    </form> --}}
                </td>
            </tr>
        @endforeach
            <tr>
                <td class="table-image"></td>
                <td></td>
                <td class="small-caps table-bg" style="text-align: right">Subtotal</td>
                <td>${{ Cart::subtotal() /100 }}</td>
            </tr>
            <tr>
                <td class="table-image"></td>
                <td></td>
                <td class="small-caps table-bg" style="text-align: right">Tax</td>
                <td>${{ Cart::tax() /100 }}</td>
            </tr>
            <tr class="border-bottom">
                <td class="table-image"></td>
                <td style="padding: 40px;"></td>
                <td class="small-caps table-bg" style="text-align: right">Your Total</td>
                <td class="table-bg">${{ Cart::total() /100 }}</td>
                <td class="column-spacer"></td>
            </tr>
        </tbody>
    </table>
    <div class="mb-100"></div>
        <a href="{{ url('/shop') }}" class="btn btn-primary btn-lg">Continue Shopping</a> &nbsp;
        <a href="/checkout" class="btn btn-success btn-lg">Proceed to Checkout</a>
        <div style="float:right">
            <form action="{{ url('/emptyCart') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type="submit" class="btn btn-danger btn-lg" value="Empty Cart">
            </form>
        </div>
    @else
        <h3>You have no items in your shopping cart</h3>
        <a href="{{ url('/shop') }}" class="btn btn-primary btn-lg">Continue Shopping</a>
    @endif
    <div class="mb-100"></div>
@endsection

@section('extra-js')
    @include('javascript.updateCart')
@endsection