<div>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Become Vendor
            </div>
        </div>
    </div>
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                    <div class="row">
                        <div class="col-lg-6 col-md-8">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h1 class="mb-5" style="font-size: 30px; font-weight: bold;">Become Vendor</h1>
                                        <p class="mb-30">Already have an account? <a href="{{route('login')}}">Login</a></p>
                                    </div>
                                    <form wire:submit='create'>
                                        
                                        <div class="form-group">
                                            <input wire:model='name' type="text" required="" id="name" name="name"  placeholder="Shop Name" />
                                            @error('name')
                                                <span class="text-red-500 text-xs mt-3 block ">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input wire:model='username' type="text" required="" id="username" name="username"  placeholder="Username" />
                                            @error('username')
                                                <span class="text-red-500 text-xs mt-3 block ">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input wire:model='email' type="email" id="email" required="" name="email" placeholder="Email" />
                                            @error('email')
                                                <span class="text-red-500 text-xs mt-3 block ">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input wire:model='phone' type="phone" required="" id="phone" name="phone"  placeholder="Phone" />
                                            @error('phone')
                                                <span class="text-red-500 text-xs mt-3 block ">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input wire:model='password' required="" id="password" type="password" name="password" placeholder="Password" />
                                            @error('password')
                                                <span class="text-red-500 text-xs mt-3 block ">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input required="" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm password" />
                                        </div>
                                        
                                        
                                        <div class="login_footer form-group mb-50">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="" />
                                                    <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
                                                </div>
                                            </div>
                                            <a href="page-privacy-policy.html"><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                        </div>
                                        <div class="form-group mb-30">
                                            <button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold">Submit &amp; Register</button>
                                        </div>
                                        <p class="font-xs text-muted"><strong>Note:</strong>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy</p>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 pr-30 d-none d-lg-block">
                            <div class="card-login mt-115">
                                <a href="#" class="social-login facebook-login">
                                    <img src="assets/imgs/theme/icons/logo-facebook.svg" alt="" />
                                    <span>Continue with Facebook</span>
                                </a>
                                <a href="#" class="social-login google-login">
                                    <img src="assets/imgs/theme/icons/logo-google.svg" alt="" />
                                    <span>Continue with Google</span>
                                </a>
                                <a href="#" class="social-login apple-login">
                                    <img src="assets/imgs/theme/icons/logo-apple.svg" alt="" />
                                    <span>Continue with Apple</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
