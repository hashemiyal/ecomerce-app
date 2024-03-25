<div class="card">
    <div class="card-header">
        <h3>Products</h3>
        <a href="{{ url('admin/product/create') }}" class="btn btn-primary btn small float-end">add a product</a>
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
                    <td>CATEGORY</td>
                    <td>Brand</td>
                    <td>PRODUCT</td>
                    <td>QUANTITY</td>
                    <td>PRICE</td>
                    <td>STATUS</td>
                    <td>ACTIONS</td>
                </tr>

            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        @if($product->category)
                        <td>{{ $product->category->name }}</td>
                        @endif
                        <td>{{ $product->brand }}</td>
                       
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->selling_price }}</td>
                        <td>{{ $product->status == '1' ? 'hidden' : 'visible' }}</td>
                        <td>

                            <a href="{{ url('admin/product/' . $product->id . '/edite') }}"
                                class="btn btn-success btn-sm">EDIT</a>

                            <a href="#" wire:click.prevent="delete({{ $product->id }})"
                                class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal">DELETE</a>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>

                    </div>
                    <div class="modal-body">
                        ARE YOUR SHURE WANT TO DELTE THIS PRODUCT!
                    </div>
                    <form wire:submit.prevent="destroyproduct()">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
