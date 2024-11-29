<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Account_HiddenController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Category_HiddenController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\News_HiddenController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SubcriberController;

Route::controller(UserController::class)->group(function () {
    Route::get('/', "index")->name('index');
    Route::get('/news/{slug}', "show")->name('show');
    Route::get('/contact_us', "contact")->name('contact_us');
    Route::get('/category/{slug}', "category_search")->name('category_search');
    Route::get('/search', "keyword_search")->name('keyword_search');
    Route::get('/search/{key}', "search")->name('search');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', "index")->name('admin_index');
    Route::get('/login', "login_view")->name('login_view');
    Route::post('/login', "login")->name('login');
});

Route::resource('/admin/account', AccountController::class);
Route::resource('/admin/hidden_account', Account_HiddenController::class);
Route::resource('/admin/category', CategoryController::class);
Route::resource('/admin/hidden_category', Category_HiddenController::class);
Route::resource('/admin/news', NewsController::class);
Route::resource('/admin/hidden_news', News_HiddenController::class);
Route::resource('/admin/contact', ContactController::class);
Route::resource('/admin/subcriber', SubcriberController::class);