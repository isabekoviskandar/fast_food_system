<div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="/user">Dunia<span>.</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="/delivery" class="nav-link">Orders</a>
                    </li>
                    <li>
                        <a href="/user" class="nav-link mt-3">Order page</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="ftco-section mt-5" id="ordersSection">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-2">
                <div class="col-md-7 text-center heading-section">
                    <span class="subheading">Orders Status</span>
                    <h2 class="mb-4">Current Orders</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @foreach($statuses as $status => $orders)
                        <h3 class="mt-4">{{ ucfirst($status) }} Orders</h3>
                        <div class="menu-wrap">
                            @forelse ($orders as $order)
                                <div class="menus d-flex mt-4">
                                    <div class="text pl-3">
                                        <div class="d-flex justify-content-between">
                                            <h4>Order ID: {{ $order->id }}</h4>
                                            <span class="price text-danger">Sum: ${{ $order->sum }}</span>
                                        </div>
                                        <p>Sequence: {{ $order->sequence }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center">No {{ $status }} orders.</p>
                            @endforelse
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>