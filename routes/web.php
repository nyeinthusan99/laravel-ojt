<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function() {
    return to_route('login');
});

Route::get('/user/login',[AuthController::class,'login'])->name('login');
Route::post('/signIn',[AuthController::class,'signIn'])->name('signIn');
Route::post('user/logout', [AuthController::class,'logout'])->name('logout');

Route::get('/posts',[PostController::class,'index'])->name('postlist');
Route::get('/post/create',[PostController::class,'createView'])->name('post.create');
Route::post('/post/create',[PostController::class,'createSubmit'])->name('post.create');
Route::get('/post/confirm',[PostController::class,'confirmView'])->name('postCreate.confirm');
Route::post('/post/store',[PostController::class,'store'])->name('post.store');
Route::delete('/post/delete/{postId}',[PostController::class,'delete']);
Route::get('/post/update/{postId}',[PostController::class,'editView'])->name('post.edit');
Route::post('/post/update/{postId}',[PostController::class,'editSubmit'])->name('post.edit');
Route::get('/post/update/{postId}/confirm',[PostController::class,'editConfirmView'])->name('postUpdate.confirm');
Route::post('/post/update/{postId}/store',[PostController::class,'editStore'])->name('postUpdate.store');
Route::get('/post/import',[PostController::class,'uploadView'])->name('post.upload');
Route::post('/post/import',[PostController::class,'uploadSubmit'])->name('postUpload.store');
Route::post('/post/export',[PostController::class,'export'])->name('post.export');


Route::get('/users',[UserController::class,'index'])->name('userlist');
Route::get('/user/create',[UserController::class,'createView'])->name('user.create');
Route::post('/user/create',[UserController::class,'createSubmit'])->name('user.create');
Route::get('/user/confirm',[UserController::class,'confirmView'])->name('userCreate.confirm');
Route::post('/user/store',[UserController::class,'store'])->name('user.store');
Route::delete('/user/delete/{userId}',[UserController::class,'delete']);

Route::get('/user/profile',[UserController::class,'showProfile'])->name('user.profile');


Route::get('/user/profile/update',[UserController::class,'editProfileView'])->name('userProfile.edit');
Route::post('/user/profile/update',[UserController::class,'editProfileSubmit'])->name('userProfile.edit');
Route::get('/user/profile/update/confirm',[UserController::class,'editProfileConfirmView'])->name('userProfileUpdate.confirm');
Route::post('/user/profile/update/store',[UserController::class,'editProfileStore'])->name('userProfileUpdate.store');
