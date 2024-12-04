<?php

use App\Livewire\CategoryComponent;
use App\Livewire\FoodComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', CategoryComponent::class);
Route::get('/foods' , FoodComponent::class);
