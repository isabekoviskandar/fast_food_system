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

    public function addToCart($foodId)
    {
        $food = Food::find($foodId);

        if (!$food) {
            session()->flash('error', 'Food item not found.');
            return;
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$foodId])) {
            $cart[$foodId]['quantity']++;
        } else {
            $cart[$foodId] = [
                'name' => $food->name,
                'price' => $food->price,
                'image' => $food->image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        $this->cartCount = count($cart);

        session()->flash('success', 'Item added to cart.');
    }

    public function render()
    {
        // $this->categories = Category::all();
        // dd($this->foods);
        $this->categories = Category::with('foods')->get();

        return view('livewire.food-filter')->layout('components.layouts.user');
    }
}
