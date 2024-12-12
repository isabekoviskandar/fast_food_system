<div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Sign in to start your session</h3>
                    </div>
                    <div class="card-body">
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form wire:submit.prevent="login">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input 
                                    type="text" 
                                    id="phone" 
                                    class="form-control" 
                                    placeholder="Enter your phone number"
                                    wire:model="phone"
                                >
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    class="form-control" 
                                    placeholder="Enter your password"
                                    wire:model="password"
                                >
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
