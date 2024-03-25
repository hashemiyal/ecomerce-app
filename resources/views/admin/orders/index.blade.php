@extends('layouts.admin')

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
                <form action="">
                    <div class="row">
                        <div class="col-md-4">
                         <label>Filter By Date</label>
                         <input type="date" name="date" value="{{ Request::get('date') ?? date('Y-m-d') }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Filter By Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select Status</option>
                                <option value="completed" {{ Request::get('status')=='completed'? 'selected': ''}}>Completed</option>
                                <option value="in progress" {{ Request::get('status')=='in progress'? 'selected': ''}}>In Progress</option>
                                <option value="pending" {{ Request::get('status')=='pending'? 'selected': ''}}>Pending</option>
                                <option value="out of delivery" {{ Request::get('status')=='out of delivery'? 'selected': ''}}>Out of Delivery</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                         <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
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
        
                                    <a href="{{ url('admin/orders/' . $order->id) }}"
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
