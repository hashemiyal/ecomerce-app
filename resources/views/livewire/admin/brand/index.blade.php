<div>
    <div class="modal fade" id="addbrandmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a New Brand </h5>

                </div>
                <form wire:submit.prevent="createbrand()">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model.defer="name" />
                            @error('name')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Slug</label>
                            <input type="text" class="form-control" wire:model.defer="slug" />
                            @error('slug')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Status</label><br>
                            <input type="checkbox" wire:model.defer="status" />
                            @error('status')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
                        <button type="submit" class="btn btn-danger">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updatebrandmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update This Brand </h5>

                </div>
                <form wire:submit.prevent="updatebrand()">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model.defer="name" />
                            @error('name')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Slug</label>
                            <input type="text" class="form-control" wire:model.defer="slug" />
                            @error('slug')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Status</label><br>
                            <input type="checkbox" wire:model.defer="status" />
                            @error('status')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
                        <button type="submit" class="btn btn-danger">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deletebrandmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This Brand </h5>

                </div>
                <form wire:submit.prevent="destroybrand()">
                    <div class="modal-body">
                        Are you shure to Delete this brand!?..
                    </div>

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
                    <h3>Brands
                        <a href="" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal"
                            data-bs-target="#addbrandmodal">Add Brand</a>
                    </h3>
                    @if (session('status'))
                        <h4>{{ session('status') }}</h4>
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
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>{{ $brand->id }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td>{{ $brand->status == '1' ? 'hidden' : 'visible' }}</td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#updatebrandmodal"
                                            wire:click="editebrand({{ $brand->id }})">EDIT</a>
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deletebrandmodal "
                                            wire:click="deletebrand({{ $brand->id }})">DELETE</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div>
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
