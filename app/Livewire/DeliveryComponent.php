<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class DeliveryComponent extends Component
{
    public $orders;

    public function mount()
    {
        $this->orders = Order::all();
    }



    public function render()
    {
        // Filter orders based on status
        $this->orders = Order::whereIn('status', ['in_progress', 'done'])->get();
    
        $statuses = [
            'in progress' => $this->orders->where('status', 'in_progress'),
            'done' => $this->orders->where('status', 'done'),
        ];
    
        return view('livewire.delivery-component', compact('statuses'))->layout('components.layouts.user');
    }
}
