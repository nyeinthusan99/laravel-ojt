<?php

namespace App\Contracts\Dao;

use Illuminate\Http\Request;

interface PostDaoInterface
{
    public function index($request);
    public function store(Request $request);
    public function delete($postId,$deletedUserId);
    public function getPostById($postId);
    public function updatePost($request,$postId);
}
