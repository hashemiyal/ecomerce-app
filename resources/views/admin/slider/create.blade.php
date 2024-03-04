@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>add a new slider</h3>
            <a href="{{ url('admin/slider') }}" class="btn btn-primary btn small float-end">back</a>
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
            <form action="{{ url('admin/slider') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label>slider title </label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="mb-3">
                    <label>slider Description </label>
                    <textarea class="form-control" name="description" rows="5"></textarea>
                </div>
                 <div class="mb-3">
                    <label>slider image </label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="mb-3">
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="status"><br>
                    <label class="form-check-label" for="flexCheckDefault">
                        Status
                    </label>

                </div>
                <div class="mb-3">

                    <button type="submit" class="btn btn-sm btn-primary">Insert</button>
                </div>
            </form>


        </div>
    </div>
@endsection;
