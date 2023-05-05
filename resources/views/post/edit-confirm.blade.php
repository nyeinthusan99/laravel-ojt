@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="fw-bold mt-5">Edit aa Post</div>
          <form method="POST"  action="{{ route('postUpdate.store',['postId'=>$postId]) }}" >
            @csrf
            <div class="form-group row my-3">
              <label for="title" class="col-md-4 col-form-label text-md-right required">Title</label>

              <div class="col-md-6">
                <input id="title" type="text" class="form-control" name="title" readonly="readonly"  value="{{ session('editPostData')['title'] }}">
              </div>
            </div>
            <div class="form-group row my-3">
              <label for="description" class="col-md-4 col-form-label text-md-right required">Description</label>

              <div class="col-md-6">
                <textarea id="description" type="text" class="form-control" name="description" readonly="readonly" value="{{ session('editPostData')['description'] }}">{{ session('editPostData')['description'] }}</textarea>
              </div>
            </div>
            <div class="form-group row my-3">
                <label for="" class="col-md-4 col-form-label text-md-right required">Status</label>
                <div class="col-md-6">
                    <div class="form-check form-switch">
                        <input type="hidden" name="status" value="{{ session('editPostData')['status']}}">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="status" value="1" {{ session('editPostData')['status'] == 1 ? 'checked' : '' }} disabled>
                    </div>
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


