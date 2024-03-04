@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Colors</h3>
            <a href="{{ url('admin/color/create') }}" class="btn btn-primary btn small float-end">add a color</a>
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
                        <td>ID</td>
                        <td>name</td>
                        <td>code</td>
                        <td>status</td>
                        <td>ACTIONS</td>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($colors as $color)
                        <tr>
                            <td>{{ $color->id }}</td>
                            <td>{{ $color->name }}</td>
                            <td>{{ $color->code }}</td>
                            <td>{{ $color->status == true ? 'hidden' : 'visible' }}</td>
                            <td>

                                <a href="{{ url('admin/color/' . $color->id . '/edite') }}"
                                    class="btn btn-success btn-sm">EDIT</a>

                                <a href="{{ url('admin/color/' . $color->id . '/delete') }}" class="btn btn-danger btn-sm"
                                    onclick="return confirm('ARE YOU SHUR TO DELETE THIS COLOR')">DELETE</a>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>


        </div>
    </div>
@endsection;
