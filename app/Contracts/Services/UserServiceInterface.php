<?php
namespace App\Contracts\Services;

interface UserServiceInterface
{
     public function index($request);
    public function store($request);
     public function delete($userId,$deletedUserId);
    public function getUserById($userId);
     public function updateUser($request);
     public function changePassword($validated);
}
