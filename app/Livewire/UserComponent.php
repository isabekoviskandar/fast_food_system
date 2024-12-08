<?php
namespace App\Livewire;

use App\Models\Category;
use App\Models\Food;
use Livewire\Component;

class UserComponent extends Component
{
    public $categories, $foods;
    public $cartCount = 0;
    public $total = 0;
    public $cart = [];

    public function mount()
    {
        $this->cart = session('cart', []);
        $this->recalculateTotal();
        $this->updateCartCount();
        $this->categories = Category::all();
        $this->foods = Food::all();
    }

    public function updateQuantity($id, $quantity)
    {
        $cart = session('cart', []);
        
        // Validate quantity
        $quantity = max(1, intval($quantity));
        
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session(['cart' => $cart]);
            $this->cart = $cart;
            $this->recalculateTotal();
            $this->updateCartCount();
            
            // Dispatch browser event to keep modal open
            $this->dispatch('cart-updated');
        } else {
            session()->flash('error', 'Item not found in cart.');
        }
    }

    public function recalculateTotal()
    {
        $cart = session()->get('cart', []);
        $this->total = array_sum(array_map(function ($item) {
            $price = $item['price'] ?? 0;
            $quantity = $item['quantity'] ?? 0;
            return $price * $quantity;
        }, $cart));
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
        $this->cart = $cart;
        $this->updateCartCount();
        $this->recalculateTotal();
        $this->dispatch('cart-updated');
        
        session()->flash('success', 'Item added to cart.');
    }

    public function updateCartCount()
    {
        $cart = session()->get('cart', []);
        $this->cartCount = array_sum(array_column($cart, 'quantity'));
    }

    public function removeFromCart($foodId)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$foodId])) {
            unset($cart[$foodId]);
            session()->put('cart', $cart);
            $this->cart = $cart;
            $this->recalculateTotal();
            $this->updateCartCount();
            $this->dispatch('cart-updated');
            
            session()->flash('success', 'Item removed from cart.');
        }
    }

    public function render()
    {
        return view('livewire.user-component', [
            'foods' => $this->foods
        ])->layout('components.layouts.user', ['categories' => $this->categories]);
    }
}