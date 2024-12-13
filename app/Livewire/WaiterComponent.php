<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class WaiterComponent extends Component
{
    public $orders;

    public function mount()
    {
        $this->orders = Order::all();
    }



    public function render()
    {
        $statuses = [
            'took' => $this->orders->where('status', 'took'),
            'in progress' => $this->orders->where('status', 'in_progress'),
            'done' => $this->orders->where('status', 'done'),
            'in_waiter' => $this->orders->where('status', 'in_waiter'),
        ];

        return view('livewire.waiter-component', compact('statuses'))->layout('components.layouts.app');
    }
}
