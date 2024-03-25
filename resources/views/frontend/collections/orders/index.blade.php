@extends('layouts.app')

@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="card">
            <div class="card-header">
                <h3>My Orders</h3>
                
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
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td>ORDER ID</td>
                            <td>TRACKING NO</td>
                            <td>USER NAME</td>
                            <td>PAYMENT MODE</td>
                            <td>ORDERED DATE</td>
                            <td>STATUS MESSAGE</td>
                            <td>ACTION</td>
                        </tr>
        
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->tracking_no }}</td>
                                <td>{{ $order->fullname }}</td>
                                <td>{{ $order->payment_mode }}</td>
                                <td>{{ $order->created_at}}</td>
                                <td>{{ $order->status_msg }}</td>
                                
                                <td>
        
                                    <a href="{{ url('orders/' . $order->id) }}"
                                        class="btn btn-success btn-sm">view</a>
        
        
                                </td>
                            </tr>
                        @endforeach
        
                    </tbody>
                </table>
        
              {{$orders->links()}}
            </div>
        </div>
        
    </div>
@endsection
