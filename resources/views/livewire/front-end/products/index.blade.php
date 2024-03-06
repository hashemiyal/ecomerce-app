<div>
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-4">Our Products</h4>
        </div>
        
      <div class="col-md-3">
      <div class="card">
        <div class="card-header">
         Brands
        </div>
        <div class="card-body">
          @foreach($category->brands as $brand)
          <label>{{$brand->name}}</label>
          <input type="checkbox" wire:model="brandinput" value="{{$brand->name}}"/><br>
          @endforeach
        </div>
      </div>
      <div class="card mt-4">
        <div class="card-header">
         Price
        </div>
        <div class="card-body">
          
          <label>High to Low</label>
          <input type="radio" wire:model="priceinput" value="high-to-low"/><br>
          <label>Low to High</label>
          <input type="radio" wire:model="priceinput" value="low-to-high"/><br>
        </div>
      </div>
      </div>
    
       <div class="col-md-9">
      
            <div class="row">
                @foreach ($products as $product)
                <div class="col-md-3">
                    <div class="product-card">
                        <div class="product-card-img">
                            @if ($product->quantity > 0)
                                <label class="stock bg-success">In Stock</label>
                            @else
                                <label class="stock bg-success">Out of Stock</label>
                            @endif
                            <a href="{{ url('collections/' . $product->category->slug . '/' . $product->slug) }}">
                                @if($product->productImages)
                                @foreach($product->productImages as $image)
                                <img src="{{ asset($image->image) }}" alt="">
                                @break
                                @endforeach
                                @endif    
                            </a>
                        </div>
                        <div class="product-card-body">
                            <p class="product-brand">{{ $product->brand }}</p>
                            <h5 class="product-name">
                                <a href="{{ url('collections/' . $product->category->slug . '/' . $product->slug) }}">
                                    {{ $product->name }}
                                </a>
                            </h5>
                            <div>
                                <span class="selling-price">{{ $product->selling_price }}</span>
                                <span class="original-price">{{ $product->original_price }}</span>
                            </div>
    
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
           
      

       </div>

    </div>
</div>
