@extends('templates/auth-layout')

@section('body')

<div class="col-md-8 col-lg-6 col-xl-5">
    <div class="card overflow-hidden">
        <div class="bg-primary bg-soft">
            <div class="row">
                <div class="col-7">
                    <div class="text-primary p-4">
                        <h5 class="text-primary">Free Register</h5>
                        <p>Get your free Lara Codes account now.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <div>
                <a href="index.html">
                    <div class="avatar-md profile-user-wid mb-4">
                        <span class="avatar-title rounded-circle bg-light">
                            <img src="assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                        </span>
                    </div>
                </a>
            </div>
            <div class="p-2">
                <form method="POST" class="needs-validation" novalidate action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="username" placeholder="Enter username" value="{{ old('name') }}"
                        autocomplete="name" required>
                        @error('name')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="useremail" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="useremail" placeholder="Enter email" autocomplete="email" required>
                        @error('email')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="userpassword" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="userpassword" name="password" placeholder="Enter password" autocomplete="new-password" required>
                        @error('password')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="userpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="userpassword" name="password_confirmation" placeholder="Enter same password as above" autocomplete="new-password" required>
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="mt-4 d-grid">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">Register</button>
                    </div>

                    <div class="mt-4 text-center">
                        <h5 class="font-size-14 mb-3">Sign up using</h5>

                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="javascript::void()" class="social-list-item bg-primary text-white border-primary">
                                    <i class="mdi mdi-facebook"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript::void()" class="social-list-item bg-info text-white border-info">
                                    <i class="mdi mdi-twitter"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript::void()" class="social-list-item bg-danger text-white border-danger">
                                    <i class="mdi mdi-google"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-4 text-center">
                        <p class="mb-0">By registering you agree to the Lara Codes <a href="#" class="text-primary">Terms of Use</a></p>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="mt-5 text-center">

        <div>
            <p>Already have an account ? <a href="{{ route('login') }}" class="fw-medium text-primary"> Login</a> </p>
            <p>© <script>document.write(new Date().getFullYear())</script> Lara Codes. Crafted with <i class="mdi mdi-heart text-danger"></i> by Lara Codes</p>
        </div>
    </div>

</div>

@endsection
