@extends('adminlte::page')

@section('title')
    Your profile
@endsection

@section('content')
    @if( Auth::user()->id == $user->id)
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Order progress
                    </div>
                    <div class="panel-body">
                        @if($orders->isEmpty())
                            No order Today !
                        @else

                        @foreach($orders as $order)
                            <a href="/user-order/{{$order->id}}" class="btn btn-xs btn-primary pull-right">
                                <p><strong>Print</strong></p>
                            </a>
                            <h4>{{ $order->order_type }}</h4>
                            @if($order->order_type === 'Pick-up')
                                <h4>Pickup time : {{ $order->pickup_time }}</h4>
                            @endif
                            <p class="text-info">Order number : <strong>{{ $order->id }}</strong></p>
                            <p class="text-info">Order received : <strong>{{ $order->created_at->toDateTimeString() }}</strong></p>
                            @if($order->comments != null)
                                <p class="text-info">Order Comments : <strong>{{ $order->comments }}</strong></p>
                            @endif
                            <p class="text-info">You paid : <strong>{{ $order->price() }}</strong></p>
                            <p>{{ regex($order->items) }}</p>
                            @if($order->order_type === 'Delivery')
                                <order-progress status="{{ $order->status->name}}" initial="{{ $order->status->percent }}" order_id="{{ $order->id }}"></order-progress>
                            @endif
                            <hr>
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading">Your informations</div>
                    <div class="panel-body">
                        @include('includes.profileForm')
                        @if(! auth()->user()->isEmployee())
                            <a class="btn btn-danger pull-right" href="/erase/{{ $user->id }}">
                                Delete your account
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <past-orders></past-orders>
            </div>
        </div>
    @endif
@endsection
