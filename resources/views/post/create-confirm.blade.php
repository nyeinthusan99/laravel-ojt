@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="fw-bold mt-5">Create Post</div>
          <form method="POST" action="{{ route('post.store') }}">
            @csrf
            <div class="form-group row my-3">
              <label for="title" class="col-md-4 col-form-label text-md-right required">Title</label>

              <div class="col-md-6">
                <input id="title" type="text" class="form-control" name="title" readonly="readonly"  value="{{ session('createPostData')['title'] }}">
            </div>
            </div>
            <div class="form-group row my-3">
              <label for="description" class="col-md-4 col-form-label text-md-right required">Description</label>

              <div class="col-md-6">
                <textarea id="description" type="text" class="form-control" name="description" readonly="readonly" value="{{ session('createPostData')['description'] }}">{{ session('createPostData')['description'] }}</textarea>
              </div>
            </div>
            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary me-3">
                    Create
                  </button>
                  <a class="btn btn-secondary" onClick="window.history.back()">
                    Cancel
                  </a>
              </div>
            </div>
          </form>
    </div>
  </div>
</div>
@endsection

