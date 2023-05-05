<?php

namespace App\Services;
use App\Contracts\Dao\PostDaoInterface;
use App\Contracts\Services\PostServiceInterface;

class PostService implements PostServiceInterface {

    private $postDao;
    public function __construct(PostDaoInterface $postDao)
    {
        $this->postDao = $postDao;
    }

    public function index($request)
    {
        return $this->postDao->index($request);
    }

    public function store($request)
    {
        return $this->postDao->store($request);
    }

    public function delete($postId,$deletedUserId)
    {
        return $this->postDao->delete($postId,$deletedUserId);
    }

    public function getPostById($postId)
    {
        return $this->postDao->getPostById($postId);
    }

    public function updatePost($request,$postId)
    {
        return $this->postDao->updatePost($request,$postId);
    }

}
