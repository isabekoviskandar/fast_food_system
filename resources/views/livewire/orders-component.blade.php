<div>
    <div class="container mt-5">
        <div class="row">
            @foreach (['took', 'in progress', 'done', 'in_waiter'] as $status)
                <div class="col-12 col-md-3">
                    <div class="card card-row card-{{ $status === 'done' ? 'success' : ($status === 'in_waiter' ? 'success' : 'primary') }}">
                        <div class="card-header">
                            <h3 class="card-title">{{ ucfirst($status) }}</h3>
                        </div>
                        <div class="card-body">
                            @foreach ($statuses[$status] as $order)
                                <ul>
                                    <li>Order ID: {{ $order->id }}</li>
                                    <li>Date: {{ $order->date }}</li>
                                    <li>Sequence: {{ $order->sequence }}</li>
                                    <li>Sum: {{ $order->sum }}</li>
                                </ul>
                                <button 
                                    wire:click="updateStatus({{ $order->id }})" 
                                    class="btn 
                                    {{ $order->status === 'took' ? 'btn-secondary' : 
                                       ($order->status === 'in_progress' ? 'btn-primary' : 
                                       ($order->status === 'done' ? 'btn-success' : 'btn-danger')) }}">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
