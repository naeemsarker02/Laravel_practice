<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\AuthController;

Route::get('/test', fn()=>response()->json(['message'=>'API is working']));

// Auth
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

// Protected
Route::middleware('auth:sanctum')->group(function(){

    Route::post('/logout',[AuthController::class,'logout']);

    // Categories
    Route::get('/categories',[CategoryController::class,'index']);
    Route::post('/categories',[CategoryController::class,'store']);
    Route::get('/categories/{id}',[CategoryController::class,'show']);
    Route::put('/categories/{id}',[CategoryController::class,'update']);
    Route::delete('/categories/{id}',[CategoryController::class,'destroy']);

    // Products
    Route::get('/products',[ProductController::class,'index']);
    Route::post('/products',[ProductController::class,'store']);
    Route::get('/products/{id}',[ProductController::class,'show']);
    Route::put('/products/{id}',[ProductController::class,'update']);
    Route::delete('/products/{id}',[ProductController::class,'destroy']);

    // Super Admin Posts
    Route::middleware('role:super_admin')->group(function(){
        Route::apiResource('posts',PostController::class);
    });

    
    // Comments
    Route::get('/posts/{postId}/comments',[CommentController::class,'index']);
    Route::post('/comments',[CommentController::class,'store']);
    Route::delete('/comments/{id}',[CommentController::class,'destroy']);
});
