<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Food;
use Livewire\Component;

class FoodFilter extends Component
{

    public $foods;
    public $categories;
    public $cartCount = 0;

    public function mount(Category $category)
    {
        $this->cartCount = session('cart') ? count(session('cart')) : 0;
        $this->foods = Food::where('category_id', $category->id)->get();
        $this->categories = Category::all(); 
    }

    

    public function render()
    {
        // $this->categories = Category::all();
        // dd($this->foods);
        $this->categories = Category::with('foods')->get();

        return view('livewire.food-filter')->layout('components.layouts.user');
    }
}
