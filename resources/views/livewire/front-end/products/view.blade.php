<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border">
                        @if ($product->productImages)
                            @foreach ($product->productImages as $primg)
                                <img src="{{ asset($primg->image) }}" class="w-100" alt="Img">
                            @break
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-7 mt-3">
                <div class="product-view">
                    <h4 class="product-name">
                        {{ $product->name }}
                        <label class="label-stock bg-success">In Stock</label>
                    </h4>
                    <hr>
                    <p class="product-path">
                        Home / {{ $product->category->name }} / Product / {{ $product->name }}
                    </p>
                    <div>
                        <span class="selling-price">{{ $product->selling_price }}</span>
                        <span class="original-price">{{ $product->original_price }}</span>
                    </div>
                    <div>
                        @foreach ($product->productColors as $color)
                            <input type="radio" name="color">{{ $color->color->name }}
                        @endforeach
                    </div>
                    <div class="mt-2">
                        <div class="input-group">
                            <span class="btn btn1" wire:click="decrement()"><i class="fa fa-minus"></i></span>
                            <input type="text" wire:model='quantityval' readonly class="input-quantity" />
                            <span class="btn btn1" wire:click="increment()"><i class="fa fa-plus"></i></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <a href="" class="btn btn1"> <i class="fa fa-shopping-cart"></i> Add To Cart</a>
                        <a href="#" class="btn btn1" wire:click="addtowish({{ $product->id }})"> <i
                                class="fa fa-heart"></i> Add To Wishlist </a>
                    </div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="mt-3">
                        <h5 class="mb-0">Small Description</h5>
                        <p>
                            {{ $product->small_description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4>Description</h4>
                    </div>
                    <div class="card-body">
                        <p>
                            {{ $product->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
