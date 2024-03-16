<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <h2>My Cart Items</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="shopping-cart">

                    <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                        <div class="row">
                            <div class="col-md-5">
                                <h4>Products</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Price</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Quantity</h4>
                            </div>
                            <div class="col-md-1">
                                <h4>Total Price</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Remove</h4>
                            </div>
                        </div>
                    </div>
                    @foreach ($carts as $cart)
                        <div class="cart-item">
                            <div class="row">
                                <div class="col-md-5 my-auto">
                                    <a href="">
                                        <label class="product-name">
                                            @if ($cart->product->productImages)
                                             @foreach($cart->product->productImages as $image)
                                                <img src="{{ $image->image }}"
                                                    style="width: 50px; height: 50px" alt="">
                                                    @break
                                                    @endforeach
                                            @endif
                                            {{ $cart->product->name }}
                                        </label>
                                    </a>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label class="price"> $ {{ $cart->product->selling_price }} </label>
                                </div>
                                <div class="col-md-2 col-7 my-auto">
                                    <div class="quantity">
                                        <div class="input-group">
                                            <span class="btn btn1" wire:click="decrement({{$cart->id}})"><i class="fa fa-minus"></i></span>
                                            <input type="text" readonly value="{{ $cart->quantity }}"
                                                class="input-quantity" />

                                            <span class="btn btn1" wire:click="increment({{$cart->id}})"><i class="fa fa-plus"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 my-auto">
                                    <label class="price">{{ $cart->product->selling_price*$cart->quantity }} </label>
                                    @php $total_price+=$cart->product->selling_price*$cart->quantity;
                                        
                                    @endphp
                                </div>
                                <div class="col-md-2 col-5 my-auto">
                                    <div class="remove">
                                        <a href="#" wire:click="removecart({{$cart->id}})" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Remove
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mt-5">
            <h5>Get best price and items!  <a href="collections">shop now</a></h5>
           
            </div>
            <div class="col-md-4 mt-5">
                <div class="card-header">
                  Total :${{' '.$total_price}}
                </div>
                <div class="card-body">
                 <a href="/checkout" class="btn btn-warning w-100">checkout</a>
                </div>
            </div>
        </div>

    </div>
</div>
