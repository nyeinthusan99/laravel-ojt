<?php

namespace App\Services;
use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\UserServiceInterface;

class UserService implements UserServiceInterface
{
    private $userDao;
    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }

    public function index($request)
    {
        return $this->userDao->index($request);
    }

    public function delete($userId,$deletedUserId)
    {
        return $this->userDao->delete($userId,$deletedUserId);
    }

    public function getUserById($userId)
    {
        return $this->userDao->getUserById($userId);
    }

    public function store($request)
    {
        return $this->userDao->store($request);
    }

    public function updateUser($request)
    {
        return $this->userDao->updateUser($request);
    }

    public function changePassword($validated)
    {
        return $this->userDao->changePassword($validated);
    }
}
