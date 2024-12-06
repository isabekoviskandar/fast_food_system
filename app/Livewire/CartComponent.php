<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Food;

class Cart extends Component
{
    public $cartCount = 0;

    public function mount()
    {
        $this->cartCount = session('cart') ? count(session('cart')) : 0;
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
        return view('livewire.cart');
    }
}
