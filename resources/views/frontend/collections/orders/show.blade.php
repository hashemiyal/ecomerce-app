@extends('layouts.app')

@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="card">
            <div class="card-header">
                <h3>My Order Details</h3>
                <a href="/orders" class="btn btn-sm btn-warning float-end">Back</a>
            </div>
            <div class="card-body">
                @if (session('status'))
                    {{ session('status') }}
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                @endif
                <div class="row">
                    <div class="col-md-6">
                     <h6>Order Details :</h6>
                     <HR></HR>
                     <h5>Order id :{{$order->id}}</h5>
                     <h5>Tracking no :{{$order->tracking_no}}</h5>
                     <h5>Order Date :{{$order->created_at->format('y-m-d')}}</h5>
                     <h5>Payment MODE :{{$order->payment_mode}}</h5>
                     <h5>STATUS MESSAGE :{{$order->status_msg}}</h5>
                    </div>
                    <div class="col-md-6">
                    <h6>User Details</h6>
                     <HR></HR>
                     <h5>User name :{{$order->user_id}}</h5>
                     <h5>User email :{{$order->email}}</h5>
                     <h5>phone :{{$order->phone}}</h5>
                     <h5>address :{{$order->address}}</h5>
                     <h5>pincode :{{$order->pincode}}</h5>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Item ID</td>
                                <td>Image</td>
                                <td>Product</td>
                                <td>Price</td>
                                <td>Quantity</td>
                                <td class="fw-bold">Total</td>
                            </tr>
            
                        </thead>
                        <tbody>
                           
                            @php
                               $total_price=0   
                            @endphp
                            @foreach ($order->orderItems as $orderitem)
                                <tr>
                                    <td>{{ $orderitem->id }}</td>
                                    <td>
                                        @if ($orderitem->product->productImages)
                                        @foreach($orderitem->product->productImages as $image)
                                           <img src="{{ asset($image->image )}}"
                                               style="width: 50px; height: 50px" alt="">
                                               @break
                                               @endforeach
                                       @endif
                                    </td>
                                    <td>{{ $orderitem->product->name }}</td>
                                    <td>{{ $orderitem->price }}</td>
                                    <td>{{ $orderitem->quantity}}</td>
                                    <td class="fw-bold">$ {{ $orderitem->quantity*$orderitem->price}}</td>

                                </tr>
                                @php
                                $total_price+=$orderitem->quantity*$orderitem->price
                             @endphp
                            @endforeach
                          <tr>
                            <th colspan="5" class="fw-bold">Total Amout</th>
                            <th colspan="1">$ {{$total_price}}</th>
                          </tr>
                        </tbody>
                    </table>
                </div>
             
            
            </div>
        </div>
        
    </div>
@endsection
