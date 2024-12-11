<div>
    <!-- Navbar -->
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
                        <a href="#" class="nav-link" wire:click="toggleCart" id="cartIcon">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="badge badge-pill badge-danger">{{ $cartCount }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Food Section -->
    @if(!$showCart)
    <section class="ftco-section mt-5" id="foodSection">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-2">
                <div class="col-md-7 text-center heading-section">
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
    @endif

    <!-- Cart Section -->
    @if($showCart)
    <section class="ftco-section mt-5" id="cartSection">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-2">
                <div class="col-md-7 text-center heading-section">
                    <span class="subheading">Your Cart</span>
                    <h2 class="mb-4">Cart Items</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="menu-wrap">
                        @forelse ($cart as $foodId => $item)
                            <div class="menus d-flex mt-4">
                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" style="width: 80px; border-radius: 10px;">
                                <div class="text pl-3">
                                    <div class="d-flex justify-content-between">
                                        <h4>{{ $item['name'] }}</h4>
                                        <span class="price text-danger">${{ $item['price'] }}</span>
                                    </div>
                                    
                                    <!-- Quantity Input Field -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <input type="number" wire:model="cart.{{ $foodId }}.quantity" 
                                            min="1" value="{{ $item['quantity'] }}"
                                            wire:change="updateQuantity({{ $foodId }}, $event.target.value)"
                                            class="form-control w-25">
                                        <button wire:click="removeFromCart({{ $foodId }})" class="btn btn-sm btn-outline mt-2">
                                            <i class="fa-solid fa-trash"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">No items in your cart.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="text-center">
                <h4>Total: ${{ $total }}</h4>
                <button wire:click="saveOrder" class="btn btn-primary">Checkout</button>
            </div>
        </div>
    </section>
    @endif

</div>
