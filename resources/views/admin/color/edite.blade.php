@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>add a new color</h3>
            <a href="{{ url('admin/color') }}" class="btn btn-primary btn small float-end">back</a>
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
            <form action="{{ url('admin/color/' . $color->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Color Name </label>
                    <input type="text" name="name" value="{{ $color->name }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Color Code </label>
                    <input type="text" name="code" value="{{ $color->code }}"class="form-control">
                </div>
                <div class="mb-3">
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="status"
                        {{ $color->status == 1 ? 'checked' : '' }}><br>
                    <label class="form-check-label" for="flexCheckDefault">
                        Status
                    </label>

                </div>
                <div class="mb-3">

                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </div>
            </form>


        </div>
    </div>
@endsection;
