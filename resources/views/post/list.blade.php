@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row d-flex">
            <form action="{{ route('postlist') }}" method="GET" class="col-md-6 d-flex">
                @csrf
                <div class="col-md-8 me-2">
                    <input type="text" value="{{ request('searchItem') }}" placeholder="Search title, description or created user" class="form-control" name="searchItem" id="searchitem">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary form-control"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
                </div>
            </form>
            <div class="col-md-2">
                <a href="{{ route('post.create')}}" class="btn btn-primary form-control"><i class="fa-solid fa-circle-plus"></i> Create Post</a>
            </div>
            <div class="col-md-2">
                <a href="{{ route('post.upload')}}" class="btn btn-primary form-control"><i class="fa-sharp fa-solid fa-upload"></i> Upload</a></div>
            <form action="{{ route('post.export') }}" method="post" class="col-2">
                @csrf
                <button class="btn btn-primary form-control" {{ $posts->isEmpty() ? 'disabled' : '' }}><i class="fa-solid fa-download"></i> Download</button>
            </form>
        </div>
        <table class="table table-bordered m-auto w-75 mt-5" id="mytable" >
            <thead>
                <tr class="text-center">
                    <th scope="col">Post Title</th>
                    <th scope="col">Post Description</th>
                    <th scope="col">Posted User</th>
                    <th scope="col">Posted Date</th>
                    <th scope="col" colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($posts) == 0)
                    <tr>
                        <td colspan="6" class="text-center">There is no posts</td>
                    </tr>
                @endif

                @foreach ( $posts as $post )
                    <tr>
                        <td scope="row">
                            <a href="" data-bs-toggle="modal" data-bs-target="#detail{{ $post->id }}">
                                {{ $post->title }}
                            </a>
                        </td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->created_user}}</td>
                        <td>{{ date('Y/m/d', strtotime($post->created_at)) }}</td>
                        <td>
                            <a href="/post/update/{{ $post->id }}" class="btn btn-warning btn-sm form-control"><i class="fa-sharp fa-solid fa-pen-to-square"></i> Edit</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm form-control" data-bs-toggle="modal" data-bs-target="#Delete{{$post->id}}"><i class="fa-solid fa-trash"></i> Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

         <!-- Pagination links -->
        {{ $posts->links() }}


        <!-- Detail Modal -->
        @foreach ( $posts as $post )
        <div class="modal fade" id="detail{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Post Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row mb-2">
                            <label class="col-md-4">Title</label>
                            <label class="col-md-8">{{ $post->title }}</label>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Description</label>
                            <label class="col-md-8">{{ $post->description }}</label>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Status</label>
                            @if ( $post->status == 1)
                                <label class="col-md-8">Active</label>
                            @else
                                <label class="col-md-8">Not Active</label>
                            @endif
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Created_at</label>
                            <label class="col-md-8">{{ date('Y/m/d', strtotime($post->created_at)) }}</label>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Created_user</label>
                            <label class="col-md-8">{{ $post->created_user }}</label>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Updated_at</label>
                            <label class="col-md-8">{{ date('Y/m/d', strtotime($post->updated_at)) }}</label>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Updated_user</label>
                            <label class="col-md-8">{{ $post->updated_user }}</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
        @endforeach

        <!-- Delete Modal -->
        @foreach ( $posts as $post )
        <div class="modal fade" id="Delete{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="">Are you sure to delete?</h4>
                    <div class="col-md-12">
                        <div class="row mb-2">
                            <label class="col-md-4">ID</label>
                            <label class="col-md-8">{{ $post->id }}</label>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Title</label>
                            <label class="col-md-8">{{ $post->title }}</label>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Description</label>
                            <label class="col-md-8">{{ $post->description }}</label>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Status</label>
                            @if ( $post->status == 1)
                                <label class="col-md-8">Active</label>
                            @else
                                <label class="col-md-8">Not Active</label>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="/post/delete/{{ $post->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button  class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
        @endforeach

    </div>
@endsection
