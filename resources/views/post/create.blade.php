@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="fw-bold mt-5">Create Post</div>
                <form method="POST" action="{{ route('post.create') }}" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row my-3">
                        <label for="title" class="col-md-4 col-form-label text-md-right required">Title<span
                                class="text-danger ms-2">*</span></label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="title"
                                value="{{ old('title') }}">
                            @error('title')
                                <span class="text-danger" id="err">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row my-3">
                        <label for="description" class="col-md-4 col-form-label text-md-right required">Description<span
                                class="text-danger ms-2">*</span></label>

                        <div class="col-md-6">
                            <textarea id="description" type="text" class="form-control" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger" id="err">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary me-3">
                                Confirm
                            </button>
                            <button type="reset" class="btn btn-secondary" id=""
                                onclick="document.getElementById('myForm').reset();
                                    document.getElementById('title').value = null;
                                    document.getElementById('description').value = null;
                                    return false;">
                                Clear
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
