@extends('layouts.app')

@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
          {{-- we have each product --}}
         <livewire:front-end.products.view :product="$product"/>
        </div>
    </div>
@endsection
