<?php

use App\Http\Controllers\Admin\roleController;
use App\Http\Controllers\Admin\dashboardController;
use App\Http\Controllers\Admin\postController;
use App\Http\Controllers\Admin\categoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'checkRoleAuth'] ], function () {
    Route::get('/dashboard', function () {
        return view('admin/dashboard');
    });
    Route::group(['prefix' => 'user'] , function () {
        Route::get('index',[dashboardController::class,'index'])->name('admin.user.index');
    });

//    Router Role

    Route::group(['prefix' => 'role'], function () {
        Route::get('index',[roleController::class,'index'])->name('admin.role.index');
        Route::get('create',[roleController::class,'create'])->name('admin.role.create');
        Route::post('store',[roleController::class,'store'])->name('admin.role.store');
        Route::get('edit/{id}',[roleController::class,'edit'])->name('admin.permission.edit');
        Route::patch('update/{id}',[roleController::class,'update'])->name('admin.role.update');
        Route::get('destroy/{id}',[roleController::class,'destroy'])->name('admin.role.destroy');

    });


    Route::group(['prefix' => 'post'], function () {
        Route::get('index', [postController::class , 'index'])->name('admin.post.index');
        Route::get('restore', [postController::class , 'restore'])->name('admin.post.restore');
        Route::get('start-restore/{id}', [postController::class , 'startRestore'])->name('admin.post.startRestore');
        Route::get('create',[postController::class,'create'])->name('admin.post.create');
        Route::post('store',[postController::class,'store'])->name('admin.post.store');
        Route::get('edit/{id}',[postController::class,'edit'])->name('admin.post.edit');
        Route::patch('update/{id}',[postController::class,'update'])->name('admin.post.update');
        Route::get('destroy/{id}',[postController::class,'destroy'])->name('admin.post.destroy');
        Route::get('delete/{id}',[postController::class,'delete'])->name('admin.post.delete');

    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('index', [categoryController::class , 'index'])->name('admin.category.index');
        Route::get('create',[categoryController::class,'create'])->name('admin.category.create');
        Route::post('store',[categoryController::class,'store'])->name('admin.category.store');
        Route::get('edit/{id}',[categoryController::class,'edit'])->name('admin.category.edit');
        Route::patch('update/{id}',[categoryController::class,'update'])->name('admin.category.update');
        Route::get('destroy/{id}',[categoryController::class,'destroy'])->name('admin.category.destroy');
    });

});
