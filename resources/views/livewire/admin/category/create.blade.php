<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3> Add Category
                    <a href="{{ url('admin/category') }}" class="btn btn-primary btn small float-end">back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Slug</label>
                            <input type="text" name="slug" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3 ">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="status">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Status
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Meta Title</label>

                            <input type="text" name="meta_title" class="form-control">

                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Meta Keyword</label>
                            <input type="text" name="meta_keyword" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Meta Description</label>
                            <textarea class="form-control" name="meta_description" rows="3"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary float-end">Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
