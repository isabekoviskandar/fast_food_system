<div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="login-box">
                    <div class="login-logo">
                        <a href="#"><b>Admin</b>LTE</a>
                    </div>
                    <div class="card">
                        <div class="card-body login-card-body">
                            <p class="login-box-msg">Sign in to start your session</p>
                            
                            @if($error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            @endif

                            <form wire:submit.prevent="login">
                                <div class="input-group mb-3">
                                    <input 
                                        type="phone" 
                                        class="form-control" 
                                        placeholder="Phone" 
                                        wire:model="phone"
                                    >
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input 
                                        type="password" 
                                        class="form-control" 
                                        placeholder="Password" 
                                        wire:model="password"
                                    >
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <button 
                                            type="submit" 
                                            class="btn btn-primary btn-block"
                                        >
                                            Sign In
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>