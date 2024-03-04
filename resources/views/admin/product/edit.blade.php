@extends('layouts.admin');

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Edite this Product</h3>
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
            <form enctype="multipart/form-data" action="{{ url('admin/product/' . $product->id) }}" method="POST">
                <div class="tab-content" id="pills-tabContent">

                    @csrf
                    @method('PUT')
                    <div class="tab-pane fade show active p-4" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        <div class="mb-3">
                            <lebel>Select Category</lebel>
                            <select class="form-control" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <lebel>Product Name</lebel>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                        </div>
                        <div class="mb-3">
                            <lebel>Product Slug</lebel>
                            <input type="text" name="slug" class="form-control" value="{{ $product->slug }}">
                        </div>
                        <div class="mb-3">
                            <lebel>Select Brand</lebel>
                            <select class="form-control" name="brand">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->name }}"
                                        {{ $product->brand == $brand->name ? 'selected' : '' }}>
                                        {{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <lebel>Small Description 50 words</lebel>
                            <textarea class="form-control" name="small_description" rows="4">{{ $product->small_description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <lebel>Description 100 words </lebel>
                            <textarea class="form-control" name="description" rows="4">{{ $product->description }}</textarea>
                        </div>

                    </div>
                    <div class="tab-pane fade p-4" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="mb-3">
                            <lebel>Meta Title</lebel>
                            <input type="text" name="meta_title" class="form-control"
                                value="{{ $product->meta_title }}">
                        </div>
                        <div class="mb-3">
                            <lebel>Meta Keyword</lebel>
                            <textarea class="form-control" name="meta_keyword" rows="4">{{ $product->meta_keyword }}</textarea>
                        </div>
                        <div class="mb-3">
                            <lebel>Meta Description </lebel>
                            <textarea class="form-control" name="meta_description" rows="4">{{ $product->meta_description }}</textarea>
                        </div>


                    </div>
                    <div class="tab-pane fade p-4" id="pills-contact" role="tabpanel"
                        aria-labelledby="pills-contact-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Original Price</label>
                                <input type="number" name="original_price" class="form-control"
                                    value="{{ $product->original_price }}">
                            </div>
                            <div class="col-md-6">
                                <label>Selling Price</label>
                                <input type="number" name="selling_price" class="form-control"
                                    value="{{ $product->selling_price }}">
                            </div>
                            <div class="col-md-12">
                                <label>Quantity</label>
                                <input type="number" name="quantity" class="form-control"
                                    value="{{ $product->quantity }}">
                            </div>
                            <div class="col-md-6">
                                <label>Trending</label><br>
                                <input class="form-check-input" type="checkbox" name="trending"
                                    {{ $product->trending == '1' ? 'checked' : '' }}>
                            </div>
                            <div class="col-md-6">
                                <label>Status</label><br>
                                <input class="form-check-input" type="checkbox" name="status"
                                    {{ $product->status == '1' ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade p-4" id="pills-image" role="tabpanel" aria-labelledby="pills-image-tab">

                        <div class="mb-3">
                            <label>Select Product Image/s</label>
                            <input type="file" name="image[]" multiple class="form-control">
                        </div>
                        <div class="row">
                            @if ($product->productImages)
                                @foreach ($product->productImages as $image)
                                    <div class="col-md-2">
                                        <img class="mi-4 border" src="{{ asset($image->image) }}" width="100px"
                                            height="100px">
                                        <a href="{{ url('admin/product/' . $image->id . '/delete') }}">remove</a>
                                    </div>
                                @endforeach
                            @endif
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
                        <hr>
                        <div>
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Color</th>
                                        <th>Quantity</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->productColors as $pro_color)
                                        <tr class="product_color_tr">
                                            <td>{{ $pro_color->color->name }}</td>
                                            <td><input type="number" value="{{ $pro_color->quantity }}"
                                                    class="productcolorq form-control"></td>
                                            <td>
                                                <button type="button" value="{{ $pro_color->id }}"
                                                    class="updateproductcolor btn btn-sm btn-primary">Update</button>
                                                <button type="button" value="{{ $pro_color->id }}"
                                                    class="deleteproductcolor btn btn-sm btn-danger">Delete</button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="">
                    <button type="submit" class="btn btn-ms btn-primary float_start">Update</button>
                </div>
            </form>
        </div>
    </div>


@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".updateproductcolor").on("click", function(event) {


                $.ajax({
                    url: "/admin/productcolor/" + $(this).val(),
                    type: "POST",
                    data: {
                        quantity: $(this).closest('.product_color_tr').find('.productcolorq').val(),
                        product_id: {{ $product->id }}
                    },
                    success: function(res) {
                        console.log(res.message);
                    }
                });



            });
            $(".deleteproductcolor").on("click", function(event) {

                $(this).closest('.product_color_tr').remove();
                $.ajax({
                    url: "/admin/productcolor/" + $(this).val(),
                    type: "GET",
                    success: function(res) {
                        console.log(res.message);
                    }
                });

            });



        });
    </script>
@endsection
