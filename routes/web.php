<?php

use App\Livewire\AuthComponent;
use App\Livewire\BolimComponent;
use App\Livewire\CategoryComponent;
use App\Livewire\DeliveryComponent;
use App\Livewire\FoodComponent;
use App\Livewire\FoodFilter;
use App\Livewire\HodimComponent;
use App\Livewire\JurnalComponent;
use App\Livewire\OrdersComponent;
use App\Livewire\UserComponent;
use App\Livewire\UsersComponent;
use App\Livewire\WaiterComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', AuthComponent::class);
Route::get('/category', CategoryComponent::class);
Route::get('/foods' , FoodComponent::class);
Route::get('/user', UserComponent::class);
Route::get('/category/{category}' , FoodFilter::class)->name('foodFilter');
Route::get('/cart', UserComponent::class)->name('user.cart');
Route::get('/orders' , OrdersComponent::class);
Route::get('/bolim' , BolimComponent::class);
Route::get('/users' , UsersComponent::class);
Route::get('/hodim' , HodimComponent::class);
Route::get('/jurnal' , JurnalComponent::class);
Route::get('/logout' , AuthComponent::class);
Route::get('/delivery' , DeliveryComponent::class);
Route::get('/waiter' , WaiterComponent::class);