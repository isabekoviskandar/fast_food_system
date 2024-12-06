<div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="/user">Dunia<span>.</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    @foreach ($categories as $category)
                    <li class="nav-item">
                        <a href="/" class="nav-link">{{ $category->name }}</a>
                    </li>
                    @endforeach
                    <li class="nav-item"><a href="/" class="nav-link">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
	<section class="ftco-section mt-5">
		<div class="container">
			<div class="row justify-content-center mb-3 pb-2">
				<div class="col-md-7 text-center heading-section ftco-animate">
					<span class="subheading">Specialties</span>
					<h2 class="mb-4">Our Menu</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-lg-4">
					<div class="menu-wrap">
						<div class="heading-menu text-center ftco-animate">
							<h3>Breakfast</h3>
						</div>
						
						@php
						$count = 0;
						@endphp
						
						@foreach ($foods as $food)
							@php
							$count+=1;
							@endphp
							<div class="menus d-flex ftco-animate mt-5">
								<img src="{{ asset('storage/' . $food->image) }}" alt="Breakfast" style="width: 100px; border-radius: 10px;">
								<div class="text">
									<div class="d-flex">
										<div class="one-half">
											<h3>{{ $food->name }}</h3>
										</div>
										<div class="one-forth">
											<span class="price">{{ $food->price }}</span>
										</div>
									</div>
									<a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
								</div>
							</div>
						@endforeach
						
						<span class="flat flaticon-bread" style="left: 0;"></span>
						<span class="flat flaticon-breakfast" style="right: 0;"></span>
					</div>
				</div>

			</div>
		</div>

	</section>
</div>