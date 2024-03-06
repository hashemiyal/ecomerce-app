@extends('layouts.app')

@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
           <livewire:front-end.products.index :category="$category"/>
        </div>
    </div>
@endsection
