<?php

use App\Livewire\CategoryComponent;
use App\Livewire\FoodComponent;
use App\Livewire\FoodFilter;
use App\Livewire\OrdersComponent;
use App\Livewire\UserComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', CategoryComponent::class);
Route::get('/foods' , FoodComponent::class);
Route::get('/user', UserComponent::class);
Route::get('/category/{category}' , FoodFilter::class)->name('foodFilter');
Route::get('/cart', UserComponent::class)->name('user.cart');
Route::get('/orders' , OrdersComponent::class);