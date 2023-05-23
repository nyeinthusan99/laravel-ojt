@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="fw-bold mt-5">Update Post</div>
                <form method="POST" action="{{ route('post.edit', ['postId' => $post->id]) }}" id="myForm">
                    @csrf
                    <div class="form-group row my-3">
                        <label for="title" class="col-md-4 col-form-label text-md-right required">Title<span
                                class="text-danger ms-2">*</span></label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="title"
                                value="{{ old('title', $post->title) }}">

                            @error('title')
                                <span class="text-danger" id="err">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row my-3">
                        <label for="description" class="col-md-4 col-form-label text-md-right required">Description<span
                                class="text-danger ms-2">*</span></label>

                        <div class="col-md-6">
                            <textarea id="description" type="text" class="form-control" name="description">{{ old('description', $post->description) }}</textarea>
                            @error('description')
                                <span class="text-danger" id="err">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row my-3">
                        <label for="" class="col-md-4 col-form-label text-md-right required">Status</label>
                        <div class="col-md-6">
                            <input type="hidden" name="status" value="0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                                    name="status" value="1" {{ $post->status == 1 ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary me-3">
                                Confirm
                            </button>
                            <button type="reset" id="reset-btn" class="btn btn-secondary"
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
