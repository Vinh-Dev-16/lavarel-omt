<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\homeController;
use App\Http\Controllers\User\commentController;


Route::prefix('/')->group(function(){
    Route::get('', [homeController::class, 'index'])->name('home');
    Route::get('detail/{id}', [homeController::class, 'detail'])->name('detail');

    Route::prefix('comment')->group(function(){
        Route::post('store', [commentController::class, 'store'])->name('comment.store');
    });

});
