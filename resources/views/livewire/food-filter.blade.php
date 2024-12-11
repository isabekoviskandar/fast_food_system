<div>
        <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Your Shopping Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-7">
                            <h5 class="mb-3">
                                <a href="/user" class="text-body">
                                    <i class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping
                                </a>
                            </h5>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <p class="mb-1">Shopping cart</p>
                                    <p class="mb-0">You have {{ $cartCount }} items in your cart</p>
                                </div>
                            </div>
                            @foreach (session('cart', []) as $id => $item)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-row align-items-center">
                                                <div>
                                                    <img src="{{ asset('storage/' . $item['image']) }}" class="img-fluid rounded-3" alt="{{ $item['name'] }}" style="width: 65px;">

                                                </div>
                                                <div class="ms-3">
                                                    <h5>{{ $item['name'] }}</h5>
                                                    <p class="small mb-0">Price: ${{ $item['price'] }}</p>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center">
                                                <div style="width: 50px;">
                                                    <h5 class="fw-normal mb-0">{{ $item['quantity'] }}</h5>
                                                </div>
                                                <div style="width: 80px;">
                                                    <h5 class="mb-0">${{ $item['price'] * $item['quantity'] }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container">
                <a class="navbar-brand" href="/user">Dunia<span>.</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="oi oi-menu"></span> Menu
                </button>
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="/user" class="nav-link">All</a>
                        </li>
                        @foreach ($categories as $category)
                        <li class="nav-item">
                            <a href="{{ route('foodFilter', $category->id) }}" class="nav-link">{{ $category->name }}</a>
                        </li>
                        @endforeach
                        <li class="nav-item">
                            <a href="/cart" class="nav-link">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span class="badge badge-pill badge-danger">{{ $cartCount }}</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
    
    <section class="ftco-section mt-5">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-2">
                <div class="col-md-7 text-center heading-section ">
                    <span class="subheading">Specialties</span>
                    <h2 class="mb-4">Our Menu</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="menu-wrap">
                        @forelse ($foods as $food)
                            <div class="menus d-flex mt-4">
                                <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->name }}" style="width: 80px; border-radius: 10px;">
                                <div class="text pl-3">
                                    <div class="d-flex justify-content-between">
                                        <h4>{{ $food->name }}</h4>
                                        <span class="price text-danger">${{ $food->price }}</span>
                                    </div>
                                    <button wire:click="addToCart({{ $food->id }})" class="btn btn-sm btn-outline mt-2">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">No food available for this category.</p>
                        @endforelse
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</div>
