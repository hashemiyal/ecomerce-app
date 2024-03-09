<div class="row">
  <div class="col-md-12">
      <div class="shopping-cart">
            <div class="card-header"><strong>My WishLists</strong></div>
            @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
             @endif
            <div class="card-header"><strong></strong></div>
          <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
              <div class="row">
                  <div class="col-md-6">
                      <h4>Products</h4>
                  </div>
                  <div class="col-md-2">
                      <h4>Price</h4>
                  </div>
               
                  <div class="col-md-2">
                      <h4>Remove</h4>
                  </div>
              </div>
          </div>
           @foreach ($wishlists as $wishlist)
           <div class="cart-item">
            <div class="row">
                <div class="col-md-6 my-auto">
                    <a href="{{url('collections/'.$wishlist->product->category->slug.'/'.$wishlist->product->slug)}}">
                        <label class="product-name">
                            @foreach($wishlist->product->productImages as $img)
                            <img src="{{url($img->image)}}" style="width: 50px; height: 50px" alt="">
                            @break
                            @endforeach
                            {{$wishlist->product->name}}
                        </label>
                    </a>
                </div>
                <div class="col-md-2 my-auto">
                    <label class="price">{{$wishlist->product->selling_price}} </label>
                </div>
       
                <div class="col-md-2 col-5 my-auto">
                    <div class="remove">
                        <a href="#" class="btn btn-danger btn-sm" wire:click="removewishlist({{$wishlist->id}})">
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

</div>
</div>
