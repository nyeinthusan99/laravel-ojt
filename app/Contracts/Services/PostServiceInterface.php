<?php
namespace App\Contracts\Services;

interface PostServiceInterface
{
    public function index($request);
    public function store($request);
    public function delete($postId,$deletedUserId);
    public function getPostById($postId);
    public function updatePost($request,$postId);
}
