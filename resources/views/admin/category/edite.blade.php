@extends('layouts.admin');

@section('content')

<div class="row">
  <div class="col-md-12">
     <div class="card">
      <div class="card-header">
        <h3> Edite Category
          <a href="{{ url('admin/category')}}" class="btn btn-primary btn small float-end">back</a>
        </h3>
      </div>
      <div class="card-body">
       <form action="{{url('admin/category/'.$category->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('put')
        <div class="row">
          <div class="col-md-6 mb-3">
          <label>Name</label>
          <input type="text" name="name" class="form-control" value="{{$category->name}}">
          </div>
          <div class="col-md-6 mb-3">
              <label>Slug</label>
              <input type="text" name="slug" class="form-control" value="{{$category->slug}}">
              </div>
              <div class="col-md-12 mb-3">
                  <label>Description</label>
                  <textarea class="form-control" name="description" rows="3">{{$category->description}}</textarea>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label>Image</label>
                      <input type="file" name="image" class="form-control">
                      <image src="{{asset('uploads/category/'.$category->image)}}" width="100px" height="100px">
                      </div>
                      <div class="col-md-6 mb-3 ">
                          <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="status" {{$category->status=='1'?'checked':''}}>
                              <label class="form-check-label" for="flexCheckDefault">
                                Status
                              </label>
                            </div>
                          </div>
                          <div class="col-md-12 mb-3">
                              <label>Meta Title</label>
                              
                                  <input type="text" name="meta_title" class="form-control" value="{{$category->meta_title}}">
                                  
                              </div>
                              <div class="col-md-12 mb-3">
                                  <label>Meta Keyword</label>
                                  <input type="text" name="meta_keyword" class="form-control" value="{{$category->meta_keyword}}"> 
                                  </div>
                                  <div class="col-md-12 mb-3">
                                      <label>Meta Description</label>
                                      <textarea class="form-control" name="meta_description" rows="3">{{$category->meta_description}}</textarea>
                                      </div>
                                      <div class="col-md-12 mb-3">
                                          <button type="submit" class="btn btn-primary float-end">Update</button>
                                          </div>
        </div>

       </form>
      </div>
     </div>
  </div>

</div>

@endsection