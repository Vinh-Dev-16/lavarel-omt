<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\homeController;



Route::prefix('/')->group(function(){
    Route::get('', [homeController::class, 'index'])->name('home');
});
