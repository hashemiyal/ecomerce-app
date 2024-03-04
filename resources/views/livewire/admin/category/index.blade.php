<div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>

                </div>
                <div class="modal-body">
                    ARE YOUR SHURE WANT TO DELTE THIS CATEGORY!
                </div>
                <form wire:submit.prevent="destroycategory()">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Category
                        <a href="{{ url('admin/category/create') }}" class="btn btn-primary btn small float-end">Add
                            Category</a>
                    </h3>
                    @if (session('success'))
                        <h4>{{ session('success') }}</h4>
                    @endif

                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>NAME</td>
                                <td>STATUS</td>
                                <td>ACTIONS</td>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->status == '1' ? 'hidden' : 'visible' }}</td>
                                    <td>
                                        <a href="{{ url('admin/category/' . $category->id . '/edite') }}"
                                            class="btn btn-success btn-small">EDIT</a>
                                        <a href="#" wire:click.prevent="deletecategory({{ $category->id }})"
                                            class="btn btn-danger btn-small" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal">DELETE</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
