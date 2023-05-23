<?php

namespace App\Dao;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Dao\PostDaoInterface;

class PostDao implements PostDaoInterface
{
    public function index($request)
    {
        $search = $request->input('searchItem');
        $user = Auth::user();

        $posts = DB::table('posts')
            ->select('posts.*', 'created_user.name as created_user', 'updated_user.name as updated_user')
            ->join('users as created_user', 'created_user.id', '=', 'posts.created_user_id')
            ->join('users as updated_user', 'updated_user.id', '=', 'posts.updated_user_id')
            ->whereNull('posts.deleted_at')
            ->where(function ($query) use ($search) {
                $query->where('posts.title', 'like', '%' . $search . '%')
                    ->orWhere('posts.description', 'like', '%' . $search . '%')
                    ->orWhere('created_user.name', 'like', '%' . $search . '%');
            })
            ->when($user->type != '0', function ($query) use ($user) {
                $query->where('posts.created_user_id', '=', $user->id);
            })
            ->orderByDesc('posts.created_at')
            ->paginate(2)
            ->withQueryString();

        return $posts;
    }


    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request['title'];
        $post->description = $request['description'];
        $post->created_user_id = Auth::user()->id;
        $post->updated_user_id = Auth::user()->id;
        $post->save();
        return $post;
    }

    public function delete($postId, $deletedUserId)
    {
        $post = Post::where('id', $postId)->first();
        if ($post && !$post->deleted_user_id) {
            $post->deleted_user_id = $deletedUserId;
            $post->update();
            $post->delete();
        }

        return $post;
    }

    public function getPostById($postId)
    {
        $post = Post::where('id', $postId)->first();
        return $post;
    }

    public function updatePost($request, $postId)
    {
        $post = Post::find($postId);
        $post->title = $request['title'];
        $post->description = $request['description'];
        $post->status = $request['status'];
        $post->updated_user_id = Auth::user()->id;
        $post->save();
        return $post;
    }
}
