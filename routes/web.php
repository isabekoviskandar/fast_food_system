<?php

use App\Livewire\CategoryComponent;
use App\Livewire\FoodComponent;
use App\Livewire\FoodFilter;
use App\Livewire\UserComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', CategoryComponent::class);
Route::get('/foods' , FoodComponent::class);
Route::get('/user', UserComponent::class);
Route::get('/category/{category}' , FoodFilter::class)->name('foodFilter');
