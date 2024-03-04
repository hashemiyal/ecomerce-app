@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Sliders hooray</h3>
            <a href="{{ url('admin/slider/create') }}" class="btn btn-primary btn small float-end">add a slider</a>
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
                        <td>Title</td>
                        <td>Image</td>
                        <td>Description</td>
                        <td>status</td>
                        <td>ACTIONS</td>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($sliders as $slider)
                        <tr>
                            <td>{{ $slider->id }}</td>
                            <td>{{ $slider->title }}</td>
                            <td>
                                <img src="{{ asset($slider->image) }}" alt="slier">
                            </td>
                            <td>{{ $slider->description }}</td>
                            <td>{{ $slider->status == true ? 'hidden' : 'visible' }}</td>
                            <td>

                                <a href="{{ url('admin/slider/'.$slider->id.'/edite') }}" class="btn btn-success btn-sm">EDIT</a>

                                <a href="{{ url('admin/slider/'.$slider->id.'/delete') }}" class="btn btn-danger btn-sm" onclick="return confirm('ARE YOU SHURE TO DLETE THIS SLIDER!')">DELETE</a>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>


        </div>
    </div>
@endsection
