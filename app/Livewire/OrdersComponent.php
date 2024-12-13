<?php
namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrdersComponent extends Component
{
    public $orders;

    public function mount()
    {
        $this->orders = Order::all();
    }

    public function updateStatus($orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            session()->flash('error', 'Order not found');
            return;
        }

        $statuses = ['took', 'in_progress', 'done', 'in_waiter'];

        $currentIndex = array_search($order->status, $statuses);
        $nextIndex = ($currentIndex + 1) % count($statuses);
        $order->status = $statuses[$nextIndex];
        $order->save();

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

        return view('livewire.orders-component', compact('statuses'));
    }
}
