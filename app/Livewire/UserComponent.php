<?php
namespace App\Livewire;

use App\Models\Category;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItems;
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
        
        $quantity = max(1, intval($quantity));
        
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session(['cart' => $cart]);
            $this->cart = $cart;
            $this->recalculateTotal();
            $this->updateCartCount();
            
            $this->dispatch('cart-updated');
        } else {
            session()->flash('error', 'Item not found in cart.');
        }
    }

    public function recalculateTotal()
    {
        $this->total = array_reduce($this->cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    }

    public function addToCart($foodId)
    {
        $food = Food::findOrFail($foodId);
    
        $this->cart[$foodId] = [
            'name' => $food->name,
            'price' => $food->price,
            'image' => $food->image,
            'quantity' => ($this->cart[$foodId]['quantity'] ?? 0) + 1,
        ];
    
        session(['cart' => $this->cart]);
        $this->recalculateTotal();
        $this->updateCartCount();
    
        session()->flash('success', "{$food->name} added to cart.");
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
    
    public function saveOrder()
    {
        if (empty($this->cart)) {
            session()->flash('error', 'Your cart is empty.');
            return;
        }
    
        $order = Order::create([
            'date' => now()->toDateString(),
            'sequence' => rand(1000, 9999),
            'sum' => $this->total,
            'status' => 'took',
        ]);
    
        foreach ($this->cart as $foodId => $item) {
            OrderItems::create([
                'order_id' => $order->id,
                'food_id' => $foodId,
                'count' => $item['quantity'],
                'total_price' => $item['price'] * $item['quantity'],
                'status' => 'took',
            ]);
        }
    
        session()->forget('cart');
        $this->cart = [];
        $this->cartCount = 0;
        $this->total = 0;
    
        $this->dispatch('cart-updated');
    
        session()->flash('success', 'Order placed successfully!');
    }
    
    public function render()
    {
        return view('livewire.user-component', [
            'foods' => $this->foods
        ])->layout('components.layouts.user', ['categories' => $this->categories]);
    }
}