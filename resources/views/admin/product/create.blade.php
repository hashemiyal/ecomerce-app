@extends('layouts.admin');

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Add a New Product</h3>
            <a href="{{ url('admin/product/') }}" class="btn btn-primary btn small float-end">back</a>
        </div>
        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false">SEO Tags</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
                        type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Details</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-image-tab" data-bs-toggle="pill" data-bs-target="#pills-image"
                        type="button" role="tab" aria-controls="pills-image" aria-selected="false">Product
                        Image</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-color-tab" data-bs-toggle="pill" data-bs-target="#pills-color"
                        type="button" role="tab" aria-controls="pills-color" aria-selected="false">Product
                        Color</button>
                </li>
            </ul>
            <form method="post" enctype="multipart/form-data" action="{{ url('admin/product') }}">
                <div class="tab-content" id="pills-tabContent">

                    @csrf
                    <div class="tab-pane fade show active p-4" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        <div class="mb-3">
                            <lebel>Select Category</lebel>
                            <select class="form-control" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <lebel>Product Name</lebel>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <lebel>Product Slug</lebel>
                            <input type="text" name="slug" class="form-control">
                        </div>
                        <div class="mb-3">
                            <lebel>Select Brand</lebel>
                            <select class="form-control" name="brand">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <lebel>Small Description 50 words</lebel>
                            <textarea class="form-control" name="small_description" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <lebel>Description 100 words </lebel>
                            <textarea class="form-control" name="description" rows="4"></textarea>
                        </div>

                    </div>
                    <div class="tab-pane fade p-4" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="mb-3">
                            <lebel>Meta Title</lebel>
                            <input type="text" name="meta_title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <lebel>Meta Keyword</lebel>
                            <textarea class="form-control" name="meta_keyword" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <lebel>Meta Description </lebel>
                            <textarea class="form-control" name="meta_description" rows="4"></textarea>
                        </div>


                    </div>
                    <div class="tab-pane fade p-4" id="pills-contact" role="tabpanel"
                        aria-labelledby="pills-contact-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Original Price</label>
                                <input type="number" name="original_price" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>Selling Price</label>
                                <input type="number" name="selling_price" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label>Quantity</label>
                                <input type="number" name="quantity" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>Trending</label><br>
                                <input class="form-check-input" type="checkbox" name="trending" id="flexCheckChecked">
                            </div>
                            <div class="col-md-6">
                                <label>Status</label><br>
                                <input class="form-check-input" type="checkbox" name="status" id="flexCheckChecked">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade p-4" id="pills-image" role="tabpanel" aria-labelledby="pills-image-tab">

                        <div class="mb-3">
                            <label>Select Product Image/s</label>
                            <input type="file" name="image[]" multiple class="form-control">
                        </div>

                    </div>
                    <div class="tab-pane fade p-4" id="pills-color" role="tabpanel" aria-labelledby="pills-color-tab">
                        <div class="row">
                            @foreach ($colors as $color)
                                <div class=" col-md-2">
                                    <label>{{ $color->name }}</label>
                                    <input class="form-check-input" type="checkbox" name="colors[{{ $color->id }}]"
                                        value="{{ $color->id }}" id="flexCheckChecked"><br>
                                    <label>Quantity</label>
                                    <input type="number" name="colorquantity[{{ $color->id }}]"
                                        class="form-control">

                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div>
                    <button type="submit" class="btn btn-ms btn-primary float_start">Save</button>
                </div>
            </form>
        </div>
    </div>


@endsection
