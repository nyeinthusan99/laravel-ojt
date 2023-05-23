<?php

namespace App\Http\Controllers;

use App\Imports\PostsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\PostEditRequest;
use App\Http\Requests\PostCreateRquest;
use App\Http\Requests\PostImportRequest;
use App\Contracts\Services\PostServiceInterface;
use App\Exports\PostsExport;
use Maatwebsite\Excel\Validators\ValidationException;

class PostController extends Controller
{

    private $postService;
    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $posts = $this->postService->index($request);
        return view('post.list', ['posts' => $posts]);
    }

    public function createView()
    {
        return view('post.create');
    }

    public function createSubmit(PostCreateRquest $request)
    {
        $request->validated();

        session(['createPostData' => array_merge($request->safe()->only(['title', 'description']))]);
        return to_route('postCreate.confirm');
    }

    public function confirmView()
    {
        if (!session('createPostData')) {
            return redirect()->route('post.create');
        }

        return view('post.create-confirm');
    }

    public function store(Request $request)
    {
        $this->postService->store($request);
        return redirect()->route('postlist');
    }

    public function delete($postId)
    {
        $deletedUserId = Auth::user()->id;
        $this->postService->delete($postId, $deletedUserId);
        return redirect()->route('postlist');
    }

    public function editView($postId)
    {
        $post = $this->postService->getPostbyId($postId);
        return view('post.edit', ['post' => $post]);
    }

    public function editSubmit(PostEditRequest $request, $postId)
    {
        $request->validated();
        session(['editPostData' => $request->all()]);
        return to_route('postUpdate.confirm', [$postId]);
    }

    public function editConfirmView($postId)
    {
        if (!session('editPostData')) {
            return redirect()->route('post.edit');
        }

        return view('post.edit-confirm', ['postId' => $postId]);
    }

    public function editStore(Request $request, $postId)
    {
        $this->postService->updatePost($request, $postId);
        return redirect()->route('postlist');
    }

    public function uploadView()
    {
        return view('post.upload');
    }

    public function uploadSubmit(PostImportRequest $request)
    {

        $request->validated();

        try {
            Excel::import(new PostsImport, $request->file('csvFile'));
            return redirect()->route('postlist');
        } catch (ValidationException $e) {
            $failures = $e->failures();

            $errorMessages = [];
            foreach ($failures as $failure) {
                $row = $failure->row();
                $attribute = $failure->attribute();
                $errorMessages[] = "Validation failed on row $row: $attribute " . implode(", ", $failure->errors());
            }

            return redirect()->back()->withInput()->with('errorMessages', $errorMessages);
        }
    }

    public function export(Request $request)
    {
        $posts = $this->postService->index($request);
        return Excel::download(new PostsExport($posts), 'post.xlsx');
    }
}
