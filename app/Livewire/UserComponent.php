<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Food;
use Livewire\Component;

class UserComponent extends Component
{

    public $categories, $foods;


    public function mount()
    {
        $this->categories = Category::all();
        $this->foods = Food::all();
    }
    public function render()
    {
        return view('livewire.user-component')->layout('components.layouts.user');
    }
}
